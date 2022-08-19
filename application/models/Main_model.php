<?php

class Main_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_allheight(){
      $q = $this->db->query("SELECT * FROM volumetric WHERE status = 'active' GROUP BY height")->result_array();
 		 return $q;
    }

}
