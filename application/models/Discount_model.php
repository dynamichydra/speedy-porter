<?php

class Discount_model extends General_model {

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

    public function get_all_promo(){
      $q = $this->db->query("SELECT d.*,cus.name merchant,cus.company cus_company FROM discount d INNER JOIN customer cus ON d.merchant = cus.id WHERE d.status <> 'delete'")->result_array();
 		 return $q;
    }
}
