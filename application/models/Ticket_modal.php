<?php

class Ticket_model extends General_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_tickets() {
		 $q = $this->db->query("SELECT * FROM 'ticket'")->result_array();
		 return $q;
    }
}
