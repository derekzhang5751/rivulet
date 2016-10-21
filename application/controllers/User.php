<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 *
 * @author derek.zhang
 */
class User extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    public function index() {
        $data = array();
        $data['username'] = "admin";
        $data['password'] = "123456";
        $this->load->view('user_login', $data);
    }

    public function signUp($userName, $password) {
        echo "User controller sign up.".PHP_EOL;
        echo "Load user model.".PHP_EOL;
        $this->load->model('user_model', '', TRUE);
        $this->user_model->signUp($userName, $password);
    }
    
    public function signIn() {
        $return = "fail";
        $userName = $this->input->post("username");
        $password = $this->input->post("password");
        $this->load->model('user_model', '', TRUE);
        $ret = $this->user_model->signIn($userName, $password);
        if ($ret === true) {
            $data = array(
                'username' => $userName,
                'usertype' => 1
            );
            $this->session->set_userdata($data);
            $return = "ok";
        } else {
            $data = array('username', 'usertype');
            $this->session->unset_userdata($data);
        }
        echo $return;
    }
    
    public function signOut() {
        $data = array('username', 'usertype');
        $this->session->unset_userdata($data);
        redirect("http://rivulet/User");
        echo "ok";
    }
}
