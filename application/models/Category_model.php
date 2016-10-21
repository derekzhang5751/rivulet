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
}
