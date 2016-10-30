<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
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
        $ret = array(
            "records" => $categories
        );
        echo json_encode($ret);
    }
    
    public function addNewCatetory() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        if (empty($code) || empty($name)) {
            exit("invalid parameters");
        }
        $this->load->model('category_model', '', TRUE);
        if ($this->category_model->existCategory($code, $name)) {
            echo "repeat";
        } else {
            if ($this->category_model->addCategory($code, $name)){
                echo "ok";
            } else {
                echo "fail";
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

    public function getTransactions() {
        $ret = array();
        // get current user
        $userName = $this->session->userdata('username');
        if (empty($userName)) {
            exit(json_encode($ret));
        }
        $this->load->model('user_model', '', TRUE);
        $user = $this->user_model->getUserByName($userName);
        if ($user == false) {
            exit(json_encode($ret));
        }
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
        $ret = array(
            "records" => $trans
        );
        echo json_encode($ret);
    }
    
    public function addTransaction() {
        $userName = $this->session->userdata('username');
        if (empty($userName)) {
            exit("not signin");
        }
        $this->load->model('user_model', '', TRUE);
        $user = $this->user_model->getUserByName($userName);
        if ($user == false) {
            exit("user does not exist");
        }
        
        $date = $this->input->post('date');
        $cate = $this->input->post('cate');
        $amount = $this->input->post('amount');
        $type = $this->input->post('type');
        $remark = $this->input->post('remark');
        if (empty($date) || empty($cate) || empty($amount) || empty($type) || empty($remark)) {
            exit("fail");
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
            exit("db error");
        }
        echo "ok";
    }
}