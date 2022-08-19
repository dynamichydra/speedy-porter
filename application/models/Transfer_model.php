<?php

class Transfer_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_consignment_out($tran_to) {
		 $q = $this->db->query("SELECT c.*,cus.name as merchant_name,cus.company as merchant_company,cus.address as merchant_address,cus.phone as merchant_number,br.name as office,s.recipient_address,s.recipient_number,s.recipient_name as shipping_name,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN branch br ON c.branch = br.id WHERE c.transfer_status = 'request' AND c.transfer_to != $tran_to AND c.status <> 'inactive'")->result_array();
		 return $q;
    }

    public function get_all_consignment_in($tran_to) {
		 $q = $this->db->query("SELECT c.*,cus.name as merchant_name,cus.company as merchant_company,cus.address as merchant_address,cus.phone as merchant_number,br.name as office,s.recipient_address,s.recipient_number,s.recipient_name as shipping_name,s.recipient_address_2,s.recipient_area,s.recipient_city,s.recipient_landmark FROM consignment c INNER JOIN shiping s ON c.recipient_address = s.id INNER JOIN customer cus ON c.customer = cus.id INNER JOIN branch br ON c.branch = br.id WHERE c.transfer_status = 'request' AND c.transfer_to = $tran_to AND c.status <> 'inactive'")->result_array();
		 return $q;
    }
}
