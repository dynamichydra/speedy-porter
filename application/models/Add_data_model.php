<?php

class Add_data_model extends General_model {

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

    public function get_all_data(){
      $q = $this->db->query("SELECT d.*,ps.station_name,ps.area, ps.id stationID FROM district d INNER JOIN police_station ps ON d.id = ps.district WHERE d.status = 'active'")->result_array();
 		 return $q;
    }
}
