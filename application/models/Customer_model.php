
<?php

class Customer_model extends General_model {

    public function __construct() {
        parent::__construct();
    }


    public function delete_customer($id) {
		 $q = $this->db->query("UPDATE `customer` SET `status`='inactive' WHERE id='$id'");
		 return $q;
    }

    public function seen_update($id) {
		 $q = $this->db->query("UPDATE `profile_update` SET `approved`= 1 WHERE id='$id'");
		 return $q;
    }


}
