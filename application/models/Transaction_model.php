<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category_model
 *
 * @author derek.z
 */
class Transaction_model extends CI_Model {
    public $id;
    public $occur_time;
    public $cate_code;
    public $amount;
    public $direction;
    public $remark;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getTransactions() {
        $sql = "SELECT * FROM transactions ORDER BY occur_time";
        $query = $this->db->query($sql);
        $trans = $query->result_array();

        return $trans;
    }
}
