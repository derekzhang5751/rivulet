<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    private function exitResponse($response) {
        if (is_string($response)) {
            exit($response);
        } else if (is_array($response)) {
            exit(json_encode($response));
        } else {
            exit('');
        }
    }
    
	public function index() {
        $username = $this->session->userdata('username');
        if (empty($username)) {
            //$this->load->view('user_login', NULL);
            redirect("/User");
        } else {
            $data['username'] = $username;
            $this->load->view('home_index', $data);
        }
	}
    
    public function page($pageName) {
        $this->load->view($pageName, NULL);
    }
    
    public function getAllCategories() {
        $this->load->model('category_model', '', TRUE);
        $categories = $this->category_model->getAllCategory();
        $response = array(
            'status' => 'ok',
            'msg' => '',
            'records' => $categories
        );
        $this->exitResponse($response);
    }
    
    public function addNewCatetory() {
        $response = array(
            'status' => 'ok',
            'msg' => ''
        );
        
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        if (empty($code) || empty($name)) {
            $response['status'] = 'error';
            $response['msg'] = 'Parameter is empty!';
            $this->exitResponse($response);
        }
        
        $this->load->model('category_model', '', TRUE);
        if ($this->category_model->existCategory($code, $name)) {
            $response['status'] = 'error';
            $response['msg'] = 'Category has existed!';
            $this->exitResponse($response);
        } else {
            if ($this->category_model->addCategory($code, $name)){
                $response['status'] = 'ok';
                $response['msg'] = '';
                $this->exitResponse($response);
            } else {
                $response['status'] = 'error';
                $response['msg'] = 'Database error!';
                $this->exitResponse($response);
            }
        }
    }
    
    private function getRealCatetoryCode($code) {
        $realCode = "";
        if (!isset($code) || !is_string($code) || strlen($code) != 4) {
            return $realCode;
        }
        if (substr($code, 2, 2) == '00') {
            $shortCode = substr($code, 0, 2);
            $this->load->model('category_model', '', TRUE);
            $count = $this->category_model->getRootCategorySize($shortCode);
            if ($count > 1) {
                $realCode = $shortCode.'%';
            } else {
                $realCode = $code;
            }
        } else {
            $realCode = $code;
        }
        return $realCode;
    }

    private function validateSigninUser() {
        $response = array(
            'status' => 'ok',
            'msg' => ''
        );
        
        $userName = $this->session->userdata('username');
        if (empty($userName)) {
            $response['status'] = 'error';
            $response['msg'] = "No user signin";
            $this->exitResponse($response);
        }
        
        $this->load->model('user_model', '', TRUE);
        $user = $this->user_model->getUserByName($userName);
        if ($user == false) {
            $response['status'] = 'error';
            $response['msg'] = "User does not exist";
            $this->exitResponse($response);
        }
        
        return $user;
    }

    public function getTransactions() {
        $response = array(
            'status' => 'ok',
            'msg' => '',
            'records' => null
        );
        
        // get current user
        $user = $this->validateSigninUser();

        // get search conditions
        //log_message('debug', "get transactions userid=".$user->user_id.",date1=".$this->input->post('date1').",date2=".$this->input->post('date2').",cate=".$this->input->post('cate'));
        $realCate = $this->getRealCatetoryCode($this->input->post('cate'));
        //log_message('debug', 'get transactions by real category:'.$realCate);
        $search = array(
            'userid' => $user->user_id,
            'date1' => $this->input->post('date1'),
            'date2' => $this->input->post('date2'),
            'cate' => $realCate
        );
        // return result
        $this->load->model('transaction_model', '', TRUE);
        $trans = $this->transaction_model->getTransactions($search);
        $response['records'] = $trans;
        $this->exitResponse($response);
    }
    
    public function addTransaction() {
        $response = array(
            'status' => 'ok',
            'msg' => '',
            'records' => null
        );
        $user = $this->validateSigninUser();
        
        $date = $this->input->post('date');
        $cate = $this->input->post('cate');
        $amount = $this->input->post('amount');
        $type = $this->input->post('type');
        $remark = $this->input->post('remark');
        if (empty($date) || empty($cate) || empty($amount) || empty($type) || empty($remark)) {
            $response['status'] = 'error';
            $response['msg'] = 'Parameter is empty!';
            $this->exitResponse($response);
        }
        
        $trans = array(
            'userid' => $user->user_id,
            'date' => $date,
            'cate' => $cate,
            'amount' => $amount,
            'type' => $type,
            'remark' => $remark
        );
        $this->load->model('transaction_model', '', TRUE);
        if ($this->transaction_model->addTransaction($trans) == false) {
            $response['status'] = 'error';
            $response['msg'] = 'Database error!';
            $this->exitResponse($response);
        }
        $this->exitResponse($response);
    }
    
    private function initUserBudget($userId) {
        //log_message('debug', 'Init user budget '.$userId);
        // get all root categories
        $this->load->model('category_model', '', TRUE);
        $categories = $this->category_model->getAllRootCategory();
        
        // init every category's budget
        $this->load->model('budget_model', '', TRUE);
        foreach ($categories as $cate) {
            //log_message('debug', '['.$cate['id'].']-['.$cate['code'].']-['.$cate['name'].']');
            $budgetId = $this->budget_model->existBudget($userId, $cate['code']);
            if ($budgetId == FALSE) {
                $budget = array(
                    'userid' => $userId,
                    'code' => $cate['code'],
                    'cate_name' => $cate['name'],
                    'amount' => 0.00,
                    'period' => 0
                );
                $this->budget_model->addBudget($budget);
            }
        }
    }
    
    public function getAllBudgets() {
        //log_message('debug', "[CONTROLLER]Get all budgets 1");
        $response = array(
            'status' => 'ok',
            'msg' => '',
            'records' => null
        );
        $user = $this->validateSigninUser();
        $this->initUserBudget($user->user_id);
        
        $this->load->model('budget_model', '', TRUE);
        $budgets = $this->budget_model->getUserBudget($user->user_id);
        $response['records'] = $budgets;
        
        $this->exitResponse($response);
    }
    
}