<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category_model
 *
 * @author derek.z
 */
class Fixedexpends_model extends CI_Model {
    public $id;
    public $occur_time;
    public $cate_code;
    public $amount;
    public $remark;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getFixedExpends($search) {
        $userid = $search['userid'];
        
        if (isset($userid) && !empty($userid) && $userid != 'null' && $userid != 'undefined') {
            $this->db->where('userid', $userid);
        }
        $this->db->order_by('occur_time', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get('fixedexpends');
        $trans = $query->result_array();

        return $trans;
    }
    
    public function addFixedExpend($trans) {
        $data = array(
            'userid' => $trans['userid'],
            'occur_time' => $trans['date'],
            'cate_code' => $trans['cate'],
            'amount' => $trans['amount'],
            'remark' => $trans['remark']
        );
        $ret = $this->db->insert('fixedexpends', $data);
        //$message = "[INSERT " .$trans['userid']. "," .$trans['date']. "," .$trans['cate']. "," .$trans['amount']. "," .$trans['remark']. "]=" . $ret;
        //log_message('debug', $message);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
    
}
