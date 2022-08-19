
<?php

class Shiping_history_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_consignment($id) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_area,s.recipient_city,s.recipient_landmark,cus.name,p.name as pack_name,p.weight as pack_weight FROM consignment c INNER JOIN shiping s ON c.pickup_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN package p ON c.package_name = p.id WHERE c.customer = $id AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function view_all_consignment($id,$cus_id) {
		 $q = $this->db->query("SELECT c.*,s.recipient_address,s.recipient_area,s.recipient_city,s.recipient_landmark,cus.name as cus_name,p.name as pack_name FROM consignment c INNER JOIN shiping s ON c.pickup_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN package p ON c.package_name = p.id WHERE c.status <> 'inactive' AND c.customer = $cus_id AND c.id = $id")->result_array();
		 return $q;
    }


}
