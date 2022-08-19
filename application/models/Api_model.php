<?php

class Api_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_consignment_aadmin($par=[]) {
      $cnd = [];
      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      if(isset($par['merch_id'])){
        $cnd["con.customer"] = $par['merch_id'];
      }
      if(isset($par['recipientname'])){
        if(is_numeric($par['recipientname'])){
          $cnd["s.recipient_number"] = $par['recipientname'];
        }else{
        $cnd["s.recipient_name"] = $par['recipientname'];
      }
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

      $this->db->select('con.*,cus.name as merchant_name,DATE_FORMAT(con.timestamp,"%d, %b %Y %h:%m %p") timestampto')
         ->from('order_master con ')
         // ->join('branch br', 'br.id = con.branch')
         ->join('customer cus', 'cus.id = con.customer')
         // ->join('shiping s', 's.id = con.recipient_address')
         ->order_by("con.id", "DESC")
         ->offset($par['offst'])
         ->limit(10)
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_tickets_merchant($mID,$limit,$offset) {
		 $q = $this->db->query("SELECT t.*,c.consignment_id consignment,cus.name customer_name FROM ticket t INNER JOIN order_master c ON c.id = t.consignment_no INNER JOIN customer cus on cus.id = c.customer WHERE t.merchant = '$mID' ORDER BY t.date_open DESC LIMIT $limit OFFSET $offset;")->result_array();
		 return $q;
    }

    public function get_all_tickets_merchantnotif($mID) {
		 $q = $this->db->query("SELECT t.*,c.consignment_id consignment,ship.recipient_name customer_name FROM ticket t INNER JOIN consignment c ON c.id = t.consignment_no INNER JOIN shiping ship on ship.id = c.recipient_address WHERE t.merchant = '$mID';")->result_array();
		 return $q;
    }

    public function get_all_pymntlist($cid,$limit,$offset) {
		 $q = $this->db->query("SELECT * FROM `trans_history` WHERE merchant = '$cid' ORDER BY date DESC LIMIT $limit OFFSET $offset;")->result_array();
		 return $q;
    }

    public function getconsignmentInfo($par=[]){
     $cnd = [];
     if(isset($par['customer_id'])){
       $cnd["c.customer"] = $par['customer_id'];
     }
     if(isset($par['pstatus'])){
       $cnd["c.payment_status"] = $par['pstatus'];
     }

     // if(isset($par['created_by'])){
     //   $cnd["c.created_by"] = $par['created_by'];
     // }

     if(isset($par['from_date'])){
       $cnd["DATE(c.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }

     if(isset($par['to_date'])){
       $cnd["DATE(c.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }
     // $cnd["c.status!="] = "inactive";
     $cnd["c.payment_status!="] = "due";
     $cnd["c.cons_status!="] = "cancelled";
     $cnd["c.status!="] = "inactive";

     // if(isset($par['txt'])){
     //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
     // }
     $this->db->select('c.*,b.name customer_name,s.recipient_name,s.recipient_number,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city')
        ->from('consignment c ')
        ->join('customer b', 'b.id = c.customer')
        ->join('shiping s', 's.id = c.recipient_address')
        // ->join('symptoms s', 's.id = b.symptom','left')
        // ->join('doctor d', 'd.id = b.doctor','left')
        ->order_by("c.payment_status_merchant", "ASC")
        ->offset($par['offst'])
        ->limit(10)
        ->where($cnd);
     $query =  $this->db->get();
     $res =  $query->result();
     $arr = [];
     foreach($res as $k=>$v){
       $arr[$k]['id'] = $v->id;
       $arr[$k]['recipient_city'] = $v->recipient_city;
       $arr[$k]['recipient_area'] = $v->recipient_area;
       $arr[$k]['recipient_address_2'] = $v->recipient_address_2;
       $arr[$k]['recipient_address'] = $v->recipient_address;
       $arr[$k]['consignment_id'] = $v->consignment_id;
       $arr[$k]['name'] = $v->recipient_name;
       $arr[$k]['contact'] = $v->recipient_number;
       $arr[$k]['weight'] = $v->total_weight;
       $arr[$k]['product_price'] = $v->total_price_product;
       $arr[$k]['delivery_charge'] = $v->total_price;
       $arr[$k]['payment_status'] = $v->payment_status;
       $arr[$k]['payment_status_merchant'] = $v->payment_status_merchant;
       $arr[$k]['timestamp'] = $v->timestamp;
       $arr[$k]['delivery_date'] = $v->delivery_date;
       $arr[$k]['amount_paid'] = $v->amount_paid;
       $arr[$k]['grand_total'] = $v->grand_total;
       $arr[$k]['cash_collection'] = $v->cash_collection;
       $arr[$k]['total_cod_charge'] = $v->total_cod_charge;
       $arr[$k]['paytomerch'] = $v->paytomerch;
       $arr[$k]['extra_amount'] = $v->extra_amount;
       $arr[$k]['product_id'] = $v->product_id;
       $arr[$k]['deduction_amount'] = $v->deduction_amount;
       $arr[$k]['deduction_status'] = $v->deduction_status;
       $arr[$k]['delivery_status'] = $v->delivery_status;
       $arr[$k]['less_paid_return'] = $v->less_paid_return;
       $arr[$k]['return_extra'] = $v->return_extra;
     }
     return $arr;
   }

   public function get_invoice($consignment_id) {
    $q = $this->db->query("SELECT * FROM trans_history WHERE consignments LIKE '%$consignment_id%'")->result_array();
    return $q;
   }

   public function getconsdetail($consid) {
     $cnd = [];
     $cnd["con.id="] = $consid;
     $cnd["con.status!="] = "inactive";

     $this->db->select('con.*,cus.name as merchant_name,DATE_FORMAT(con.timestamp,"%d, %b %Y %h:%m %p") timestamp')
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

   public function getconsignmentInfodetail($par=[]){
    $cnd = [];
    if(isset($par['customer_id'])){
      $cnd["c.customer"] = $par['customer_id'];
    }
    if(isset($par['pstatus'])){
      $cnd["c.payment_status"] = $par['pstatus'];
    }

    $cnd["c.id"] = $par['consid'];

    // if(isset($par['created_by'])){
    //   $cnd["c.created_by"] = $par['created_by'];
    // }

    if(isset($par['from_date'])){
      $cnd["DATE(c.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
    }

    if(isset($par['to_date'])){
      $cnd["DATE(c.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
    }
    // $cnd["c.status!="] = "inactive";
    $cnd["c.payment_status!="] = "due";
    $cnd["c.cons_status!="] = "cancelled";
    $cnd["c.status!="] = "inactive";

    // if(isset($par['txt'])){
    //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
    // }
    $this->db->select('c.*,b.name customer_name,s.recipient_name,s.recipient_number,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city')
       ->from('consignment c ')
       ->join('customer b', 'b.id = c.customer')
       ->join('shiping s', 's.id = c.recipient_address')
       // ->join('symptoms s', 's.id = b.symptom','left')
       // ->join('doctor d', 'd.id = b.doctor','left')
       ->order_by("c.id", "DESC")
       ->where($cnd);
    $query =  $this->db->get();
    $res =  $query->result();
    $arr = [];
    foreach($res as $k=>$v){
      $arr[$k]['id'] = $v->id;
      $arr[$k]['recipient_city'] = $v->recipient_city;
      $arr[$k]['recipient_area'] = $v->recipient_area;
      $arr[$k]['recipient_address_2'] = $v->recipient_address_2;
      $arr[$k]['recipient_address'] = $v->recipient_address;
      $arr[$k]['consignment_id'] = $v->consignment_id;
      $arr[$k]['name'] = $v->recipient_name;
      $arr[$k]['contact'] = $v->recipient_number;
      $arr[$k]['weight'] = $v->total_weight;
      $arr[$k]['product_price'] = $v->total_price_product;
      $arr[$k]['delivery_charge'] = $v->total_price;
      $arr[$k]['payment_status'] = $v->payment_status;
      $arr[$k]['payment_status_merchant'] = $v->payment_status_merchant;
      $arr[$k]['timestamp'] = $v->timestamp;
      $arr[$k]['delivery_date'] = $v->delivery_date;
      $arr[$k]['amount_paid'] = $v->amount_paid;
      $arr[$k]['grand_total'] = $v->grand_total;
      $arr[$k]['cash_collection'] = $v->cash_collection;
      $arr[$k]['total_cod_charge'] = $v->total_cod_charge;
      $arr[$k]['paytomerch'] = $v->paytomerch;
      $arr[$k]['extra_amount'] = $v->extra_amount;
      $arr[$k]['product_id'] = $v->product_id;
      $arr[$k]['deduction_amount'] = $v->deduction_amount;
      $arr[$k]['deduction_status'] = $v->deduction_status;
      $arr[$k]['delivery_status'] = $v->delivery_status;
      $arr[$k]['less_paid_return'] = $v->less_paid_return;
      $arr[$k]['return_extra'] = $v->return_extra;
      // $arr[$k]['status'] = $v->status;
      // $arr[$k]['dr_name'] = $v->dr_name;
      // $arr[$k]['dname'] = $v->dname;
      // $arr[$k]['js_time'] = $v->bdate.'T'.date('H:i:s',strtotime($v->bdate.' '.$v->time)).'+08:00';
    }
    return $arr;
  }

  public function get_history($counsout) {
   $q = $this->db->query("SELECT c.*,ship.recipient_name FROM `consignment` c INNER JOIN shiping ship ON c.recipient_address=ship.id WHERE c.consignment_id IN ($counsout) order by c.payment_status_merchant")->result_array();
   // $q = $this->db->query("SELECT * FROM `consignment` WHERE consignment_id IN ($counsout)")->result_array();
   return $q;
  }

  public function totaltktopencount($consid){
    $q = $this->db->query("SELECT COUNT(ticket_no) as totalopen FROM ticket WHERE consignment_no = $consid AND status IN('on review','open');")->result_array();
   return $q;
  }

  public function get_allheight(){
    $q = $this->db->query("SELECT * FROM volumetric WHERE status = 'active' GROUP BY height")->result_array();
   return $q;
  }

}
