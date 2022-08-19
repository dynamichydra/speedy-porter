<?php

class General_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_where_all($tbl_name = '', $data = [], $limit = '', $offset = '', $order_key = '', $order = '') {

        if (($limit != '' && $offset != '')) {
            $query = $this->db->get_where($tbl_name, $data, $limit, $offset);
        } elseif ($order_key != '' && $order != '') {
            $this->db->order_by($order_key, $order);
            $query = $this->db->get_where($tbl_name, $data);
        } else {
            $query = $this->db->get_where($tbl_name, $data);
        }

        return $query->result_array();
    }

    public function get_where_like($tbl_name = '', $data = '') {

        $this->db->like($data);
        $query = $this->db->get_where($tbl_name);
        return $query->result_array();
    }

    public function get_where_in($tbl_name = '', $selector = '', $data = '') {

        $this->db->from($tbl_name);
        $query = $this->db->where_in($selector, $data);
        return $query->get()->result();
    }

    public function insert($tbl_name = '', $data = '') {
        $this->db->insert($tbl_name, $data);
        return $this->db->insert_id();
    }

//     public function get_all_order_today($byid) {
//       if($byid == ""){
// 		 $q = $this->db->query("SELECT COUNT(*) as total_order_today
// FROM consignment
// WHERE status <> 'inactive' AND str_to_date(timestamp, '%Y-%m-%d') = curdate()")->result_array();
// 		 return $q;
//   }else{
//     $q = $this->db->query("SELECT COUNT(*) as total_order_today
// FROM consignment
// WHERE status <> 'inactive' AND created_by = $byid AND str_to_date(timestamp, '%Y-%m-%d') = curdate()")->result_array();
//     return $q;
//
//   }
// }

public function get_all_order_today($par=[]) {
  // print_r($par);die;
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  if(isset($par['branch'])){
    $cnd["con.branch"] = $par['branch'];
  }

  // $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  // $cnd["con.cons_status!="] = 'cancelled';

  $this->db->select('COUNT(*) as total_order')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}


