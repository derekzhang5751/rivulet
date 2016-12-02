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
            $this->db->where('userid', $userid);
        }
        if (isset($date1) && !empty($date1) && $date1 != 'null' && $date1 != 'undefined') {
            $this->db->where('occur_time >=', $date1);
        }
        if (isset($date2) && !empty($date2) && $date2 != 'null' && $date2 != 'undefined') {
            $this->db->where('occur_time <=', $date2);
        }
        if (isset($cate) && !empty($cate) && $cate != 'null' && $cate != 'undefined') {
            if (strlen($cate) == 4) {
                $this->db->where('cate_code', $cate);
            } else {
                $this->db->where('cate_code LIKE ', $cate);
            }
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
        //$message = "[INSERT " .$trans['userid']. "," .$trans['date']. "," .$trans['cate']. "," .$trans['amount']. "," .$trans['type']. "," .$trans['remark']. "]=" . $ret;
        //log_message('debug', $message);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getUserTransSumByCate($userId, $cateMasterCode) {
        //log_message('debug', "[MODEL]Get user budget ".$userId);
        $sql = "SELECT SUM(amount*direction) AS amount FROM transactions WHERE userid=".$userId." AND cate_code LIKE '".$cateMasterCode."%'";
        $query = $this->db->query($sql);
        $sum = $query->result_array();
        return $sum;
    }
    
    public function getUserTransSumByCateDate($userId, $cateMasterCode, $begin, $end) {
        //log_message('debug', "[MODEL]Get user budget ".$userId);
        $sql = "SELECT SUM(amount*direction) AS amount FROM transactions WHERE userid=".$userId." AND cate_code LIKE '".$cateMasterCode."%'";
        if ($begin) {
            $sql = $sql . " AND occur_time>='" . $begin . "'";
        }
        if ($end) {
            $sql = $sql . " AND occur_time<='" . $end . "'";
        }
        $query = $this->db->query($sql);
        $sum = $query->result_array();
        return $sum;
    }

}
