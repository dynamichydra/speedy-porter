<?php

class Packing_model extends General_model {

    public function __construct() {
        parent::__construct();
    }
    public function delete_packing($id) {
		 $q = $this->db->query("UPDATE `packing` SET `status`='inactive' WHERE id='$id'");
		 return $q;
    }

    public function get_allPacking() {
		 $q = $this->db->query("SELECT p.*,pa.name FROM packing p INNER JOIN package pa ON p.package_id = pa.id WHERE p.status = 'active'")->result_array();
		 return $q;
    }

}
