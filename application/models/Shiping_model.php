
<?php

class Shiping_model extends General_model {

    public function __construct() {
        parent::__construct();
    }


    public function delete_shiping($id) {
		 $q = $this->db->query("UPDATE `shiping` SET `status`='inactive' WHERE id='$id'");
		 return $q;
    }
    
    
}
