<?php

class Ticket_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    // public function get_all_tickets() {
		//  $q = $this->db->query("SELECT t.*,c.consignment_id consignment, m.name merchant_name FROM ticket t INNER JOIN consignment c ON c.id = t.consignment_no INNER JOIN customer m ON t.merchant = m.id")->result_array();
		//  return $q;
    // }

    public function get_all_tickets_merchant($mID) {
		 $q = $this->db->query("SELECT t.*,c.consignment_id consignment FROM ticket t INNER JOIN consignment c ON c.id = t.consignment_no WHERE t.merchant = '$mID'")->result_array();
		 return $q;
    }

    public function get_merchant_consignment($id) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id WHERE c.created_by = $id AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_status() {
		 $q = $this->db->query("SELECT c.* FROM ticket c WHERE c.status <> 'inactive' group by c.status")->result_array();
		 return $q;
    }

    public function get_all_tickets($par=[]){
     $cnd = [];
     if(isset($par['customer_id'])){
       $cnd["t.merchant"] = $par['customer_id'];
     }
     if(isset($par['status'])){
       $cnd["t.status"] = $par['status'];
     }
     if(isset($par['from_date'])){
       $cnd["t.date_open >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }

     if(isset($par['to_date'])){
       $cnd["t.date_open <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }
     $cnd["t.status!="] = 'close';

     $this->db->select('t.*,c.consignment_id consignment, m.name merchant_name,m.company mercompany')
        ->from('ticket t ')
        ->join('customer m', 'm.id = t.merchant')
        ->join('consignment c', 'c.id = t.consignment_no','left')
        // ->join('shiping s', 's.id = c.recipient_address','left')
        ->order_by("t.id", "DESC")
        ->where($cnd);
     $query =  $this->db->get();
     $res =  $query->result();
     $arr = [];
     foreach($res as $k=>$v){
       $arr[$k]['id'] = $v->id;
       $arr[$k]['ticket_no'] = $v->ticket_no;
       $arr[$k]['merchant_name'] = $v->merchant_name;
       $arr[$k]['company'] = $v->mercompany;
       $arr[$k]['consignment'] = $v->consignment;
       $arr[$k]['subject'] = $v->subject;
       $arr[$k]['date_open'] = $v->date_open;
       $arr[$k]['date_close'] = $v->date_close;
       $arr[$k]['status'] = $v->status;
       $arr[$k]['comment'] = $v->comment;
       $arr[$k]['description'] = $v->description;
     }
     return $arr;
   }

   public function allread(){
     $q = $this->db->query("UPDATE ticket SET isread = 1;")->result_array();
		 return $q;
   }
}
