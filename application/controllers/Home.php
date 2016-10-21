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
    
    public function getTransactions() {
        $this->load->model('transaction_model', '', TRUE);
        $trans = $this->transaction_model->getTransactions();
        $ret = array(
            "records" => $trans
        );
        echo json_encode($ret);
    }
}