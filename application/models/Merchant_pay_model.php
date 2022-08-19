
<?php

class Merchant_pay_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
		 $q = $this->db->query("SELECT trans.*,mer.name as merchant_name FROM trans_history trans INNER JOIN customer mer ON trans.merchant = mer.id")->result_array();
		 return $q;
    }
   /* public function get_edit_data($id) {
		 $q = $this->db->query("SELECT ad.*,c.consignment_id,dp.name as delivery_person_name FROM assign_delivery ad INNER JOIN consignment c ON c.id = ad.consignment INNER JOIN delivery_person dp ON ad.delivery_person = dp.id WHERE ad.status <> 'inactive' AND ad.id= $id");
		 return $q;
    }*/
    public function get_consignmentPrice($consId){
      $q = $this->db->query("SELECT total_price_product FROM consignment WHERE id = $consId")->result_array();
 		 return $q;
    }

    public function get_status() {
		 $q = $this->db->query("SELECT c.* FROM consignment c WHERE c.status <> 'inactive' group by c.delivery_status")->result_array();
		 return $q;
    }

    public function get_price($consId){
      $q = $this->db->query("SELECT consignment_id , total_price_product FROM consignment WHERE id = $consId")->result_array();
 		 return $q;
    }

    public function getall($par=[]){
     $cnd = [];
     if(isset($par['company'])){
       $cnd["con.customer"] = $par['company'];
     }

     if(isset($par['from_date'])){
       $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }

     if(isset($par['to_date'])){
       $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }
     // $cnd["con.payment_status!="] = "due";
     if($this->session->userdata('user_type') != 'admin'){
     $cnd["con.created_by"] = $this->session->userdata('id');
   }
   // $cnd["con.status"] = "assigned";
   $cnd["con.status!="] = "inactive";
   $cnd["con.cons_status!="] = "cancelled";
   $cnd["con.delivery_status!="] = "cancelled";
   $cnd["con.collection_status"] = "received";

     $this->db->select('con.*,c.company as company_name,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_postalcode,s.recipient_number,s.recipient_area')
        ->from('consignment con ')
        ->join('shiping s', 's.id = con.recipient_address')
        ->join('customer c', 'c.id=con.customer')
        ->order_by("con.id", "DESC")
        ->where($cnd);
     $query =  $this->db->get();
     $res =  $query->result();
     return $res;
   }

   public function getallforbranch($par=[]){
    $cnd = [];
    if(isset($par['branch'])){
      $cnd["con.branch"] = $par['branch'];
    }

    if(isset($par['from_date'])){
      $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
    }

    if(isset($par['to_date'])){
      $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
    }
    $cnd["con.branch!="] = "11";
    // $cnd["con.created_by"] = $this->session->userdata('id');

    $this->db->select('con.*,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_postalcode,s.recipient_number,s.recipient_area')
       ->from('consignment con ')
       ->join('shiping s', 's.id = con.recipient_address')
       // ->join('delivery_person dp', 'dp.id=ad.delivery_person')
       ->order_by("con.id", "DESC")
       ->where($cnd);
    $query =  $this->db->get();
    $res =  $query->result();
    return $res;
  }

   public function get_all_list($par=[]){
    $cnd = [];
    if(isset($par['user_type'])){
      $cnd["dp.user_type"] = $par['user_type'];
    }

    if(isset($par['sel_branch'])){
      $cnd["con.branch"] = $par['sel_branch'];
    }

    if(isset($par['delivery_person_id'])){
      $cnd["dp.id"] = $par['delivery_person_id'];
    }
    if(isset($par['status'])){
      $cnd["con.delivery_status"] = $par['status'];
    }
    if(isset($par['from_date'])){
      $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
    }

    if(isset($par['to_date'])){
      $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
    }
    $cnd["con.status"] = "assigned";
    // $cnd["con.cons_status"] = "received";
    $cnd["con.collection_status"] = "due";

    $this->db->select('con.*,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_postalcode,s.recipient_number,s.recipient_area,c.name as cus_name,c.company as cus_company,,c.phone as cus_contact,p.name as pack_name,p.price as pack_price, DATE_FORMAT(con.timestamp,"%d, %b %Y %h:%m %p") order_date, DATE_FORMAT(con.assigned_date,"%d, %b %Y") assigned_date,dp.name as dp_name')
       ->from('consignment con ')
       ->join('customer c', 'c.id = con.customer')
       ->join('package p', 'p.id = con.package_name')
       ->join('shiping s', 's.id = con.recipient_address')
       ->join('assign_delivery ad', 'ad.consignment = con.id')
       ->join('delivery_person dp', 'dp.id=ad.delivery_person')
       ->order_by("con.id", "DESC")
       ->where($cnd);
    $query =  $this->db->get();
    $res =  $query->result();
    return $res;
  }


}
