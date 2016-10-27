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
    
    public function getTransactions($search) {
        $userid = $search['userid'];
        $date1 = $search['date1'];
        $date2 = $search['date2'];
        $cate = $search['cate'];
        
        if (isset($userid) && !empty($userid) && $userid != 'null' && $userid != 'undefined') {
            $this->db->where('userid', $search['userid']);
        }
        if (isset($date1) && !empty($date1) && $date1 != 'null' && $date1 != 'undefined') {
            $this->db->where('occur_time >=', $search['date1']);
        }
        if (isset($date2) && !empty($date2) && $date2 != 'null' && $date2 != 'undefined') {
            $this->db->where('occur_time <=', $search['date2']);
        }
        if (isset($cate) && !empty($cate) && $cate != 'null' && $cate != 'undefined') {
            $this->db->where('cate_code', $search['cate']);
        }
        $this->db->order_by('occur_time', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get('transactions');
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
        //log_message('debug', $message);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
}
