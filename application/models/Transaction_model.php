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
    
    public function getTransactions($userId) {
        $sql = "SELECT * FROM transactions WHERE userid=".$userId." ORDER BY occur_time";
        $query = $this->db->query($sql);
        $trans = $query->result_array();

        return $trans;
    }
    
    public function addTransaction($trans) {
        $data = array(
            'userid' => $trans['userid'],
            'occur_time' => $trans['date'],
            'cate_code' => $trans['cate'],
            'amount' => $trans['amount'],
            'direction' => $trans['type'],
            'remark' => $trans['remark']
        );
        $ret = $this->db->insert('transactions', $data);
        $message = "[INSERT " .$trans['userid']. "," .$trans['date']. "," .$trans['cate']. "," .$trans['amount']. "," .$trans['type']. "," .$trans['remark']. "]=" . $ret;
        log_message('debug', $message);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
}
