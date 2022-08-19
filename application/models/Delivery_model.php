<?php

class Delivery_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function no_of_delivery($id){
    	 $q = $this->db->query("SELECT count(ad.id) as count,dp.id as delivery_person from assign_delivery ad left join delivery_person dp on dp.id = ad.delivery_person where dp.id = '$id'")->result_array();
		 return $q;
    }
     public function get_track_status($id){
     	$sql = $this->db->query("SELECT * from consignment where consignment_id = '$id'")->result_array();
     	//print_r($sql[0]['delivery_status']);

     	if($sql[0]['delivery_status'] == 'assigned'){
    	 $q = $this->db->query("SELECT  c.*,dp.name as dp_name,dp.phone as dp_phone from consignment c left join assign_delivery ad on ad.consignment = c.id inner join delivery_person dp on dp.id = ad.delivery_person where c.consignment_id = '$id'")->result_array();
    	}
    	else if($sql[0]['delivery_status'] == 'pending'){
    		 $q = $this->db->query("SELECT * from consignment where consignment_id = '$id'")->result_array();
    	}
		 return $q;
    	
    }
    
    
}
