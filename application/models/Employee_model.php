
<?php

class Employee_model extends General_model {

    public function __construct() {
        parent::__construct();
    }


    public function delete_official_person($id) {
		 $q = $this->db->query("UPDATE `employee` SET `status`='inactive' WHERE id='$id'");
		 return $q;
    }

    public function get_all_employee(){
      $q = $this->db->query("SELECT d.*,b.name as branch_name FROM employee d INNER JOIN branch b ON b.id = d.office WHERE d.status = 'active'")->result_array();
 		 return $q;
    }

    public function get_all_employee_sort($addedby){
      $q = $this->db->query("SELECT d.*,b.name as branch_name FROM employee d INNER JOIN branch b ON b.id = d.office WHERE d.status = 'active' AND d.office = '$addedby'")->result_array();
      return $q;
    }

    public function get_all_transporter_bycreator($creator){
      $q = $this->db->query("SELECT d.*,b.name as branch_name FROM delivery_person d INNER JOIN branch b ON b.id = d.office WHERE d.status = 'active' AND d.added_by = '$creator'")->result_array();
      return $q;
    }


}
