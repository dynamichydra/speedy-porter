<?php

class Report_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_status() {
		 $q = $this->db->query("SELECT c.* FROM consignment c WHERE c.status <> 'inactive' group by c.delivery_status")->result_array();
		 return $q;
    }

    public function get_payment_status() {
		 $q = $this->db->query("SELECT c.* FROM consignment c WHERE c.status <> 'inactive' group by c.payment_status")->result_array();
		 return $q;
    }

    public function get_all_order_list($par=[]){
     $cnd = [];
     if(isset($par['con_status'])){
       $cnd["con.status"] = $par['con_status'];
     }

     if(isset($par['branch'])){
       $cnd["con.branch"] = $par['branch'];
     }

     if(isset($par['sel_branch'])){
       $cnd["con.branch"] = $par['sel_branch'];
     }

     if(isset($par['customer_id'])){
       $cnd["con.customer"] = $par['customer_id'];
     }
     if(isset($par['status'])){
       $cnd["con.delivery_status"] = $par['status'];
     }
     if(isset($par['from_date'])){
       $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }else{
       $cnd["DATE(con.timestamp) > now() - interval 1 month "] = null;
     }



     if(isset($par['to_date'])){
       $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }
     $cnd["con.status!="] = "inactive";
     // $cnd["con.status"] = "assigned";
     // $cnd["con.by_merchant"] = 1;

     $this->db->select('con.*,s.recipient_number,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_area,c.name as cus_name,c.company as cus_company,c.phone as cus_contact,b.name as branchname, DATE_FORMAT(con.timestamp,"%d, %b %Y %h:%m %p") timestamp, DATE_FORMAT(con.delivery_date,"%d, %b %Y") delivery_date')
        ->from('consignment con ')
        ->join('customer c', 'c.id = con.customer')
        ->join('branch b', 'b.id = con.branch')
        // ->join('package p', 'p.id = con.package_name')
        ->join('shiping s', 's.id = con.recipient_address')
        // ->join('assign_delivery ad', 'ad.consignment = con.id')
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

     if(isset($par['delivery_person_id'])){
       $cnd["dp.id"] = $par['delivery_person_id'];
     }
     if(isset($par['status'])){
       $cnd["con.delivery_status"] = $par['status'];
     }
     if(isset($par['from_date'])){
       $cnd["con.delivery_date >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }

     if(isset($par['to_date'])){
       $cnd["con.delivery_date <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }
     $cnd["con.status"] = "assigned";

     $this->db->select('con.consignment_id,con.product_id,con.promo_code,con.grand_total,con.product_price,con.no_of_items,con.item_types,con.total_price,s.recipient_address,s.recipient_city,s.recipient_area,c.name as cus_name,p.name as pack_name,p.price as pack_price, DATE_FORMAT(con.delivery_date,"%d, %b %Y") delivery_date,dp.name as dp_name')
        ->from('consignment con ')
        ->join('customer c', 'c.id = con.customer')
        ->join('package p', 'p.id = con.package_name')
        ->join('shiping s', 's.id = con.recipient_address')
        ->join('assign_delivery ad', 'ad.consignment = con.id')
        ->join('delivery_person dp', 'dp.id=ad.delivery_person')
        ->where($cnd);
     $query =  $this->db->get();
     $res =  $query->result();
     return $res;
   }

    public function get_all_listed($par=[]) {
      $cnd = [];
      if(isset($par['customer_id'])){
        $cnd["con.customer"] = $par['customer_id'];
      }
      if(isset($par['status'])){
        $cnd["con.delivery_status"] = $par['status'];
      }
      if(isset($par['from_date'])){
        $cnd["con.delivery_date >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["con.delivery_date <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }
      $cnd["con.status"] = "assigned";
      $cnd["ad.delivery_person"] = $par['deliveryBoyId'];

      $this->db->select('con.consignment_id,con.product_id,con.promo_code,con.product_price,con.grand_total,con.no_of_items,con.item_types,con.total_price,s.recipient_address,s.recipient_city,s.recipient_area,c.name as cus_name,p.name as pack_name,p.price as pack_price, DATE_FORMAT(con.delivery_date,"%d, %b %Y") delivery_date,dp.name as dp_name')
         ->from('consignment con ')
         ->join('customer c', 'c.id = con.customer')
         ->join('package p', 'p.id = con.package_name')
         ->join('shiping s', 's.id = con.recipient_address')
         ->join('assign_delivery ad', 'ad.consignment = con.id')
         ->join('delivery_person dp', 'dp.id=ad.delivery_person')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result();
      return $res;
    }


    public function get_all_listBybUser($par=[]) {
      $cnd = [];
      if(isset($par['userName'])){
        $cnd["con.created_by"] = $par['userName'];
      }
      if(isset($par['merchant_id'])){
        $cnd["con.customer"] = $par['merchant_id'];
      }
      if(isset($par['status'])){
        $cnd["con.delivery_status"] = $par['status'];
      }
      if(isset($par['from_date'])){
        $cnd["con.delivery_date >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["con.delivery_date <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }
      $cnd["con.status"] = "assigned";

      $this->db->select('con.consignment_id,con.product_id,con.promo_code,con.grand_total,con.product_price,con.no_of_items,con.item_types,con.total_price,s.recipient_address,s.recipient_city,s.recipient_area,c.name as cus_name,p.name as pack_name,p.price as pack_price, DATE_FORMAT(con.delivery_date,"%d, %b %Y") delivery_date,dp.name as dp_name')
         ->from('consignment con ')
         ->join('customer c', 'c.id = con.customer')
         ->join('package p', 'p.id = con.package_name')
         ->join('shiping s', 's.id = con.recipient_address')
         ->join('assign_delivery ad', 'ad.consignment = con.id')
         ->join('delivery_person dp', 'dp.id=ad.delivery_person')
         // ->join('branch br', 'br.id=ad.delivery_person')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result();
      return $res;
    }

    public function get_all_listBydeliveries($par=[]) {
      $cnd = [];
      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }
      // if(isset($par['status'])){
      //   $cnd["con.delivery_status"] = $par['status'];
      // }
      if(isset($par['from_date'])){
        $cnd["con.delivered_date >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["con.delivered_date <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }
      $cnd["con.status"] = "assigned";

      $this->db->select('Count(delivery_status) as totaldeliveries,dp.name as dp_name,dp.phone as dp_phone,dp.email as dp_email,dp.address as dp_address')
         ->from('consignment con ')
         ->join('assign_delivery ad', 'ad.consignment = con.id')
         ->join('delivery_person dp', 'dp.id=ad.delivery_person')
         // ->join('branch br', 'br.id=ad.delivery_person')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result();
      return $res;
    }

    public function get_all_listByBranchCount($par=[]) {
      $cnd = [];
      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      if(isset($par['sel_branch'])){
        $cnd["con.branch"] = $par['sel_branch'];
      }

      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }else{
     $cnd["DATE(con.timestamp) > now() - interval 1 month "] = null;
   }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      // $cnd["con.delivery_status!="] = "cancelled";
      // if($_SESSION['user_type'] == 'admin'){
        $cnd["con.branch!="] = 11;
      // }
      // $cnd["con.branch!="] = "11";
      // $cnd["bd.status!="] = "Picked-up from";

      $this->db->select('con.*,b.name as branchname,s.recipient_address,s.recipient_name,s.recipient_number,c.name as cus_name,c.company as cus_company,c.phone as cus_contact,p.name as pack_name,p.price as pack_price, DATE_FORMAT(con.timestamp,"%d, %b %Y") order_date, DATE_FORMAT(con.delivery_date,"%d, %b %Y") delivery_date,dp.name as dp_name')
         ->from('consignment con ')
         ->join('branch b', 'b.id = con.branch')
         ->join('assign_delivery ad', 'ad.consignment = con.id')
         ->join('delivery_person dp', 'dp.id=ad.delivery_person')
         ->join('customer c', 'c.id = con.customer')
         ->join('package p', 'p.id = con.package_name')
         ->join('shiping s', 's.id = con.recipient_address')
         ->order_by("con.id", "DESC")
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result();
      return $res;
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

   public function getconsignmentInfomerchantpayout($par=[]){
    $cnd = [];
    if(isset($par['customer_id'])){
      $cnd["b.id"] = $par['customer_id'];
    }
    if(isset($par['pstatus'])){
      $cnd["c.payment_status_merchant"] = $par['pstatus'];
    }
    if(isset($par['from_date'])){
      $cnd["DATE(c.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
    }else{
     $cnd["DATE(c.timestamp) > now() - interval 1 month "] = null;
   }

    if(isset($par['sel_branch'])){
      $cnd["c.branch"] = $par['sel_branch'];
    }

    if(isset($par['to_date'])){
      $cnd["DATE(c.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
    }
    $cnd["c.collection_status"] = "received";
    $cnd["c.status!="] = "inactive";
    $cnd["c.cons_status!="] = "cancelled";
    $cnd["c.delivery_status!="] = "cancelled";

    // if(isset($par['txt'])){
    //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
    // }
    $this->db->select('c.*,b.name as customer_name,b.phone as cust_contact,b.company as cus_company,s.recipient_name as recipient_name,s.recipient_address as recipient_address,s.recipient_number as recipient_number')
       ->from('consignment c ')
       ->join('customer b', 'b.id = c.customer')
       ->join('shiping s', 's.id = c.recipient_address','left')
       // ->limit(2000)
       // ->join('symptoms s', 's.id = b.symptom','left')
       // ->join('doctor d', 'd.id = b.doctor','left')
       ->order_by("c.id", "DESC")
       ->where($cnd);
    $query =  $this->db->get();
    $res =  $query->result();
    $arr = [];
    foreach($res as $k=>$v){
      $arr[$k]['customer_name'] = $v->customer_name;
      $arr[$k]['cust_contact'] = $v->cust_contact;
      $arr[$k]['cus_company'] = $v->cus_company;
      $arr[$k]['product_id'] = $v->product_id;

      $arr[$k]['recipient_name'] = $v->recipient_name;
      $arr[$k]['recipient_address'] = $v->recipient_address;
      $arr[$k]['recipient_number'] = $v->recipient_number;
      $arr[$k]['id'] = $v->id;
      $arr[$k]['consignment_id'] = $v->consignment_id;
      $arr[$k]['name'] = $v->customer_name;
      $arr[$k]['weight'] = $v->total_weight;
      $arr[$k]['product_price'] = $v->total_price_product;
      $arr[$k]['delivery_charge'] = $v->total_price;
      $arr[$k]['payment_status'] = $v->payment_status;
      $arr[$k]['payment_status_merchant'] = $v->payment_status_merchant;
      $arr[$k]['timestamp'] = $v->timestamp;
      $arr[$k]['delivery_date'] = $v->delivery_date;
      $arr[$k]['delivery_status'] = $v->delivery_status;
      $arr[$k]['amount_paid'] = $v->amount_paid;
      $arr[$k]['grand_total'] = $v->grand_total;
      $arr[$k]['merchant_payout'] = $v->merchant_payout;
      $arr[$k]['paytomerch'] = $v->paytomerch;
      $arr[$k]['cash_collection'] = $v->cash_collection;
      $arr[$k]['less_paid_return'] = $v->less_paid_return;
      $arr[$k]['total_cod_charge'] = $v->total_cod_charge;
      $arr[$k]['return_extra'] = $v->return_extra;
      $arr[$k]['deduction_amount'] = $v->deduction_amount;
      $arr[$k]['deduction_status'] = $v->deduction_status;
      $arr[$k]['extra_amount'] = $v->extra_amount;
      // $arr[$k]['status'] = $v->status;
      // $arr[$k]['dr_name'] = $v->dr_name;
      // $arr[$k]['dname'] = $v->dname;
      // $arr[$k]['js_time'] = $v->bdate.'T'.date('H:i:s',strtotime($v->bdate.' '.$v->time)).'+08:00';
    }
    return $arr;
  }

  public function getconsignmentInfomerchantpayout_bybranch($par=[]){
   $cnd = [];
   if(isset($par['customer_id'])){
     $cnd["c.customer"] = $par['customer_id'];
   }
   if(isset($par['pstatus'])){
     $cnd["c.payment_status_merchant"] = $par['pstatus'];
   }
   if(isset($par['from_date'])){
     $cnd["c.delivery_date >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
   }

   if(isset($par['to_date'])){
     $cnd["c.delivery_date <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
   }
   $cnd["c.status"] = "assigned";
   $cnd["c.created_by"] = $par['created_by'];
   // if(isset($par['txt'])){
   //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
   // }
   $this->db->select('c.*,b.name customer_name')
      ->from('consignment c ')
      ->join('customer b', 'b.id = c.customer')
      // ->join('symptoms s', 's.id = b.symptom','left')
      // ->join('doctor d', 'd.id = b.doctor','left')
      ->where($cnd);
   $query =  $this->db->get();
   $res =  $query->result();
   $arr = [];
   foreach($res as $k=>$v){
     $arr[$k]['id'] = $v->id;
     $arr[$k]['consignment_id'] = $v->consignment_id;
     $arr[$k]['name'] = $v->customer_name;
     $arr[$k]['weight'] = $v->total_weight;
     $arr[$k]['product_price'] = $v->total_price_product;
     $arr[$k]['delivery_charge'] = $v->total_price;
     $arr[$k]['payment_status'] = $v->payment_status;
     $arr[$k]['payment_status_merchant'] = $v->payment_status_merchant;
     $arr[$k]['timestamp'] = $v->delivery_date;
     $arr[$k]['amount_paid'] = $v->amount_paid;
     $arr[$k]['grand_total'] = $v->grand_total;
     $arr[$k]['merchant_payout'] = $v->merchant_payout;
     // $arr[$k]['status'] = $v->status;
     // $arr[$k]['dr_name'] = $v->dr_name;
     // $arr[$k]['dname'] = $v->dname;
     // $arr[$k]['js_time'] = $v->bdate.'T'.date('H:i:s',strtotime($v->bdate.' '.$v->time)).'+08:00';
   }
   return $arr;
 }

  public function getconsignmentInfomerchantpayout_combined($par=[]){
   $cnd = [];
   if(isset($par['customer_id'])){
     $cnd["c.customer"] = $par['customer_id'];
   }
   if(isset($par['pstatus'])){
     $cnd["c.payment_status"] = $par['pstatus'];
   }
   if(isset($par['from_date'])){
     $cnd["c.delivery_date >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
   }

   if(isset($par['to_date'])){
     $cnd["c.delivery_date <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
   }
   $cnd["c.status"] = "assigned";

   // if(isset($par['txt'])){
   //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
   // }
   $this->db->select('SELECT SUM(total_price) as total_amount')
      ->from('consignment c ')
      ->join('customer b', 'b.id = c.customer')
      // ->join('symptoms s', 's.id = b.symptom','left')
      // ->join('doctor d', 'd.id = b.doctor','left')
      ->where($cnd);
   $query =  $this->db->get();
   $res =  $query->result();
   $arr = [];
   foreach($res as $k=>$v){
     $arr[$k]['id'] = $v->id;
     $arr[$k]['consignment_id'] = $v->consignment_id;
     $arr[$k]['name'] = $v->customer_name;
     $arr[$k]['weight'] = $v->total_weight;
     $arr[$k]['product_price'] = $v->total_price_product;
     $arr[$k]['delivery_charge'] = $v->total_price;
     $arr[$k]['payment_status'] = $v->payment_status;
     $arr[$k]['payment_status_merchant'] = $v->payment_status_merchant;
     $arr[$k]['timestamp'] = $v->delivery_date;
     $arr[$k]['amount_paid'] = $v->amount_paid;
     $arr[$k]['grand_total'] = $v->grand_total;
     $arr[$k]['merchant_payout'] = $v->merchant_payout;
     // $arr[$k]['status'] = $v->status;
     // $arr[$k]['dr_name'] = $v->dr_name;
     // $arr[$k]['dname'] = $v->dname;
     // $arr[$k]['js_time'] = $v->bdate.'T'.date('H:i:s',strtotime($v->bdate.' '.$v->time)).'+08:00';
   }
   return $arr;
 }

   public function getconsignmentInfoAll($par=[]){
    $cnd = [];
    if(isset($par['branch'])){
      $cnd["c.branch"] = $par['branch'];
    }

    if(isset($par['sel_branch'])){
      $cnd["c.branch"] = $par['sel_branch'];
    }
    // if(isset($par['status'])){
    //   $cnd["c.delivery_status"] = $par['status'];
    // }
    if(isset($par['from_date'])){
      $cnd["DATE(c.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
    }else{
     $cnd["DATE(c.timestamp) > now() - interval 1 month "] = null;
   }

    if(isset($par['to_date'])){
      $cnd["DATE(c.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
    }
    // $cnd["c.status"] = "assigned";
    $cnd["c.status!="] = "inactive";
    $cnd["c.delivery_status!="] = "cancelled";

    // if(isset($par['txt'])){
    //   $cnd[" (b.name like '%{$par['txt']}%' OR b.phone like '%{$par['txt']}%' OR b.symptom like '%{$par['txt']}%') "] = null;
    // }
    $this->db->select('c.*,br.name as brname,dp.name as dp_name,b.name customer_name,b.company customer_company,b.phone customer_contact,s.recipient_address shiping_address,s.recipient_name recipient_name,s.recipient_number recipient_number')
       ->from('consignment c ')
       ->join('branch br', 'br.id = c.branch')
       ->join('customer b', 'b.id = c.customer')
       // ->join('package p', 'p.id = c.package_name','left')
       ->join('shiping s', 's.id = c.recipient_address')
       ->join('assign_delivery ad', 'c.id=ad.consignment')
       ->join('delivery_person dp', 'dp.id=ad.delivery_person')
       ->order_by("c.id", "DESC")
       ->where($cnd);
    $query =  $this->db->get();
    $res =  $query->result();
    $arr = [];
    foreach($res as $k=>$v){
      $arr[$k]['dp_name'] = $v->dp_name;
      $arr[$k]['customer_company'] = $v->customer_company;
      $arr[$k]['customer_contact'] = $v->customer_contact;
      $arr[$k]['parcel_category'] = $v->parcel_category;
      $arr[$k]['brname'] = $v->brname;
      $arr[$k]['delivery_status'] = $v->delivery_status;
      $arr[$k]['id'] = $v->id;
      $arr[$k]['consignment_id'] = $v->consignment_id;
      $arr[$k]['customer_name'] = $v->customer_name;
      $arr[$k]['weight'] = $v->total_weight;
      $arr[$k]['product_price'] = $v->total_price_product;
      $arr[$k]['delivery_charge'] = $v->total_price;
      $arr[$k]['payment_status'] = $v->payment_status;
      $arr[$k]['timestamp'] = $v->timestamp;
      $arr[$k]['amount_paid'] = $v->amount_paid;
      $arr[$k]['product_id'] = $v->product_id;
      $arr[$k]['item_types'] = $v->item_types;
      $arr[$k]['product_price'] = $v->product_price;
      $arr[$k]['no_of_items'] = $v->no_of_items;
      $arr[$k]['delivery_date'] = $v->delivery_date;
      $arr[$k]['assigned_date'] = $v->assigned_date;
      $arr[$k]['package_name'] = $v->package_name;
      $arr[$k]['shiping_address'] = $v->shiping_address;
      $arr[$k]['recipient_name'] = $v->recipient_name;
      $arr[$k]['recipient_number'] = $v->recipient_number;
      $arr[$k]['grand_total'] = $v->grand_total;
      $arr[$k]['amounttocollect'] = $v->amounttocollect;
      $arr[$k]['less_paid_return'] = $v->less_paid_return;
      $arr[$k]['paytomerch'] = $v->paytomerch;
      $arr[$k]['narration'] = $v->narration;
      $arr[$k]['cash_collection'] = $v->cash_collection;
      $arr[$k]['transfer_from'] = $v->transfer_from;
      // $arr[$k]['office'] = $v->office;
      // $arr[$k]['js_time'] = $v->bdate.'T'.date('H:i:s',strtotime($v->bdate.' '.$v->time)).'+08:00';
    }
    return $arr;
  }

  public function get_all_tracking($consignmentId) {
   $q = $this->db->query("SELECT t.*,b.name branch_name FROM tracking t INNER JOIN branch b ON t.branch = b.id WHERE t.consignmentId = '$consignmentId'")->result_array();
   return $q;
  }

  // public function get_merInfo($customerId) {
  //  $q = $this->db->query("SELECT c.*,mer.name mer_name,mer.phone mer_phone,mer.email mer_email FROM consignment c INNER JOIN customer mer ON c.customer = mer.id WHERE c.customer = '$customerId'")->result_array();
  //  return $q;
  // }

  public function get_userType() {
   $q = $this->db->query("SELECT u.* FROM users u group by u.user_type")->result_array();
   return $q;
  }

  public function get_userTypeDP() {
   $q = $this->db->query("SELECT dp.* FROM delivery_person dp group by dp.user_type")->result_array();
   return $q;
  }

  public function get_transcopy($par=[]){
   $cnd = [];
   if(isset($par['transprtr'])){
     $cnd["dp.id"] = $par['transprtr'];
   }
   if(isset($par['sel_branch'])){
     $cnd["con.branch"] = $par['sel_branch'];
   }

   if(isset($par['from_date'])){
     $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
   }else{
     $cnd["DATE(con.timestamp) > now() - interval 1 month "] = null;
   }

   if(isset($par['to_date'])){
     $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
   }
   $cnd["con.status!="] = "inactive";
   // $cnd["con.delivery_status!="] = "cancelled";
   // $cnd["con.created_by"] = $this->session->userdata('id');
   // print_r($cnd);die;

   $this->db->select('con.*,b.name as branchname,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_postalcode,s.recipient_number,s.recipient_area,dp.name as transporter,cus.company,cus.name,cus.phone')
      ->from('consignment con ')
      ->join('branch b', 'b.id = con.branch')
      ->join('shiping s', 's.id = con.recipient_address')
      ->join('assign_delivery ad', 'con.id=ad.consignment')
      ->join('delivery_person dp', 'dp.id=ad.delivery_person')
      ->join('customer cus', 'con.customer=cus.id')
      ->order_by("con.id", "DESC")
      ->where($cnd);
   $query =  $this->db->get();
   $res =  $query->result();
   return $res;
 }

  public function get_delcharge($par=[]){
   $cnd = [];
   if(isset($par['branch'])){
     $cnd["con.branch"] = $par['branch'];
   }

   if(isset($par['c_status'])){
     $cnd["con.payment_status_merchant"] = $par['c_status'];
   }

   if(isset($par['sel_branch'])){
     $cnd["con.branch"] = $par['sel_branch'];
   }

   if(isset($par['from_date'])){
     $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
   }else{
     $cnd["DATE(con.timestamp) > now() - interval 1 month "] = null;
   }

   if(isset($par['to_date'])){
     $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
   }
   $cnd["con.status!="] = "inactive";
   $cnd["con.delivery_status!="] = "cancelled";
   // $cnd["con.created_by"] = $this->session->userdata('id');

   $this->db->select('con.*,b.name as branchname,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_postalcode,s.recipient_number,s.recipient_area,cus.company,cus.name,cus.phone')
      ->from('consignment con ')
      ->join('branch b', 'b.id = con.branch')
      ->join('shiping s', 's.id = con.recipient_address')
      // ->join('assign_delivery ad', 'con.id=ad.consignment')
      // ->join('delivery_person dp', 'dp.id=ad.delivery_person')
      ->join('customer cus', 'con.customer=cus.id')
      ->order_by("con.id", "DESC")
      ->where($cnd);
   $query =  $this->db->get();
   $res =  $query->result();
   return $res;
 }


 public function get_totalreceived($par=[]){
  $cnd = [];

  if(isset($par['from_date'])){
    $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status!="] = 'cancelled';
  $cnd["con.cons_status"] = "received";
  $cnd["assign_rec.delivery_person"] = $par['tp_id'];

  $this->db->select('con.*')
     ->from('consignment con')
     ->join('assign_receive assign_rec', 'assign_rec.consignment = con.id')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result();
  return count($res);
}


 public function get_totalreceive($dboyId) {
  $q = $this->db->query("SELECT Count(cons_status) totalreceive
 FROM consignment LEFT JOIN assign_receive
 ON assign_receive.consignment = consignment.id
 WHERE consignment.cons_status = 'received' AND assign_receive.delivery_person = $dboyId")->result_array();
  return $q;
 }

 public function get_alldeliveried($par=[]){
  $cnd = [];

  if(isset($par['from_date'])){
    $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = "delivered";
  $cnd["assign_del.delivery_person"] = $par['tp_id'];

  $this->db->select('con.*')
     ->from('consignment con')
     ->join('assign_delivery assign_del', 'assign_del.consignment = con.id')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result();
  return count($res);
 }

public function get_alldeliveries($dboyId) {
 $q = $this->db->query("SELECT Count(delivery_status) totaldeliveries
FROM consignment LEFT JOIN assign_delivery
ON assign_delivery.consignment = consignment.id
WHERE consignment.delivery_status = 'delivered' AND assign_delivery.delivery_person = $dboyId")->result_array();
 return $q;
}

public function get_allreturned($par=[]){
 $cnd = [];

 if(isset($par['from_date'])){
   $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
 }

 if(isset($par['to_date'])){
   $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
 }
 $cnd["con.delivery_status"] = "returned";
 $cnd["assign_del.delivery_person"] = $par['tp_id'];

 $this->db->select('con.*')
    ->from('consignment con')
    ->join('assign_delivery assign_del', 'assign_del.consignment = con.id')
    ->where($cnd);
 $query =  $this->db->get();
 $res =  $query->result();
 return count($res);
}

public function get_allreturns($dboyId) {
 $q = $this->db->query("SELECT Count(delivery_status) totalreturns
FROM consignment LEFT JOIN assign_delivery
ON assign_delivery.consignment = consignment.id
WHERE consignment.delivery_status = 'returned' AND assign_delivery.delivery_person = $dboyId")->result_array();
 return $q;
}

public function get_all_deducted_returned($par=[]){
 $cnd = [];

 if(isset($par['from_date'])){
   $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
 }

 if(isset($par['to_date'])){
   $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
 }
 $cnd["con.delivery_status"] = "returned";
 $cnd["con.deduction_status"] = 1;
 $cnd["assign_del.delivery_person"] = $par['tp_id'];

 $this->db->select('con.*')
    ->from('consignment con')
    ->join('assign_delivery assign_del', 'assign_del.consignment = con.id')
    ->where($cnd);
 $query =  $this->db->get();
 $res =  $query->result();
 return count($res);
}

public function get_all_deducted_returns($dboyId){
  $q = $this->db->query("SELECT Count(delivery_status) total_deductreturns
  FROM consignment LEFT JOIN assign_delivery
  ON assign_delivery.consignment = consignment.id
  WHERE consignment.delivery_status = 'returned' AND consignment.deduction_status = 1  AND assign_delivery.delivery_person = $dboyId")->result_array();
  return $q;
}

public function get_all_nondeducted_returned($par=[]){
 $cnd = [];

 if(isset($par['from_date'])){
   $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
 }

 if(isset($par['to_date'])){
   $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
 }
 $cnd["con.delivery_status"] = "returned";
 $cnd["con.deduction_status"] = 0;
 $cnd["assign_del.delivery_person"] = $par['tp_id'];

 $this->db->select('con.*')
    ->from('consignment con')
    ->join('assign_delivery assign_del', 'assign_del.consignment = con.id')
    ->where($cnd);
 $query =  $this->db->get();
 $res =  $query->result();
 return count($res);
}

public function get_all_nondeducted_returns($dboyId){
  $q = $this->db->query("SELECT Count(delivery_status) total_nondeductreturns
  FROM consignment LEFT JOIN assign_delivery
  ON assign_delivery.consignment = consignment.id
  WHERE consignment.delivery_status = 'returned' AND consignment.deduction_status = 0  AND assign_delivery.delivery_person = $dboyId")->result_array();
  return $q;
}

public function get_all_rescheduled($par=[]){
 $cnd = [];

 if(isset($par['from_date'])){
   $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
 }

 if(isset($par['to_date'])){
   $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
 }
 $cnd["con.new_deliverydate!="] = "1970-01-01";
 $cnd["assign_del.delivery_person"] = $par['tp_id'];

 $this->db->select('con.*')
    ->from('consignment con')
    ->join('assign_delivery assign_del', 'assign_del.consignment = con.id')
    ->where($cnd);
 $query =  $this->db->get();
 $res =  $query->result();
 return count($res);
}

public function get_all_res($dboyId){
  $q = $this->db->query("SELECT Count(delivery_status) total_res
  FROM consignment LEFT JOIN assign_delivery
  ON assign_delivery.consignment = consignment.id
  WHERE  consignment.new_deliverydate  != '1970-01-01'  AND assign_delivery.delivery_person = $dboyId")->result_array();
  return $q;
}

public function get_cashreport($par=[]){
 $cnd = [];
 if(isset($par['transprtr'])){
   $cnd["dp.id"] = $par['transprtr'];
 }
 if(isset($par['sel_branch'])){
   $cnd["con.branch"] = $par['sel_branch'];
 }

 if(isset($par['from_date'])){
   $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
 }else{
     $cnd["DATE(con.timestamp) > now() - interval 1 month "] = null;
   }

 if(isset($par['to_date'])){
   $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
 }
 // $cnd["con.status!="] = "inactive";
 // $cnd["con.delivery_status!="] = "cancelled";
 $cnd["con.status"] = "assigned";
 // $cnd["con.collection_status"] = "received";

 $this->db->select('con.*,b.name as branchname,s.recipient_name,s.recipient_address,s.recipient_city,s.recipient_postalcode,s.recipient_number,s.recipient_area,dp.name as transporter,cus.company,cus.name,cus.phone')
    ->from('consignment con ')
    ->join('branch b', 'b.id = con.branch')
    ->join('shiping s', 's.id = con.recipient_address')
    ->join('assign_delivery ad', 'con.id=ad.consignment')
    ->join('delivery_person dp', 'dp.id=ad.delivery_person')
    ->join('customer cus', 'con.customer=cus.id')
    ->order_by("con.id", "DESC")
    ->where($cnd);
 $query =  $this->db->get();
 $res =  $query->result();
 return $res;
}

public function get_cancel($par=[]){
 $cnd = [];
 if(isset($par['company'])){
   $cnd["con.branch"] = $par['company'];
 }

 if(isset($par['merch_id'])){
   $cnd["con.customer"] = $par['merch_id'];
 }

 if(isset($par['from_date'])){
   $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
 }else{
     $cnd["DATE(con.timestamp) > now() - interval 1 month "] = null;
   }

 if(isset($par['to_date'])){
   $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
 }
 // $cnd["con.receive_status"] = "assigned";
 $cnd["con.status!="] = "inactive";
 $cnd["con.delivery_status"] = "cancelled";
  $cnd["con.cons_status"] = "cancelled";
 // $cnd["con.created_by"] = $this->session->userdata('id');

 $this->db->select('con.*,s.recipient_name as s_name,s.recipient_address as s_address,s.recipient_number as s_number')
    ->from('consignment con ')
    ->join('shiping s', 's.id = con.recipient_address')
    // ->join('delivery_person dp', 'dp.id=ad.delivery_person')
    ->order_by("con.id", "DESC")
    ->where($cnd);
 $query =  $this->db->get();
 $res =  $query->result();
 $res =  $query->result_array();
 return $res;
}

public function get_transporter($consid) {
 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
 $q = $this->db->query("SELECT dp.name as transporter, ad.id as editid FROM assign_receive ad INNER JOIN delivery_person dp ON ad.delivery_person = dp.id WHERE ad.consignment = $consid")->result_array();
 return $q;
}

public function get_merch_pay_status() {
 $q = $this->db->query("SELECT c.payment_status_merchant FROM consignment c WHERE c.status <> 'inactive' group by c.payment_status_merchant")->result_array();
 return $q;
}

public function get_all_tickets_report($par=[]){
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
 $cnd["t.status="] = 'close';

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

}
