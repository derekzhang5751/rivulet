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
    
    public function existTransaction($trans) {
        $where = array(
            'userid' => $trans['userid'],
            'occur_time' => $trans['occur_time'],
            //'cate_code' => $trans['cate_code'],
            'amount' => $trans['amount'],
            'direction' => $trans['direction'],
            'remark' => $trans['remark']
        );
        $this->db->select('id');
        $this->db->where($where);
        $count = $this->db->count_all_results('transactions');
        //$message = "[EXIST " . $trans['userid'] . ", " . $trans['remark'] . "]=" . $count;
        //log_message('debug', $message);
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addTransaction($trans) {
        $data = array(
            'userid' => $trans['userid'],
            'occur_time' => $trans['occur_time'],
            'cate_code' => $trans['cate_code'],
            'amount' => $trans['amount'],
            'direction' => $trans['direction'],
            'remark' => $trans['remark']
        );
        $ret = $this->db->insert('transactions', $data);
        //$message = "[INSERT " .$data['userid']. "," .$data['occur_time']. "," .$data['cate_code']. "," .$data['amount']. "," .$data['direction']. "," .$data['remark']. "]=" . $ret;
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
        //log_message('debug', "[MODEL]getUserTransSumByCateDate userid=".$userId.",cate=".$cateMasterCode.",date1=".$begin.",date2=".$end);
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
