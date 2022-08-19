
<?php

class Assign_deliveryperson_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
		 $q = $this->db->query("SELECT ad.*,c.consignment_id,dp.name as delivery_person_name,br.name as branch_name,br.address as branch_address,br.phone as branch_phone,br.email as branch_email,br.id as branch_id,p.name as pack_name,s.recipient_address FROM assign_delivery ad INNER JOIN consignment c ON c.id = ad.consignment INNER JOIN branch br ON ad.branch = br.id INNER JOIN delivery_person dp ON ad.delivery_person = dp.id INNER JOIN package p ON c.package_name = p.id INNER JOIN shiping s ON c.pickup_address = s.id WHERE ad.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_all_bybranch($consignmentcreator) {
		 $q = $this->db->query("SELECT ad.*,c.consignment_id,dp.name as delivery_person_name,br.name as branch_name,br.address as branch_address,br.phone as branch_phone,br.email as branch_email,br.id as branch_id,p.name as pack_name,s.recipient_address FROM assign_delivery ad INNER JOIN consignment c ON c.id = ad.consignment INNER JOIN branch br ON ad.branch = br.id INNER JOIN delivery_person dp ON ad.delivery_person = dp.id INNER JOIN package p ON c.package_name = p.id INNER JOIN shiping s ON c.pickup_address = s.id WHERE ad.status <> 'inactive' AND c.created_by = '$consignmentcreator'")->result_array();
		 return $q;
    }
   /* public function get_edit_data($id) {
		 $q = $this->db->query("SELECT ad.*,c.consignment_id,dp.name as delivery_person_name FROM assign_delivery ad INNER JOIN consignment c ON c.id = ad.consignment INNER JOIN delivery_person dp ON ad.delivery_person = dp.id WHERE ad.status <> 'inactive' AND ad.id= $id");
		 return $q;
    }*/

    public function get_all_consignment_notAssigned_tillNow() {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.status <> 'assigned'")->result_array();
		 return $q;
    }

    public function get_all_consignment_notAssigned_tillNowbybranch($creator) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.status <> 'assigned' AND c.created_by = '$creator'")->result_array();
		 return $q;
    }

    public function get_all_consignment_Assigned_tillNow() {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.status = 'assigned'")->result_array();
		 return $q;
    }

    public function get_all_consignment_Assigned_tillNow_receive() {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.receive_status = 'assigned'")->result_array();
		 return $q;
    }

    public function get_all_consignment_notAssigned($dist) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND c.status <> 'assigned'")->result_array();
		 return $q;
    }

    public function get_all_consignment_notAssignedbybranch($dist,$creator) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND c.status <> 'assigned' AND created_by = '$creator'")->result_array();
		 return $q;
    }

    public function get_allconsignment_notAssigned($dist,$station) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND c.police_station = $station AND c.status <> 'assigned'")->result_array();
		 return $q;
    }

    public function get_allconsignment_notAssignedbybranch($dist,$station,$branch) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND  c.del_police_station IN ($statns_tags) AND c.branch = '$branch' AND c.cons_status <> 'pending' AND c.status <> 'assigned' AND c.transfer_status <> 'request'")->result_array();
		 return $q;
    }

    // public function get_allconsignment_notAssignedbybranch($dist,$station,$creator) {
		//  $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND c.police_station = $station AND c.status <> 'assigned' AND created_by = '$creator'")->result_array();
		//  return $q;
    // }

    public function get_all_consignment() {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function delete_assign_delivery($id) {
		 $q = $this->db->query("UPDATE `assign_delivery` SET `status`='inactive' WHERE id='$id'");
		 return $q;
    }

    public function get_allconsignment_notAssigned_array($dist,$statns_tags) {
		 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
     $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND  c.del_police_station IN ($statns_tags) AND c.cons_status <> 'pending' AND c.status <> 'assigned' AND c.transfer_status <> 'request'")->result_array();
		 return $q;
    }

    public function get_allconsignment_notAssigned_array_branch($dist,$statns_tags,$branch) {
		 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
     $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_name,s.recipient_postalcode,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND  c.del_police_station IN ($statns_tags) AND c.branch = $branch AND c.cons_status <> 'pending' AND c.status <> 'assigned' AND c.transfer_status <> 'request'")->result_array();
		 return $q;
    }

    public function get_allconsignment_notAssigned_object($dist,$statns_tags) {
		 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
     $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_number,s.recipient_name,s.recipient_postalcode,p.name as pack_name,cu.company as cus_company,cu.name as cus_name,cu.phone as cus_contact FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cu ON c.customer = cu.id INNER JOIN package p ON p.id = c.package_name WHERE c.district = $dist AND  c.del_police_station IN ($statns_tags) AND c.cons_status = 'received' AND c.status <> 'assigned' AND c.transfer_status <> 'request'")->result();
		 return $q;
    }

    public function get_allconsignment_notAssigned_objectall() {
		 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
     $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_number,s.recipient_name,s.recipient_postalcode,p.name as pack_name,cu.company as cus_company,cu.name as cus_name,cu.phone as cus_contact FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cu ON c.customer = cu.id INNER JOIN package p ON p.id = c.package_name WHERE c.cons_status = 'received' AND c.status = 'not_assigned' AND c.transfer_status <> 'request'")->result();
		 return $q;
    }

    public function get_transporter($consid) {
		 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
     $q = $this->db->query("SELECT dp.name as transporter, ad.id as editid FROM assign_receive ad INNER JOIN delivery_person dp ON ad.delivery_person = dp.id WHERE ad.consignment = $consid")->result_array();
		 return $q;
    }

    public function get_transporter_delivery($consid) {
		 // $q = $this->db->query("SELECT * FROM `consignment` WHERE district = $dist AND  police_station IN ($statns_tags)")->result_array();
     $q = $this->db->query("SELECT dp.name as transporter, ad.id as editid FROM assign_delivery ad INNER JOIN delivery_person dp ON ad.delivery_person = dp.id WHERE ad.consignment = $consid")->result_array();
		 return $q;
    }

    public function get_receive($par=[]){
     $cnd = [];
     if(isset($par['company'])){
       $cnd["con.branch"] = $par['company'];
     }

     if(isset($par['merch_id'])){
       $cnd["con.customer"] = $par['merch_id'];
     }

     if(isset($par['from_date'])){
       $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
     }

     if(isset($par['to_date'])){
       $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
     }
     $cnd["con.receive_status"] = "assigned";
     $cnd["con.status!="] = "inactive";
     $cnd["con.delivery_status IN('in-transit','pending','reschedule')"] = `(in-transit)`;
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

   public function get_all_list($par=[]){
    $cnd = [];
    if(isset($par['company'])){
      $cnd["con.customer"] = $par['company'];
    }

    if(isset($par['branch'])){
      $cnd["con.branch"] = $par['branch'];
    }

    $cnd["con.receive_status"] = "not_assigned";
    $cnd["con.cons_status"] = "pending";

    $this->db->select('con.*,c.name as cus_name,c.company as cus_company,c.phone as cus_contact,c.address as cus_address,c.pincode as cus_pincode,b.name as office, DATE_FORMAT(con.delivery_date,"%d, %b %Y") delivery_date')
       ->from('consignment con ')
       ->join('customer c', 'c.id = con.customer')
       ->join('branch b', 'b.id = con.branch')
       ->where($cnd);
    $query =  $this->db->get();
    $res =  $query->result();
    return $res;
  }

  public function get_deliver($par=[]){
   $cnd = [];
   if(isset($par['company'])){
     $cnd["con.branch"] = $par['company'];
   }

   if(isset($par['merch_id'])){
     $cnd["con.customer"] = $par['merch_id'];
   }

   if(isset($par['from_date'])){
     $cnd["DATE(con.timestamp) >= '".date('Y-m-d',strtotime($par['from_date']))."' "] = null;
   }

   if(isset($par['to_date'])){
     $cnd["DATE(con.timestamp) <= '".date('Y-m-d',strtotime($par['to_date']))."' "] = null;
   }
   $cnd["con.cons_status"] = "received";
   $cnd["con.status"] = "assigned";
   $cnd["con.delivery_status"] = "in-transit";
   // $cnd["con.created_by"] = $this->session->userdata('id');

   $this->db->select('con.*,s.recipient_name,s.recipient_address,s.recipient_number,ps.station_name')
      ->from('consignment con ')
      ->join('shiping s', 's.id = con.recipient_address')
      ->join('police_station ps', 'ps.id=s.police_station')
      ->order_by("con.id", "DESC")
      ->where($cnd);
   $query =  $this->db->get();
   $res =  $query->result();
   $res =  $query->result_array();
   return $res;
 }


}
