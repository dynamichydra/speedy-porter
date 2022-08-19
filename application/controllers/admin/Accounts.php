<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accounts_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
      if($this->session->userdata('user_type') == 'branch'){
        $creator = $this->session->userdata('id');
        // $data['row'] = $this->delivery_person_model->get_all_transporter_bycreator($creator);
        $data['row'] = $this->Accounts_model->get_all_entrylist();
      }else{
        $data = array();
        $data['fetch'] = $this->input->post();
        $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
        $data['row'] = $this->Accounts_model->get_all_entrylist();
    }
        $content = $this->load->view('accounts/entrylist', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'List of Entry', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'List of Entry']], true);
        $renderdata = ['page_title' => 'List of Entry', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }


    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Add New List', 'nav' => ['dashboard' => 'Dashboard', 'accounts' => 'List of Entry', 'blank' => 'Add New List']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Entry List";
            $pageData["nav"]["blank"] = "Edit Entry List";
            $data['row'] = $this->Accounts_model->get_where_all('entry_list', ["id" => $id]);
            $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
            $data['row'] = $data['row'][0];
        }
        $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
        $content = $this->load->view('accounts/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Add New List ', 'js' => ['entrylist'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave_entrylist(){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
                $res = $this->Accounts_model->update('entry_list', ['name' => $this->input->post('name'),
                'designation' => $this->input->post('designation'),
                'office' => $this->input->post('office')],
                 ['id' => $id]);
                $response['message'] = "Entry List updated successfully";
                $response['success'] = true;
        } else {
                $res = $this->Accounts_model->insert('entry_list', [
                'name' => $this->input->post('name'),
                'designation' => $this->input->post('designation'),
                'office' => $this->input->post('office')
              ]);
                $response['message'] = "Entry List created successfully";
                $response['success'] = true;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->Accounts_model->delete_entry_list($id);
        $response['message'] = "Entry List deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function expense() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
      if($this->session->userdata('user_type') == 'branch'){
        $creator = $this->session->userdata('id');
        // $data['row'] = $this->delivery_person_model->get_all_transporter_bycreator($creator);
        // $data['row'] = $this->Accounts_model->get_all_entrylist();
      }else{
        $data = array();
        $data['fetch'] = $this->input->post();
        // $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
        $data['row'] = $this->Accounts_model->get_where_all('expense_list');
    }
        $content = $this->load->view('accounts/expenselist', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Expense List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Expense List']], true);
        $renderdata = ['page_title' => 'Expense List', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create_expense($id = '') {
        $data = array();
        $pageData = ['title' => 'Add New List', 'nav' => ['dashboard' => 'Dashboard', 'accounts/expense' => 'Expense List', 'blank' => 'Add New List']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Expense List";
            $pageData["nav"]["blank"] = "Edit Expense List";
            $data['row'] = $this->Accounts_model->get_where_all('expense_list', ["id" => $id]);
            $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('accounts/create_expense', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Add New List ', 'js' => ['expenselist'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave_explist(){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
                $res = $this->Accounts_model->update('expense_list', ['exp_type' => $this->input->post('exp_type'),
                'grp_head' => $this->input->post('grp_head')],
                 ['id' => $id]);
                $response['message'] = "Expense List updated successfully";
                $response['success'] = true;
        } else {
                $res = $this->Accounts_model->insert('expense_list', [
                'exp_type' => $this->input->post('exp_type'),
                'grp_head' => $this->input->post('grp_head')
              ]);
                $response['message'] = "Expense List created successfully";
                $response['success'] = true;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete_expense($id) {
        $this->Accounts_model->delete_exp_list($id);
        $response['message'] = "Entry List deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function account_entry($id = '') {
        $data = array();
        $pageData = ['title' => 'Account Entry', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Account Entry']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Account Entry";
            $pageData["nav"]["blank"] = "Edit Account Entry";
            $data['row'] = $this->Accounts_model->get_where_all('expenses', ["id" => $id]);
            $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
            $data['exp_list'] = $this->Accounts_model->get_where_all('expense_list', ["status" => 'active']);
            $data['row'] = $data['row'][0];
            $content = $this->load->view('accounts/account_entry_edit', $data, true);
            $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
            $renderdata = ['page_title' => 'Account Entry ', 'js' => ['accountentry_edit'], 'content' => $content, 'content_head' => $content_head];
        }else{
          $invno = 'AB-VOU-'.$this->random_strings(4);
          $data['vouchernumber'] = $invno;
          $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
          $data['exp_list'] = $this->Accounts_model->get_where_all('expense_list', ["status" => 'active']);
          $content = $this->load->view('accounts/account_entry', $data, true);
          $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
          $renderdata = ['page_title' => 'Account Entry ', 'js' => ['accountentry'], 'content' => $content, 'content_head' => $content_head];
        }

        render($renderdata);
    }

    public function getListName() {

            $response = array();
            $list_type = $this->input->post('list_type');
            $office = $this->input->post('office');
            $office_id =  $this->Accounts_model->get_where_all('branch',['name' => $office,'status' => 'active']);
            if ($list_type == "t_list") {
                $response = $this->Accounts_model->get_where_all('delivery_person',['office' => $office_id[0]['id'],'status' => 'active']);
            }else{
              $response = $this->Accounts_model->get_where_all('entry_list',['office' => $office_id[0]['id']]);
            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function createsave_entry(){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
                $res = $this->Accounts_model->update('entry_list', ['entrydate' => $this->input->post('entrydate'),
                't_type' => $this->input->post('t_type'),
                'voucher_no' => $this->input->post('voucher_no')],
                 ['id' => $id]);
                $response['message'] = "Entry List updated successfully";
                $response['success'] = true;
        } else {
                $res = $this->Accounts_model->insert('entry_list', [
                'name' => $this->input->post('name'),
                'designation' => $this->input->post('designation'),
                'office' => $this->input->post('office')
              ]);
                $response['message'] = "Entry List created successfully";
                $response['success'] = true;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    // public function checking(){
    //   $intialdate = '24-11-2021';
    //   echo date("Y-m-d", strtotime($intialdate) );
    //   die;
    // }

    public function createsave_account_entry(){
        $id = $this->input->post("id");
        $trtype = $this->input->post('t_type');
        if($trtype == 'cash_out'){
          $cash_in = 0;
          $cash_out = $this->input->post('amount');
        }else{
          $cash_in = $this->input->post('amount');
          $cash_out = 0;
        }
        $listname = $this->input->post('list_name');
        $list_type = $this->input->post('l_type');
        if($list_type == 'l_ofentry'){
          $namedetails = $this->Accounts_model->get_where_all('entry_list',['name' => $listname]);
          $designation = $namedetails[0]['designation'];
        }else{
          $namedetails = $this->Accounts_model->get_where_all('delivery_person',['name' => $listname]);
          $designation = $namedetails[0]['transporter_type'];
        }

        $exptpe = $this->input->post('exp_type');
        if($exptpe != ""){
          $expdetails = $this->Accounts_model->get_where_all('expense_list',['exp_type' => $exptpe]);
          $exphead = $expdetails[0]['grp_head'];
        }

        $intialdate = $this->input->post('entrydate');
        $entrydate =  date("Y-m-d", strtotime($intialdate) );
        // die;
        // echo $entrydate;die;
        // $date_accounts = date("Y-m-d");
        if (isset($id) && $id > 0) {
                $res = $this->Accounts_model->update('expenses', ['exp_date' => $entrydate,
                'trans_type' => $trtype,
                'list_type' => $list_type,
                'voucher_no' => $this->input->post('voucher_no'),
                'name' => $listname,
                'office' => $this->input->post('office'),
                'exp_type' => $this->input->post('exp_type'),
                'exp_head' => $exphead,
                'narration' => $this->input->post('narration'),
                'designation' => $designation,
                'del_charge' => 0,
                'cash_in' => $cash_in,
                'cash_out' => $cash_out,
                'exp_nature' => 'voucher',
                'entry_type' => 'manual'],
                 ['id' => $id]);
                $response['message'] = "Account Entry updated successfully";
                $response['success'] = true;
        } else {

              $res = $this->Accounts_model->insert('expenses', ['exp_date' => $entrydate,
              'trans_type' => $this->input->post('t_type'),
              'list_type' => $this->input->post('l_type'),
              'voucher_no' => $this->input->post('voucher_no'),
              'name' => $this->input->post('list_name'),
              'designation' => $designation,
              'office' => $this->input->post('office'),
              'exp_type' => $this->input->post('exp_type'),
              'exp_head' => $exphead,
              'narration' => $this->input->post('narration'),
              'del_charge' => 0,
              'cash_in' => $cash_in,
              'cash_out' => $cash_out,
              'exp_nature' => 'voucher',
              'entry_type' => 'manual']);

                $response['message'] = "Account Entry created successfully";
                $response['success'] = true;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }


    public function accounts_list() {
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['branch'] = $row['office_id'];
      }

      if(isset($row['particular']) && $row['particular']!=''){
        $arr['name'] = $row['particular'];
      }
      if(isset($row['exptype']) && $row['exptype']!=''){
        $arr['exp_type'] = $row['exptype'];
      }
      if(isset($row['vouch']) && $row['vouch']!=''){
        $arr['vouch'] = $row['vouch'];
      }

      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }

      if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
      $data = array();
      $pageData = ['title' => 'Account list report', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Account List report']];
      $data['result'] = $this->Accounts_model->get_all_expenses($arr);
      $data['branch'] = $this->Accounts_model->get_where_all('branch', [' status' => 'active']);
      $data['expense_list'] = $this->Accounts_model->get_where_all('expense_list', [' status' => 'active']);
      $data['src'] = $row;
      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('accounts/accounts_list', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Account List Report', 'js' => ['delivery_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function edit_voucher(){
      if($this->session->userdata('user_type') == '')
      redirect('admin');
      $data = array();
      $data['branch'] = $this->Accounts_model->get_where_all('branch', ["status" => 'active']);
      $data['exp_list'] = $this->Accounts_model->get_where_all('expense_list', ["status" => 'active']);
      $content = $this->load->view('accounts/edit_voucher', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Edit Voucher', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Edit Voucher']], true);
      $renderdata = ['page_title' => 'Edit Voucher', 'js' => ['voucher_correction'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function getvoucherdetail() {

              $response = array();
              if ($this->input->post('voucher') != "") {
                  $vouchertoget = $this->input->post('voucher');
                  $consdetail= $this->Accounts_model->get_where_all('expenses',["voucher_no"=>$vouchertoget,'entry_type'=>'manual']);
                  if($consdetail){
                    $response['vocher_details'] = $consdetail[0];
                }else{
                  $response = "invalid";
                }
              }
              $this->output->set_content_type('application/json')
                      ->set_output(json_encode($response))->_display();
              exit();

      }

      public function random_strings($length_of_string)
    {
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

      return substr(str_shuffle($str_result),
                         0, $length_of_string);
    }

    public function getparticular() {

            $response = array();
            $vouch = $this->input->post('vouchertype');
            if ($vouch != "") {
                if($vouch == 'invoice'){
                  $response = $this->Accounts_model->get_where_all('customer');
                }elseif ($vouch == 'transaction') {
                  $response = $this->Accounts_model->get_where_all('delivery_person');
                }else {
                  $tabletofetch = 'entry_list';
                  $d_person = $this->Accounts_model->get_where_all('delivery_person');
                  $e_list = $this->Accounts_model->get_where_all('entry_list');
                  $finalarray = array_merge($d_person,$e_list);
                  $response = $finalarray;
                }

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

}