public function get_allorder($par=[]) {
  // print_r($par);die;
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  // $cnd["con.cons_status!="] = 'cancelled';

  $this->db->select('COUNT(*) as total_order')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function getorder_today($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  if(isset($par['branch'])){
    $cnd["con.branch"] = $par['branch'];
  }

  // $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'pending';

  $this->db->select('COUNT(*) as total_order_today')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_order_todayforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'pending';

  $this->db->select('COUNT(*) as total_order_today')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_deliveredforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'delivered';

  $this->db->select('COUNT(*) as total_delivery_till_date')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_cancelledforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  // $cnd["con.cons_status"] = 'cancelled';
  $cnd["con.delivery_status"] = 'cancelled';

  $this->db->select('COUNT(*) as total_cancelled_till_date')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_receivedforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status!="] = 'cancelled';
  $cnd["con.cons_status"] = 'received';

  $this->db->select('COUNT(*) as total_receved')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_transit($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  if(isset($par['branch'])){
    $cnd["con.branch"] = $par['branch'];
  }

  // $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'in-transit';

  $this->db->select('COUNT(*) as total_intransit')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_transitforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'in-transit';

  $this->db->select('COUNT(*) as total_intransit')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_rescheduleforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'reschedule';

  $this->db->select('COUNT(*) as total_reschedule')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

public function get_all_returnforcustomer($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'returned';

  $this->db->select('COUNT(*) as total_return')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}



public function get_cahnge(){
  $q = $this->db->query("SELECT * FROM trans_history WHERE updates = 0 LIMIT 10")->result_array();
  return $q;
}

//     public function get_all_delivered_today($byid) {
//       if($byid == ""){
// 		 $q = $this->db->query("SELECT COUNT(*) as total_delivery
// FROM consignment
// WHERE delivery_status = 'delivered' AND status <> 'inactive' AND str_to_date(delivered_date, '%Y-%m-%d') = curdate()")->result_array();
// 		 return $q;
//    }else{
//      $q = $this->db->query("SELECT COUNT(*) as total_delivery
// FROM consignment
// WHERE delivery_status = 'delivered' AND created_by = $byid AND status <> 'inactive' AND str_to_date(delivered_date, '%Y-%m-%d') = curdate()")->result_array();
// 		 return $q;
//    }
//     }

public function get_all_received($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  if(isset($par['branch'])){
    $cnd["con.branch"] = $par['branch'];
  }

  // $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status!="] = 'cancelled';
  $cnd["con.cons_status"] = 'received';

  $this->db->select('COUNT(*) as total_receved')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}

//     public function get_all_delivered($byid) {
//       if($byid == ""){
// 		 $q = $this->db->query("SELECT COUNT(*) as total_delivery_till_date
// FROM consignment
// WHERE delivery_status = 'delivered' AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }else{
//      $q = $this->db->query("SELECT COUNT(*) as total_delivery_till_date
// FROM consignment
// WHERE delivery_status = 'delivered' AND created_by = $byid  AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }
//     }

    public function get_all_delivered($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      $cnd["con.delivery_status"] = 'delivered';

      $this->db->select('COUNT(*) as total_delivery_till_date')
         ->from('consignment con')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

//     public function get_all_rescheduled($byid) {
//       if($byid == ""){
// 		 $q = $this->db->query("SELECT COUNT(*) as total_rescheduled
// FROM consignment
// WHERE delivery_status = 'rescheduled' AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }else{
//      $q = $this->db->query("SELECT COUNT(*) as total_rescheduled
// FROM consignment
// WHERE delivery_status = 'rescheduled' AND created_by = $byid  AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }
//     }

public function get_all_rescheduled($par=[]) {
  $cnd = [];
  if(isset($par['from_date'])){
    $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
  }

  if(isset($par['to_date'])){
    $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
  }

  if(isset($par['branch'])){
    $cnd["con.branch"] = $par['branch'];
  }

  // $cnd["con.customer"] = $par['customerid'];
  $cnd["con.status!="] = 'inactive';
  $cnd["con.delivery_status"] = 'reschedule';

  $this->db->select('COUNT(*) as total_reschedule')
     ->from('consignment con')
     ->where($cnd);
  $query =  $this->db->get();
  $res =  $query->result_array();
  return $res;
}


//     public function get_all_returned($byid) {
//       if($byid == ""){
// 		 $q = $this->db->query("SELECT COUNT(*) as total_returned
// FROM consignment
// WHERE delivery_status = 'returned' AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }else{
//      $q = $this->db->query("SELECT COUNT(*) as total_returned
// FROM consignment
// WHERE delivery_status = 'returned' AND created_by = $byid  AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }
//     }

    public function get_all_returned($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      $cnd["con.delivery_status"] = 'returned';

      $this->db->select('COUNT(*) as total_return')
         ->from('consignment con')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

//     public function get_all_cancelled($byid) {
//       if($byid == ""){
// 		 $q = $this->db->query("SELECT COUNT(*) as total_cancelled_till_date
// FROM consignment
// WHERE delivery_status = 'cancelled' AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }else{
//      $q = $this->db->query("SELECT COUNT(*) as total_cancelled_till_date
// FROM consignment
// WHERE delivery_status = 'cancelled' AND created_by = $byid  AND status <> 'inactive'")->result_array();
// 		 return $q;
//    }
//     }


    public function get_all_cancelled($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      // $cnd["con.cons_status"] = 'cancelled';
      $cnd["con.delivery_status"] = 'cancelled';

      $this->db->select('COUNT(*) as total_cancelled_till_date')
         ->from('consignment con')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_pending($byid) {
      if($byid == ""){
		 $q = $this->db->query("SELECT COUNT(*) as total_pending_till_date
FROM consignment
WHERE delivery_status = 'pending' AND status <> 'inactive'")->result_array();
		 return $q;
   }else{
     $q = $this->db->query("SELECT COUNT(*) as total_pending_till_date
FROM consignment
WHERE delivery_status = 'pending' AND created_by = $byid AND status <> 'inactive'")->result_array();
		 return $q;
   }
    }

    public function get_all_earning() {
		 $q = $this->db->query("SELECT sum(amount_paid - total_price_product) as totalEarned FROM consignment where amount_paid > total_price_product")->result_array();
		 return $q;
    }

    public function get_totalsales($customerId) {
		 $q = $this->db->query("SELECT SUM(amount_paid)as totalsales FROM `consignment` WHERE customer = $customerId AND status != 'inactive' AND payment_status_merchant = 'paid' AND delivery_status IN('delivered','returned')")->result_array();
		 return $q;
    }

    // public function get_totalpaid($customerId) {
		//  $q = $this->db->query("SELECT SUM(total_price + total_cod_charge)as totalpaid FROM `consignment` WHERE created_by = $customerId AND delivery_status = 'delivered'")->result_array();
		//  return $q;
    // }

    public function get_totalpaid($customerId) {
		 $q = $this->db->query("SELECT SUM(amount_paid)as totalpaid FROM `trans_history` WHERE merchant = $customerId")->result_array();
		 return $q;
    }

    public function get_totaldue($customerId) {
		 $q = $this->db->query("SELECT SUM(amount_paid-(total_price + total_cod_charge+return_extra))as totalamntdue FROM `consignment` WHERE customer = $customerId AND status != 'inactive'  AND payment_status_merchant = 'due' AND delivery_status IN('delivered')")->result_array();
     $r = $this->db->query("SELECT SUM(deduction_amount)as totaldedpaid FROM `consignment` WHERE customer = $customerId AND delivery_status = 'returned' AND payment_status_merchant = 'due' AND deduction_status = 1")->result_array();
     $s = $this->db->query("SELECT SUM(total_price+total_cod_charge+return_extra)as totalreturnpaid FROM `consignment` WHERE customer = $customerId AND delivery_status = 'returned' AND payment_status_merchant = 'due' AND deduction_status = 0")->result_array();
     // print_r($q);die;
     $totaldue = $q[0]['totalamntdue']-$r[0]['totaldedpaid']-$s[0]['totalreturnpaid'];
     return $totaldue;
    }

    public function get_totaldcpaid($customerId) {
		 $q = $this->db->query("SELECT SUM(total_price+total_cod_charge)as totaldelpaid FROM `consignment` WHERE customer = $customerId AND delivery_status = 'delivered' AND payment_status_merchant = 'paid'")->result_array();
     $r = $this->db->query("SELECT SUM(deduction_amount)as totaldedpaid FROM `consignment` WHERE customer = $customerId AND delivery_status = 'returned' AND deduction_status = 1 AND payment_status_merchant = 'paid'")->result_array();
     $s = $this->db->query("SELECT SUM(total_price+total_cod_charge+return_extra)as totalreturnpaid FROM `consignment` WHERE customer = $customerId AND delivery_status = 'returned' AND deduction_status = 0 AND payment_status_merchant = 'paid' AND amount_paid != 0")->result_array();
     // print_r($s);die;
     $totaldcpaid = $q[0]['totaldelpaid']+$r[0]['totaldedpaid']+$s[0]['totalreturnpaid'];
     return $totaldcpaid;
    }

    public function get_all_payment_today() {
		 $q = $this->db->query("SELECT SUM(amount) as total_amount
FROM payment
WHERE str_to_date(date, '%Y-%m-%d') = curdate()")->result_array();
		 return $q;
    }

    public function get_all_payment() {
		 $q = $this->db->query("SELECT SUM(amount) as total_amount_tillDate
FROM payment
")->result_array();
		 return $q;
    }

    public function get_all_duePayment() {
		 $q = $this->db->query("SELECT SUM(total_price) as total_due
FROM consignment WHERE payment_status = 'due'")->result_array();
		 return $q;
    }

    public function get_all_grandtotal() {
		 $q = $this->db->query("SELECT SUM(grand_total) as grand_sum
FROM consignment WHERE status = 'assigned'")->result_array();
		 return $q;
    }

//     public function get_all_amountpaid() {
// 		 $q = $this->db->query("SELECT SUM(amount_paid) as paidAmount
// FROM consignment WHERE status = 'assigned'")->result_array();
// 		 return $q;
//     }

    // public function get_totalsales($customerId) {
		//  $q = $this->db->query("SELECT SUM(amount_paid)as totalsales FROM `consignment` WHERE customer = $customerId AND status != 'inactive' AND payment_status_merchant = 'paid' AND delivery_status IN('delivered','returned')")->result_array();
		//  return $q;
    // }

    public function get_all_amountpaid($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      $cnd["con.collection_status"] = 'received';
      $cnd["con.payment_status"] = 'paid';
      // $cnd["con.delivery_status"] = 'returned';

      $this->db->select('SUM(amount_paid) as paidAmount')
         ->from('consignment con')
         ->group_start()
         ->where('con.delivery_status','delivered')
         ->or_where('con.delivery_status','returned')
        ->group_end()
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_cashdue($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.assigned_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.assigned_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      $cnd["con.collection_status"] = 'due';
      $cnd["con.payment_status"] = 'paid';

      $this->db->select('SUM(amount_paid) as cashDueAmount')
         ->from('consignment con')
         ->group_start()
         ->where('con.delivery_status','delivered')
         ->or_where('con.delivery_status','returned')
        ->group_end()
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

//     public function get_all_amountpaid_to_merchant() {
// 		 $q = $this->db->query("SELECT SUM(merchant_payout) as paidAmount_tomerchant
// FROM consignment")->result_array();
// 		 return $q;
//     }

    public function get_all_amountpaid_to_merchant($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(trans.date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(trans.date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      // if(isset($par['branch'])){
      //   $cnd["trans.branch"] = $par['branch'];
      // }

      // $cnd["con.customer"] = $par['customerid'];
      // $cnd["con.status!="] = 'inactive';
      // $cnd["con.collection_status"] = 'due';
      // $cnd["con.payment_status"] = 'paid';

      $this->db->select('SUM(amount_paid) as toatl_paid_merchant')
         ->from('trans_history trans')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_amountdue_to_merchant($par=[]) {
      $cnd = [];
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      $cnd["con.status!="] = 'inactive';
      $cnd["con.collection_status"] = 'received';
      $cnd["con.payment_status"] = 'paid';

      $this->db->select('SUM(amount_paid) as cashDueAmount')
         ->from('consignment con')
         ->group_start()
         ->where('con.delivery_status','delivered')
         ->or_where('con.delivery_status','returned')
        ->group_end()
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_alldeliveries($dboyId) {
		 $q = $this->db->query("SELECT Count(delivery_status) totaldeliveries
  FROM consignment LEFT JOIN assign_delivery
    ON assign_delivery.consignment = consignment.id
 WHERE consignment.delivery_status = 'delivered' AND assign_delivery.delivery_person = $dboyId")->result_array();
		 return $q;
    }

    public function get_alldeliveries_today($dboyId) {
		 $q = $this->db->query("SELECT Count(delivery_status) totaldeliveries_today
  FROM consignment LEFT JOIN assign_delivery
    ON assign_delivery.consignment = consignment.id
 WHERE consignment.delivery_status = 'delivered' AND str_to_date(delivered_date, '%Y-%m-%d') = curdate() AND assign_delivery.delivery_person = $dboyId")->result_array();
		 return $q;
    }

    public function delete($tbl_name = '', $data = '') {
        return $this->db->delete($tbl_name, $data);;
    }

    public function update($tbl_name = '', $data = '', $where = '') {
        $this->db->where($where);
        return $this->db->update($tbl_name, $data);
    }

    public function send_mail($to, $message, $form = '', $subject = '') {
        if ($subject == '') {
            $subject = "HTML email";
        }


        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        if ($form == '') {
            $headers .= 'From: GHRMA <admin@ghrma.com>' . "\r\n";
        } else {
            $headers .= 'From:  GHRMA <' . $form . "> \r\n";
        }

        //$headers .= 'Cc: friend.rahul.rch@gmail.com' . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

    public function get_all_cashin($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(exp.exp_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(exp.exp_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["exp.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      // $cnd["con.status!="] = 'inactive';
      // $cnd["con.collection_status"] = 'received';
      // $cnd["con.payment_status"] = 'paid';
      // $cnd["con.delivery_status"] = 'returned';

      $this->db->select('SUM(cash_in) as cash_in')
         ->from('expenses exp')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_all_cashout($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(exp.exp_date) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(exp.exp_date) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["exp.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      // $cnd["con.status!="] = 'inactive';
      // $cnd["con.collection_status"] = 'received';
      // $cnd["con.payment_status"] = 'paid';
      // $cnd["con.delivery_status"] = 'returned';

      $this->db->select('SUM(cash_out) as cash_out')
         ->from('expenses exp')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }


    public function getall_dcdue($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      $cnd["con.delivery_status!="] = "cancelled";
      $cnd["con.payment_status_merchant"] = "due";

      $this->db->select('con.*')
         ->from('consignment con')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function getall_dcpaid($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["con.branch"] = $par['branch'];
      }

      // $cnd["con.customer"] = $par['customerid'];
      $cnd["con.status!="] = 'inactive';
      $cnd["con.delivery_status!="] = "cancelled";
      $cnd["con.payment_status_merchant"] = "paid";

      $this->db->select('con.*')
         ->from('consignment con')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function mp_due($par=[]) {
      $cnd = [];
      if(isset($par['from_date'])){
        $cnd["DATE(c.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
      }

      if(isset($par['to_date'])){
        $cnd["DATE(c.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
      }

      if(isset($par['branch'])){
        $cnd["c.branch"] = $par['branch'];
      }

      $cnd["c.collection_status"] = "received";
      $cnd["c.status!="] = "inactive";
      $cnd["c.cons_status!="] = "cancelled";
      $cnd["c.delivery_status!="] = "cancelled";
      $cnd["c.payment_status_merchant"] = "due";

      $this->db->select('c.*')
         ->from('consignment c')
         ->where($cnd);
      $query =  $this->db->get();
      $res =  $query->result_array();
      return $res;
    }

    public function get_allnum(){
      $q = $this->db->query("SELECT phone FROM customer WHERE status = 'active' AND phone!= 0")->result_array();
      return $q;
    }
}


class Hello_Model extends CI_Model
{
 function saverecords($name,$email,$password,$select)
 {
 $query="insert into users values('','$name','$email','$password','$select')";
 $this->db->query($query);
 }
}
