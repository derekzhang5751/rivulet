<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category_model
 *
 * @author derek.z
 */
class Category_model extends CI_Model {
    public $id;
    public $code;
    public $name;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAllCategory() {
        //error_log("getAllCategory");
        $sql = "SELECT * FROM category ORDER BY code";
        $query = $this->db->query($sql);
        $categories = $query->result_array();
        /*foreach ($categories as $row) {
            error_log($row['id']);
            error_log($row['code']);
            error_log($row['name']);
            error_log("=======");
        }*/

        return $categories;
    }
    
    public function existCategory($code, $name) {
        $this->db->select('id');
        $this->db->where("code=".$code." OR name='".$name."'");
        $count = $this->db->count_all_results('category');
        $message = "[EXIST " . $code . ", " . $name . "]=" . $count;
        //log_message('debug', $message);
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addCategory($code, $name) {
        $data = array(
            'code' => $code,
            'name' => $name
        );
        $ret = $this->db->insert('category', $data);
        $message = "[INSERT " . $code . ", " . $name . "]=" . $ret;
        //log_message('debug', $message);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
}
