<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 *
 * @author derek.zhang
 */
class User_model extends CI_Model {
    public $user_id;
    public $username;
    public $password;
    public $user_type;
    public $status;
    public $activate_url;
    public $ip;

    public function __construct() {
        parent::__construct();
    }
    
    public function signUp($userName, $password) {
        if ($this->isUserExist($userName)) {
            echo "User $userName is exist.";
            return -1;
        }
        $this->username = $userName;
        $this->password = $password;
        $this->status = 0;
        $this->activate_url = "http://localhost/?/user/activate/abcd1234";
        $this->ip = '127.0.0.1';
        $this->db->insert('user', $this);
    }
    
    public function isUserExist($userName) {
        $sql = "SELECT status FROM user WHERE username='".$userName."' LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->row();
        if (empty($row)) {
            return false;
        } else {
            echo "user status[$row->status]";
            return true;
        }
    }
    
    public function signIn($userName, $password) {
        $sql = "SELECT status FROM user WHERE username='".$userName."' AND password='".$password."'";
        $query = $this->db->query($sql);
        $row = $query->row();
        if (isset($row) && $row->status == "1") {
            return true;
        }
        return false;
    }
}
