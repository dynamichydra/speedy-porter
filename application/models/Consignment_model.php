<?php

class Consignment_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_consignment($created_by) {
		 $q = $this->db->query("SELECT c.*,cus.name as merchant_name,cus.company as merchant_company,br.name as office,s.recipient_address,s.recipient_number,s.recipient_name as shipping_name,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN branch br ON c.branch = br.id WHERE c.created_by = $created_by AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function gettotaltktopencount($consid){
      $q = $this->db->query("SELECT COUNT(ticket_no) as totalopen FROM ticket WHERE consignment_no = $consid AND status IN('on review','open');")->result_array();
 		 return $q;
    }

    // public function get_all_consignment_aadmin() {
		//  $q = $this->db->query("SELECT c.*,cus.name as merchant_name,cus.company as merchant_company,br.name as office,s.recipient_address,s.recipient_number,s.recipient_name as shipping_name,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN branch br ON c.branch = br.id WHERE c.status <> 'inactive'")->result_array();
		//  return $q;
    // }

    public function get_all_consignment_aadmin($par=[]) {
      $cnd = [];
      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      if(isset($par['merch_id'])){
        $cnd["con.customer"] = $par['merch_id'];
      }

      if(isset($par['sel_branch'])){
        $cnd["con.branch"] = $par['sel_branch'];
      }

      if(isset($par['by_merchant'])){
        $cnd["con.by_merchant"] = $par['by_merchant'];
      }

      if(isset($par['created_by'])){
        $cnd["con.created_by"] = $par['created_by'];
      }

      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      $cnd["con.status!="] = "inactive";
      // $cnd["con.branch!="] = "11";
      // $cnd["bd.status!="] = "Picked-up from";
      // print_r($cnd);die;

      $this->db->select('con.*,cus.name as merchant_name,cus.company as merchant_company,cus.office as pickoffice')
         ->from('order_master con ')
         // ->join('branch br', 'br.id = con.branch')
         ->join('customer cus', 'cus.id = con.customer')
         // ->join('shiping s', 's.id = con.recipient_address')
         ->order_by("con.id", "DESC")
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_consignment_forbranch($forbranch) {
		 $q = $this->db->query("SELECT c.*,cus.name as merchant_name,cus.company as merchant_company,br.name as office,s.recipient_address,s.recipient_number,s.recipient_name as shipping_name,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN branch br ON c.branch = br.id WHERE c.branch = $forbranch AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_allconsignment() {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.pickup_address = s.id WHERE c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_merchant_consignment($id) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.pickup_address = s.id WHERE c.customer = $id AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_delivery_consignment($id) {
		 $q = $this->db->query("SELECT c.*,dp.id,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.pickup_address = s.id  INNER JOIN assign_delivery ad ON c.id = ad.consignment INNER JOIN delivery_person dp ON ad.delivery_person = dp.id WHERE dp.id = $id AND c.delivery_status <> 'delivered' AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_max_no() {
		 $q = $this->db->query("SELECT MAX(autono) no FROM `consignment`");
		 return $q->result_array();
    }
    public function delete_consignment($id) {
         $q = $this->db->query("UPDATE `consignment` SET `status`='inactive' WHERE id='$id'");
         return $q;
    }

    function get_merchant_data($postData){
         $response = array();
         if(isset($postData['search']) ){
           // Select record
           $this->db->select('*');
           // $this->db->limit(10);
           $this->db->where("status","active");
           $this->db->where("recipient_number like '%".$postData['search']."%' ");

           $records = $this->db->get('shiping')->result();

           foreach($records as $row ){
              $response[] = array("label"=>$row->recipient_number,"r_number"=>$row->recipient_number,"name"=>$row->recipient_name,"address"=>$row->recipient_address,"landmark"=>$row->recipient_landmark,"city"=>$row->recipient_city,"district"=>$row->district,"ps"=>$row->police_station,"zipcode"=>$row->recipient_postalcode,"id"=>$row->id);
           }

         }
         return $response;
    }

    public function get_history($counsout) {
		 $q = $this->db->query("SELECT * FROM `consignment` WHERE consignment_id IN ($counsout)")->result_array();
		 return $q;
    }

    public function get_invoice($consignment_id) {
		 $q = $this->db->query("SELECT * FROM trans_history WHERE consignments LIKE '%$consignment_id%'")->result_array();
		 return $q;
    }
    public function get_allheight(){
      $q = $this->db->query("SELECT * FROM volumetric WHERE status = 'active' GROUP BY height")->result_array();
     return $q;
    }


}
