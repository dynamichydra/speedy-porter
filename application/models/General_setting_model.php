<?php

class General_setting_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_setting($usertype,$userid){
      if($usertype == "customer"){
      $q = $this->db->query("SELECT theme FROM customer WHERE id = $userid")->result_array();
    }elseif ($usertype == "delivery" || $usertype == "receiver") {
      $q = $this->db->query("SELECT theme FROM delivery_person WHERE id = $userid")->result_array();
    }else{
      $q = $this->db->query("SELECT theme FROM users WHERE id = $userid")->result_array();
    }
 		 return $q;
    }
}
