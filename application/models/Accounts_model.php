<?php

class Accounts_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function delete_entry_list($id) {
		 $q = $this->db->query("DELETE FROM `entry_list` WHERE id='$id'");
		 return $q;
    }

    public function delete_exp_list($id) {
		 $q = $this->db->query("DELETE FROM `expense_list` WHERE id='$id'");
		 return $q;
    }

    public function get_all_entrylist() {

      $this->db->select('entry.*,br.name as branchname')
         ->from('entry_list entry ')
         ->join('branch br', 'br.id = entry.office')
         ->order_by("entry.id", "ASC");
         // ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_expenses($par=[]){
     $cnd = [];
     if(isset($par['branch'])){
       $cnd["exp.office"] = $par['branch'];
     }

     if(isset($par['name'])){
       $cnd["exp.name"] = $par['name'];
     }

     if(isset($par['exp_type'])){
       $cnd["exp.exp_type"] = $par['exp_type'];
     }

     if(isset($par['vouch'])){
       $cnd["exp.exp_nature"] = $par['vouch'];
     }


     if(isset($par['from_date'])){
       $cnd["DATE(exp.exp_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }

     if(isset($par['to_date'])){
       $cnd["DATE(exp.exp_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }

     $this->db->select('exp.*')
        ->from('expenses exp ')
        ->order_by("exp.id", "DESC")
        ->where($cnd);
     $query =  $this->db->get();
     $res =  $query->result();
     return $res;
   }
}
