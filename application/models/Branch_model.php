<?php

class Branch_model extends General_model {

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

    public function get_all_branch(){
      $q = $this->db->query("SELECT b.*,dist.district_name , ps.station_name police_station FROM branch b INNER JOIN police_station ps ON b.police_station = ps.id INNER JOIN district dist ON b.district = dist.id WHERE b.status = 'active'")->result_array();
 		 return $q;
    }
}
