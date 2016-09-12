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
    }
    
    public function signUp($userName, $password) {
        echo "User controller sign up.".PHP_EOL;
        echo "Load user model.".PHP_EOL;
        $this->load->model('user_model', '', TRUE);
        $this->user_model->signUp($userName, $password);
    }
}
