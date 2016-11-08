<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category_model
 *
 * @author derek.z
 */
class Budget_model extends CI_Model {
    public $id;
    public $code;
    public $name;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getUserBudget($userId) {
        //log_message('debug', "[MODEL]Get user budget ".$userId);
        $sql = "SELECT * FROM budget WHERE userid=".$userId." ORDER BY code";
        $query = $this->db->query($sql);
        $budgets = $query->result_array();

        return $budgets;
    }
    
    public function getUserValidBudget($userId) {
        //log_message('debug', "[MODEL]Get user budget ".$userId);
        $sql = "SELECT * FROM budget WHERE userid=".$userId." ORDER BY code";
        $query = $this->db->query($sql);
        $budgets = $query->result_array();

        return $budgets;
    }
    
    public function existBudget($userId, $code) {
        $this->db->select('id');
        $this->db->where("userid=".$userId." AND code='".$code."'");
        $result = $this->db->get('budget');
        if ($result && $result->num_rows() > 0) {
            $row = $result->row(0);
            return $row->id;
        } else {
            return false;
        }
    }
    
    public function addBudget($budget) {
        $data = array(
            'userid' => $budget['userid'],
            'code' => $budget['code'],
            'cate_name' => $budget['cate_name'],
            'amount' => $budget['amount'],
            'period' => $budget['period']
        );
        $ret = $this->db->insert('budget', $data);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
    
    public function editBudget($userId, $id, $amount, $period) {
        $this->db->set('amount', $amount);
        $this->db->set('period', $period);
        $this->db->where('id', $id);
        $this->db->where('userid', $userId);
        $ret = $this->db->update('budget');
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }
    
}
