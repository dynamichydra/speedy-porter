<?php

class Rider_api_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_consignment_dp($par=[]) {
      $cnd = [];

      if(isset($par['recipientname'])){
        if(is_numeric($par['recipientname'])){
          $cnd["cus.phone"] = $par['recipientname'];
        }else{
        $cnd["cus.name"] = $par['recipientname'];
      }
      }

      $cnd["con.status!="] = "inactive";
      $cnd["con.cons_status="] = "pending";
      $cnd["con.receive_status="] = "assigned";
      $cnd["ar.delivery_person="] = $par['merch_id'];
      // $cnd["bd.status!="] = "Picked-up from";
      // print_r($cnd);die;

      $this->db->select('con.*,cus.name as merchant_name,DATE_FORMAT(con.assigned_date,"%d, %b %Y %h:%m %p") assigned_date_cons,cus.address as merchant_address,cus.phone as merch_phone,cus.add_lat,,cus.add_long')
         ->from('consignment con ')
         ->join('assign_receive ar', 'ar.consignment = con.id')
         ->join('customer cus', 'cus.id = con.customer')
         ->order_by("con.id", "DESC")
         ->offset($par['offst'])
         ->limit(10)
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function getconsignmentInfo_dp($par=[]){
     $cnd = [];

       $cnd["ad.delivery_person"] = $par['customer_id'];


     // $cnd["c.status!="] = "inactive";
     // $cnd["c.payment_status!="] = "due";
     $cnd["c.cons_status!="] = "cancelled";
     $cnd["c.status!="] = "inactive";
     $cnd["c.delivery_status="] = "in-transit";

     // if(isset($par['txt'])){
     //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
     // }
     $this->db->select('c.*,s.recipient_name,s.recipient_number,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city,s.s_lat,s.s_lng')
        ->from('consignment c ')
        // ->join('customer b', 'b.id = c.customer')
        ->join('assign_delivery ad', 'ad.consignment = c.id')
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

       $arr[$k]['s_lat'] = $v->s_lat;
       $arr[$k]['s_lng'] = $v->s_lng;

       $arr[$k]['recipient_city'] = $v->recipient_city;
       $arr[$k]['recipient_area'] = $v->recipient_area;
       $arr[$k]['recipient_address_2'] = $v->recipient_address_2;
       $arr[$k]['recipient_address'] = $v->recipient_address;
       $arr[$k]['consignment_id'] = $v->consignment_id;
       $arr[$k]['name'] = $v->recipient_name;
       $arr[$k]['cusotp'] = $v->cusotp;
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

   public function getconsignmentInfo_alldel($par=[]){
    $cnd = [];

      $cnd["ad.delivery_person"] = $par['customer_id'];


    // $cnd["c.status!="] = "inactive";
    // $cnd["c.payment_status!="] = "due";
    $cnd["c.cons_status!="] = "cancelled";
    $cnd["c.status!="] = "inactive";
    $cnd["c.delivery_status="] = "delivered";

    // if(isset($par['txt'])){
    //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
    // }
    $this->db->select('c.*,s.recipient_name,s.recipient_number,s.recipient_address,s.recipient_address_2,s.recipient_area,s.recipient_city')
       ->from('consignment c ')
       // ->join('customer b', 'b.id = c.customer')
       ->join('assign_delivery ad', 'ad.consignment = c.id')
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
      $arr[$k]['cusotp'] = $v->cusotp;
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

  public function getalldelivery_dp($par=[]) {
    $delivery_person = $par['customer_id'];
    $offset = $par['offst'];
   // $q = $this->db->query("SELECT c.company,c.address,c.phone, count(con.consignment_id) as totalDelivery FROM consignment con INNER JOIN assign_delivery ad ON con.id = ad.consignment INNER JOIN customer c ON con.customer = c.id WHERE con.status != 'inactive' AND con.delivery_status = 'delivered' AND ad.delivery_person = '".$delivery_person."' GROUP BY c.company LIMIT 10 OFFSET $offset;")->result_array();
   $q = $this->db->query("SELECT DATE_FORMAT(con.assigned_date,'%d, %b %Y') assignedDate,con.consignment_id,s.recipient_name,s.recipient_address,s.recipient_number FROM consignment con INNER JOIN assign_delivery ad ON con.id = ad.consignment INNER JOIN shiping s ON con.recipient_address = s.id WHERE con.status != 'inactive' AND con.delivery_status = 'delivered' AND ad.delivery_person = '".$delivery_person."' AND month(con.assigned_date)=month(now()) ORDER BY con.assigned_date DESC LIMIT 10 OFFSET $offset;")->result_array();
   return $q;
  }

  public function getalldelivery_dp_last($par=[]) {
    $delivery_person = $par['customer_id'];
    $offset = $par['offst'];
   // $q = $this->db->query("SELECT c.company,c.address,c.phone, count(con.consignment_id) as totalDelivery FROM consignment con INNER JOIN assign_delivery ad ON con.id = ad.consignment INNER JOIN customer c ON con.customer = c.id WHERE con.status != 'inactive' AND con.delivery_status = 'delivered' AND ad.delivery_person = '".$delivery_person."' GROUP BY c.company LIMIT 10 OFFSET $offset;")->result_array();
   $q = $this->db->query("SELECT DATE_FORMAT(con.assigned_date,'%d, %b %Y') assignedDate,con.consignment_id,s.recipient_name,s.recipient_address,s.recipient_number FROM consignment con INNER JOIN assign_delivery ad ON con.id = ad.consignment INNER JOIN shiping s ON con.recipient_address = s.id WHERE con.status != 'inactive' AND con.delivery_status = 'delivered' AND ad.delivery_person = '".$delivery_person."' AND month(con.assigned_date)=month(now())-1 ORDER BY con.assigned_date DESC LIMIT 10 OFFSET $offset;")->result_array();
   return $q;
  }

  public function getallreceived_dp($par=[]) {
    $delivery_person = $par['customer_id'];
    $offset = $par['offst'];
   $q = $this->db->query("SELECT DATE_FORMAT(con.timestamp,'%d, %b %Y') assigned_date,c.company,c.address,c.phone, count(con.consignment_id) as totalreceived FROM consignment con INNER JOIN assign_receive ar ON con.id = ar.consignment INNER JOIN customer c ON con.customer = c.id WHERE con.status != 'inactive' AND con.cons_status = 'received' AND con.delivery_status != 'cancelled' AND ar.delivery_person = '".$delivery_person."' AND month(con.timestamp)=month(now()) GROUP BY con.assigned_date DESC LIMIT 10 OFFSET $offset;")->result_array();
   return $q;
  }

  public function getallreceived_dp_last($par=[]) {
    $delivery_person = $par['customer_id'];
    $offset = $par['offst'];
   $q = $this->db->query("SELECT DATE_FORMAT(con.timestamp,'%d, %b %Y') assigned_date,c.company,c.address,c.phone, count(con.consignment_id) as totalreceived FROM consignment con INNER JOIN assign_receive ar ON con.id = ar.consignment INNER JOIN customer c ON con.customer = c.id WHERE con.status != 'inactive' AND con.cons_status = 'received' AND con.delivery_status != 'cancelled' AND ar.delivery_person = '".$delivery_person."' AND month(con.timestamp)=month(now())-1 GROUP BY con.assigned_date DESC LIMIT 10 OFFSET $offset;")->result_array();
   return $q;
  }

  public function get_alldel_lastmoth($par=[]){
    $delivery_person = $par['customerid'];
    // $offset = $par['offst'];
   $q = $this->db->query("SELECT count(con.consignment_id) as totalDelivery FROM consignment con INNER JOIN assign_delivery ad ON con.id = ad.consignment WHERE con.status != 'inactive' AND con.delivery_status = 'delivered' AND ad.delivery_person = '".$delivery_person."' AND month(assigned_date)=month(now())-1;")->result_array();
   return $q;
  }

  public function get_allreslastmoth($par=[]){
    $delivery_person = $par['customerid'];
    // $offset = $par['offst'];
   $q = $this->db->query("SELECT count(con.consignment_id) as totalReceived FROM consignment con INNER JOIN assign_receive ar ON con.id = ar.consignment WHERE con.status != 'inactive' AND con.delivery_status != 'cancelled' AND ar.delivery_person = '".$delivery_person."' AND month(assigned_date)=month(now())-1;")->result_array();
   return $q;
  }

  public function get_allresthismoth($par=[]){
    $delivery_person = $par['customerid'];
    // $offset = $par['offst'];
   $q = $this->db->query("SELECT count(con.consignment_id) as received_thismonth FROM consignment con INNER JOIN assign_receive ar ON con.id = ar.consignment WHERE con.status != 'inactive' AND con.delivery_status != 'cancelled' AND ar.delivery_person = '".$delivery_person."' AND month(assigned_date)=month(now())")->result_array();
   return $q;
  }

  public function get_alldel_thismoth($par=[]){
    $delivery_person = $par['customerid'];
    // $offset = $par['offst'];
   $q = $this->db->query("SELECT count(con.consignment_id) as delivered_thismonth FROM consignment con INNER JOIN assign_delivery ad ON con.id = ad.consignment WHERE con.status != 'inactive' AND con.delivery_status = 'delivered' AND ad.delivery_person = '".$delivery_person."' AND month(assigned_date)=month(now())")->result_array();
   return $q;
  }

  public function getfinance_dp($par=[]){
   $cnd = [];

     $cnd["exp.name"] = $par['customer_id'];

   $this->db->select('exp.name,exp.voucher_no,exp.exp_type,exp.narration,exp.cash_out,exp.exp_date')
      ->from('expenses exp ')
      ->order_by("exp.id", "DESC")
      ->offset($par['offst'])
      ->limit(10)
      ->where($cnd);
   $query =  $this->db->get();
   $res =  $query->result();
   $arr = [];
   foreach($res as $k=>$v){
     $arr[$k]['name'] = $v->name;
     $arr[$k]['receipt_no'] = $v->voucher_no;
     $arr[$k]['exp_type'] = $v->exp_type;
     $arr[$k]['narration'] = $v->narration;
     $arr[$k]['amount'] = $v->cash_out;
     $arr[$k]['exp_date'] = $v->exp_date;
   return $arr;
 }

}
}
