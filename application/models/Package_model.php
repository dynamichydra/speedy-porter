<?php

class Package_model extends General_model {

    public function __construct() {
        parent::__construct();
    }
    public function delete_package($id) {
		 $q = $this->db->query("UPDATE `package` SET `status`='inactive' WHERE id='$id'");
		 return $q;
    }
    
    
}
