<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rider_api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->CI = get_instance();
        header('Access-Control-Allow-Origin: *');
        // $this->load->model('api_model');
        $this->load->model('rider_api_model');
        $this->load->model('consignment_model');
    }

    public function index(){
    }

    public function login(){
      $this->output->set_content_type('application jason');
      $email = $this->input->post('email');
      $pass = md5($this->input->post('password'));
      if(is_numeric($email)){
        $res=$this->rider_api_model->get_where_all('delivery_person',['phone'=>  $email,'password'=> $pass ]);
      }else{
      $res=$this->rider_api_model->get_where_all('delivery_person',['email'=>  $email,'password'=> $pass ]);
    }
      // print_r($res[0]);die;
      if(count($res)>0){
          $this->session->set_userdata($res[0]);
          $response['message'] = "Login successfull!!";
          $response['success'] = true;
          // $response['pass_updated'] = $res[0]['pass_updated'];
          $response['pass_updated'] = 1;
          $response['userdetails'] = $res[0];
          // redirect(base_url().'merchant/dashboard');
      }else{
          $response['message'] = "Email or Password did not found!!";
          $response['success'] = false;
      }
      $this->output->set_output(json_encode($response));
    }

    public function conslist(){
         $this->output->set_content_type('application jason');

         $arr['merch_id'] = $this->input->post('userid');
         $arr['recipientname'] = $this->input->post('recipientname');
         $arr['offst'] = $this->input->post('offset');
         // $arr['lmt'] = 10;
         $data = array();
         $data['row'] = $this->rider_api_model->get_all_consignment_dp($arr);
         $response['consdetail'] = $data['row'];
         $response['message'] = "success";
         $response['success'] = true;

         $this->output->set_output(json_encode($response));
       }

       public function financiallist(){
            $this->output->set_content_type('application jason');

            $data = array();
            $arr['customer_id'] = $this->input->post('userid');
             $arr['offst'] = $this->input->post('offset');
            $data['row'] = $this->rider_api_model->getconsignmentInfo_dp($arr);
            $response['findata'] = $data['row'];
            $response['message'] = "success";
            $response['success'] = true;

            $this->output->set_output(json_encode($response));
      }

     public function orderlist(){
                     $this->output->set_content_type('application jason');

                     $data = array();
                     $arr['customer_id'] = $this->input->post('userid');
                      $arr['offst'] = $this->input->post('offset');
                     $data['row'] = $this->rider_api_model->getalldelivery_dp($arr);
                     $response['deldata'] = $data['row'];
                     $response['message'] = "success";
                     $response['success'] = true;

                     $this->output->set_output(json_encode($response));
                   }
              public function orderlist_last(){
                $this->output->set_content_type('application jason');

                $data = array();
                $arr['customer_id'] = $this->input->post('userid');
                 $arr['offst'] = $this->input->post('offset');
                $data['row'] = $this->rider_api_model->getalldelivery_dp_last($arr);
                $response['deldata'] = $data['row'];
                $response['message'] = "success";
                $response['success'] = true;

                $this->output->set_output(json_encode($response));
              }

                   public function orderlist_received(){
                        $this->output->set_content_type('application jason');

                        $data = array();
                        $arr['customer_id'] = $this->input->post('userid');
                         $arr['offst'] = $this->input->post('offset');
                        $data['row'] = $this->rider_api_model->getallreceived_dp($arr);
                        $response['resdata'] = $data['row'];
                        $response['message'] = "success";
                        $response['success'] = true;

                        $this->output->set_output(json_encode($response));
                      }

                      public function orderlist_received_last(){
                           $this->output->set_content_type('application jason');

                           $data = array();
                           $arr['customer_id'] = $this->input->post('userid');
                            $arr['offst'] = $this->input->post('offset');
                           $data['row'] = $this->rider_api_model->getallreceived_dp_last($arr);
                           $response['resdata'] = $data['row'];
                           $response['message'] = "success";
                           $response['success'] = true;

                           $this->output->set_output(json_encode($response));
                         }
          public function update_ord(){
              $this->output->set_content_type('application/json');

              $id = $this->input->post("consid_toupdate");
              $cusotp = $this->input->post("cusotp");


              $res = $this->rider_api_model->update('consignment', ['cusotp' => $cusotp], ['id' => $id]);
              $res=$this->rider_api_model->get_where_all('consignment',['id' => $id]);
              $response['userdetails'] = $res[0];
              $response['message'] = "order updated successfully";
              $response['success'] = true;
              $this->output->set_output(json_encode($response));
            }
            public function offices(){
                $this->output->set_content_type('application jason');

                $data = array();
                $data['branch'] = $this->rider_api_model->get_where_all(' branch',['status'=>'active']);
                $response['bdata'] = $data['branch'];
                $response['message'] = "success";
                $response['success'] = true;

                $this->output->set_output(json_encode($response));
              }

              public function changepass(){
                  $this->output->set_content_type('application jason');

                  $id = $this->input->post("userid");

                  $check=$this->rider_api_model->get_where_all('delivery_person', ['id' => $id]);
                  $user_pass=$check[0]['password'];
                  $input_pass=md5($this->input->post("password"));
                  if($user_pass==$input_pass){
                    $insert = $this->rider_api_model->update('delivery_person', ['password' => md5($this->input->post('psw')),'pass_updated' => 1],['id'=>$id]);
                    if ($insert){
                      $response['message'] = "Password Updated successfully,please login again";
                      $response['success'] = true;
                    }else{
                      $response['message'] = "Password Update failed";
                      $response['success'] = false;
                    }
                  }else
                  {
                    $response['message'] = "Current Password Mismatch,please try again";
                    $response['success'] = false;
                  }

                  $this->output->set_output(json_encode($response));
                }

                public function getdash(){
                                           $this->output->set_content_type('application jason');

                                           $data = array();
                                           if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
                                             $arr['from_date'] = $input['from_date'];
                                           }
                                           if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
                                             $arr['to_date'] = $input['to_date'];
                                           }

                                           $customerId = $this->input->post('userid');
                                           $arr['customerid'] = $this->input->post('userid');

                                           $del_last = $this->rider_api_model->get_alldel_lastmoth($arr);
                                           $rec_last = $this->rider_api_model->get_allreslastmoth($arr);
                                           $del_current = $this->rider_api_model->get_alldel_thismoth($arr);
                                           $rec_current = $this->rider_api_model->get_allresthismoth($arr);
                                           $result = array_merge($del_last, $rec_last,$del_current,$rec_current);
                                           $response['res'] = $result;
                                           $response['message'] = "success";
                                           $response['success'] = true;

                                           $this->output->set_output(json_encode($response));
                                         }
public function financiallist_dp(){
  $this->output->set_content_type('application jason');

  $data = array();
  $arr['customer_id'] = $this->input->post('userid');
  $arr['offst'] = $this->input->post('offset');
  $data['row'] = $this->rider_api_model->getfinance_dp($arr);
  $response['findata'] = $data['row'];
  $response['message'] = "success";
  $response['success'] = true;

  $this->output->set_output(json_encode($response));
 }




























//     function register() {
//         $this->output->set_content_type('application jason');
//         $msg_err = '';
//
//         $txtEmail    = 	strtolower($this->input->post('email'));
//         $txtName     = 	ucwords($this->input->post('name'));
//         $txtPhone    = 	$this->input->post('phone');
//         $txtPassword = 'ab'.$this->random_strings(6);
//         $registration_date = date("Y-m-d");
//         // $txtAddress = 	$this->input->post('address');
//
//         if($txtEmail && $txtName && $txtPhone && $txtPassword){   // if mandetory data exist
//             $isValidEmail = false;
//             $isValidPhone = false;
//
//             // $txtEmail formate validation & uniq check
//             if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
//                 if ($this->api_model->get_where_all('customer', ['email' => $txtEmail])) {
//                     $response['message'] = "Email is already registered!!
//                      For more info, please contact
//                      Merchant Care Number:
//                      +8801401333000";
//                     // $response['message'] = "<p> Email already registered!! <br> For more info <br>contact Merchant Care Number: <br>+8801401333000 </p>";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//                 } else {
//                     $isValidEmail = true;
//                 }
//             } else {
//                 $response['message'] = "Incorrect email format!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//             // $txtPhone numeric check
//             if (is_numeric($txtPhone) && strlen($txtPhone)) {
//                 if ($this->api_model->get_where_all('customer', ['phone' => $txtPhone])) {
//                     $response['message'] = "Phone no. already exist!!";
//                     $this->output->set_output(json_encode($response));
//                     $response['success'] = false;
//                     return false;
//                 } else {
//                     $isValidPhone = true;
//                 }
//             } else {
//                 $response['message'] = "Incorrect phone no.!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//
//             if ($isValidEmail && $isValidPhone) {
//                 // inserting into user table
//                 $user_id = $this->api_model->insert('customer',[
//                     'name'	    =>  $txtName,
//                     'email'	    =>  $txtEmail,
//                     'phone'	    =>  $txtPhone,
//                     'registered_on' => $registration_date,
//                     // 'address'	    =>  $txtAddress,
//                     'password'	=>  md5($txtPassword),
//                     'status'	=>  'active',
//                 ]);
//
//                 $sub="Aamarbahok Registration Successfull";    //subject
//          			 $msg= /*-----------email body starts-----------*/
//          				 'Dear Merchant, '.$txtName.' thank you for registering with us,please use below credentials to login to your account,
//
//          				 User Details:-
//          				 -------------------------------------------------
//          				 Email   : ' . $txtEmail . '
//          				 Password: ' . $txtPassword . '
//          				 -------------------------------------------------
//
//          				 Note* -Kindly change your password after loging in to your account for the first time.
//
//          				 ';
//
//          			 $to      = $txtEmail;
//          			 $subject = $sub;
//          			 $message = $msg;
//          			 $headers = 'From: hello@amarbahok.com' . "\r\n" .
//          					 'Reply-To: hello@amarbahok.com' . "\r\n" .
//          					 'X-Mailer: PHP/' . phpversion();
//
//          			 $success = mail($to, $subject, $message, $headers);
//                     $response['message'] = "Registration successfull!!
//                      Your password Will be sent to your EMAIL.";
//                     $response['success'] = true;
//                 } else {
//                     $response['message'] = "Registration fail.";
//                     $response['success'] = false;
//                 }
//         } else {
//             $response['message'] = "All mandatory fields are not filled up.";
//             $response['success'] = false;
//         }
//         $this->output->set_output(json_encode($response));
//     }
//
//
//     function registerwithotp() {
//         $this->output->set_content_type('application jason');
//         $msg_err = '';
//
//         $txtEmail    = 	strtolower($this->input->post('email'));
//         $txtName     = 	ucwords($this->input->post('name'));
//         $txtPhone    = 	$this->input->post('phone');
//
//         $txtotp    = 	$this->input->post('otpsent');
//
//         // $txtPassword = 'ab'.$this->random_strings(6);
//         $registration_date = date("Y-m-d");
//         // $txtAddress = 	$this->input->post('address');
//
//         if($txtEmail && $txtName && $txtPhone){   // if mandetory data exist
//             $isValidEmail = false;
//             $isValidPhone = false;
//
//             // $txtEmail formate validation & uniq check
//             if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
//                 if ($this->api_model->get_where_all('customer', ['email' => $txtEmail])) {
//                     $response['message'] = "Email is already registered!!
//                      For more info, please contact
//                      Merchant Care Number:
//                      +8801401333000";
//                     // $response['message'] = "<p> Email already registered!! <br> For more info <br>contact Merchant Care Number: <br>+8801401333000 </p>";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//                 } else {
//                     $isValidEmail = true;
//                 }
//             } else {
//                 $response['message'] = "Incorrect email format!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//             // $txtPhone numeric check
//             if (is_numeric($txtPhone) && strlen($txtPhone)) {
//                 if ($this->api_model->get_where_all('customer', ['phone' => $txtPhone])) {
//                     $response['message'] = "Phone no. already exist!!";
//                     $this->output->set_output(json_encode($response));
//                     $response['success'] = false;
//                     return false;
//                 } else {
//                     $isValidPhone = true;
//                 }
//             } else {
//                 $response['message'] = "Incorrect phone no.!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//
//             if ($isValidEmail && $isValidPhone) {
//                 // inserting into user table
//                 $user_id = $this->api_model->insert('customer',[
//                     'name'	    =>  $txtName,
//                     'email'	    =>  $txtEmail,
//                     'phone'	    =>  $txtPhone,
//                     'registered_on' => $registration_date,
//                     // 'address'	    =>  $txtAddress,
//                     'otp'	=>  $txtotp,
//                     'status'	=>  'active',
//                 ]);
//
//                     $response['message'] = "Registration successfull!!
//                      please enter the otp received on your mobile no.";
//                     $response['success'] = true;
//                 } else {
//                     $response['message'] = "Registration fail.";
//                     $response['success'] = false;
//                 }
//         } else {
//             $response['message'] = "All mandatory fields are not filled up.";
//             $response['success'] = false;
//         }
//         $this->output->set_output(json_encode($response));
//     }
//
//     function checkmobileforotp() {
//         $this->output->set_content_type('application jason');
//         $msg_err = '';
//
//         $txtPhone    = 	$this->input->post('phone');
//         $txtEmail    = 	strtolower($this->input->post('email'));
//
//         if($txtEmail && $txtPhone){   // if mandetory data exist
//             $isValidPhone = true;
//             $isValidEmail = true;
//
//             // $txtEmail formate validation & uniq check
//             if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
//                 if ($this->api_model->get_where_all('customer', ['email' => $txtEmail])) {
//                     $isValidEmail = false;
//                 }
//             } else {
//                 $response['message'] = "Incorrect email format!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//             // $txtPhone numeric check
//             if (is_numeric($txtPhone) && strlen($txtPhone)) {
//                 if ($this->api_model->get_where_all('customer', ['phone' => $txtPhone])) {
//                     $isValidPhone = false;
//                 }
//             } else {
//                 $response['message'] = "Incorrect phone no.!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//
//             if ($isValidEmail && $isValidPhone) {
//                     $response['message'] = "valid";
//                     $response['success'] = true;
//                 } else {
//                     $response['message'] = "Phone no. or email already registered";
//                     $response['success'] = false;
//                 }
//         } else {
//             $response['message'] = "All mandatory fields are not filled up.";
//             $response['success'] = false;
//         }
//         $this->output->set_output(json_encode($response));
//     }
//
//
//     function checkmobile_reset_otp() {
//         $this->output->set_content_type('application jason');
//         $msg_err = '';
//
//         $txtPhone    = 	$this->input->post('phone');
//
//         if($txtPhone){   // if mandetory data exist
//             $isValidPhone = false;
//
//             // $txtPhone numeric check
//             if (is_numeric($txtPhone) && strlen($txtPhone)) {
//                 if ($this->api_model->get_where_all('customer', ['phone' => $txtPhone])) {
//                     $isValidPhone = true;
//                 }
//             } else {
//                 $response['message'] = "Incorrect phone no.!!";
//                     $response['success'] = false;
//                     $this->output->set_output(json_encode($response));
//                     return false;
//             }
//
//
//             if ($isValidPhone) {
//                     $response['message'] = "valid";
//                     $response['success'] = true;
//                 } else {
//                     $response['message'] = "Phone no. not registered with us";
//                     $response['success'] = false;
//                 }
//         } else {
//             $response['message'] = "All mandatory fields are not filled up.";
//             $response['success'] = false;
//         }
//         $this->output->set_output(json_encode($response));
//     }
//
//     function forgotwithotp() {
//         $this->output->set_content_type('application jason');
//         $msg_err = '';
//
//         $txtPhone    = 	$this->input->post('phone');
//         $txtotp    = 	$this->input->post('otpsent');
//
//         if($txtPhone){   // if mandetory data exist
//             $isValidPhone = false;
//
//             // $txtPhone numeric check
//             if (is_numeric($txtPhone) && strlen($txtPhone)) {
//
//                     $isValidPhone = true;
//             }
//
//
//             if ($isValidPhone) {
//               $res=$this->api_model->get_where_all('customer',['phone'=>  $txtPhone]);
//               if($res){
//                 // inserting into user table
//                 $user_id = $this->api_model->insert('customer',[
//                     'otp'	=>  $txtotp,
//                 ]);
//
//                 $res = $this->api_model->update('customer', [
//                     'otp'	=>  $txtotp,], ['phone' => $txtPhone]);
//
//                     $response['message'] = "OTP sent on your registered mobile no.";
//                     $response['success'] = true;
//                   }else{
//                     $response['message'] = "not a registered phone number";
//                     $response['success'] = false;
//                   }
//                 } else {
//                     $response['message'] = "Not a valid no.";
//                     $response['success'] = false;
//                 }
//
//         } else {
//             $response['message'] = "All mandatory fields are not filled up.";
//             $response['success'] = false;
//         }
//         $this->output->set_output(json_encode($response));
//     }
//
//     public function random_strings($length_of_string)
//    {
//     $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     return substr(str_shuffle($str_result),
//                        0, $length_of_string);
//    }
//
//
//
//    public function ticketlist(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $mID = $this->input->post('userid');
//      $limit = $this->input->post('limit');
//      $offset = $this->input->post('offset');
//      $data['row'] = $this->api_model->get_all_tickets_merchant($mID,$limit,$offset);
//      $response['tktdetail'] = $data['row'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//
//    public function ticketnumber(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $ticket_id = $this->input->post('tciketid');
//      $totaltktunread = $this->api_model->get_where_all('ticket_chat', ['ticket_id' => $ticket_id,'isread'=>0,'sender'=>'admin']);
//      $ticketcount = count($totaltktunread);
//      $response['tktcount'] = $ticketcount;
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function ticketnotifno(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $mID = $this->input->post('userid');
//      $data['row'] = $this->api_model->get_all_tickets_merchantnotif($mID);
//      $ticketcount = 0;
//      foreach ($data['row'] as $key => $value) {
//        $totaltktunread = $this->api_model->get_where_all('ticket_chat', ['ticket_id' => $value['id'],'isread'=>0,'sender'=>'admin']);
//        $ticketcount = $ticketcount + count($totaltktunread);
//      }
//      $response['tktcnt'] = $ticketcount;
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function versionifno(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $ver = $this->input->post('version');
//        $verinfo = $this->api_model->get_where_all('app_version');
//
//      $response['app_ver'] = $verinfo[0]['current_version'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function financiallist(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $arr['customer_id'] = $this->input->post('userid');
//       $arr['offst'] = $this->input->post('offset');
//      $data['row'] = $this->api_model->getconsignmentInfo($arr);
//      $response['findata'] = $data['row'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//    public function invoicenumber(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $consignment_id = $this->input->post('cons');
//      $data['inv_id'] = $this->api_model->get_invoice($consignment_id);
//      $response['invid'] = $data['inv_id'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function getdash(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
//        $arr['from_date'] = $input['from_date'];
//      }
//      if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
//        $arr['to_date'] = $input['to_date'];
//      }
//
//      $customerId = $this->input->post('userid');
//      $arr['customerid'] = $this->input->post('userid');
//
//      $total_order = $this->general_model->get_allorder($arr);
//      $today_new_order = $this->general_model->get_all_order_todayforcustomer($arr);
//      $total_delivery = $this->general_model->get_all_deliveredforcustomer($arr);
//      $total_cancelled = $this->general_model->get_all_cancelledforcustomer($arr);
//      $total_received = $this->general_model->get_all_receivedforcustomer($arr);
//      $total_intransit = $this->general_model->get_all_transitforcustomer($arr);
//      $total_reschedule = $this->general_model->get_all_rescheduleforcustomer($arr);
//      $total_returned= $this->general_model->get_all_returnforcustomer($arr);
//
//      $total_sales = $this->general_model->get_totalsales($customerId);
//      $total_paid = $this->general_model->get_totalpaid($customerId);
//      $total_due = $this->general_model->get_totaldue($customerId);
//      $total_dcpaid = $this->general_model->get_totaldcpaid($customerId);
//      $result = array_merge($total_order, $total_cancelled,$total_received,$today_new_order,$total_intransit,$total_delivery,$total_reschedule,$total_returned,$total_sales,$total_paid);
//      $response['res'] = $result;
//      $response['totaldue'] = $total_due;
//      $response['totaldcpaid'] = $total_dcpaid;
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function dashboard(){
//      $this->output->set_content_type('application jason');
//        if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
//          $arr['from_date'] = $input['from_date'];
//        }
//        if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
//          $arr['to_date'] = $input['to_date'];
//        }
//
//        $customerId = $this->session->userdata('id');
//        $arr['customerid'] = $customerId;
//
//        $data['total_order'] = $this->general_model->get_allorder($arr);
//        $data['today_new_order'] = $this->general_model->get_all_order_todayforcustomer($arr);
//        $data['total_delivery'] = $this->general_model->get_all_deliveredforcustomer($arr);
//        $data['total_cancelled'] = $this->general_model->get_all_cancelledforcustomer($arr);
//        $data['total_received'] = $this->general_model->get_all_receivedforcustomer($arr);
//        $data['total_intransit'] = $this->general_model->get_all_transitforcustomer($arr);
//        $data['total_reschedule'] = $this->general_model->get_all_rescheduleforcustomer($arr);
//        $data['total_returned'] = $this->general_model->get_all_returnforcustomer($arr);
//
//        $data['total_sales'] = $this->general_model->get_totalsales($customerId);
//        $data['total_paid'] = $this->general_model->get_totalpaid($customerId);
//        $data['total_due'] = $this->general_model->get_totaldue($customerId);
//        $data['total_dcpaid'] = $this->general_model->get_totaldcpaid($customerId);
//
//        $this->output->set_output(json_encode($response));
//    }
//
//    public function consdata(){
//      $this->output->set_content_type('application jason');
//
//      $consid = $this->input->post('constoget');
//      $data = array();
//      $data['row'] = $this->api_model->getconsdetail($consid);
//      $response['cdata'] = $data['row'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function consedit(){
//      $this->output->set_content_type('application jason');
//
//      $consid = $this->input->post('constoedit');
//      $data = array();
//      $data['row'] = $this->api_model->get_where_all('consignment', ['id' => $consid]);
//      $data['shipingd'] = $this->api_model->get_where_all('shiping', ["id" => $data['row'][0]['recipient_address']]);
//      $response['cdata'] = $data['row'];
//      $response['sdata'] = $data['shipingd'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function getps_area(){
//      $this->output->set_content_type('application/json');
//      $response = array();
//      $service_ps = $this->input->post('service_ps');
//      if ($service_ps > 0) {
//          $response['data'] = $this->api_model->get_where_all('police_station',['id' => $service_ps,'status' => 'active']);
//      }
//     $this->output->set_output(json_encode($response));
//
//    }
//
//    public function getpackage(){
//      $this->output->set_content_type('application/json');
//      $response = array();
//      $packageid = $this->input->post('package_id');
//      if ($packageid > 0) {
//          $response = $this->api_model->get_where_all('package',['id' => $packageid,'status' => 'active']);
//      }
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function updateorder(){
//      $this->output->set_content_type('application/json');
//
//      $id = $this->input->post('id');
//
//      if (isset($id) && $id > 0) {
//        $cash_collect = $this->input->post('cash_collect');
//        $amounttocollect = $cash_collect;
//        $total_price = $this->input->post('total_price');
//        $total_cod_charge = $this->input->post('total_cod_price');
//        $paytomerch = floatval($cash_collect) - floatval($total_price)-round($total_cod_charge);
//        $grand_total = floatval($total_price)+round($total_cod_charge);
//        $product_id =  $this->input->post('product_id');
//        $total_price_product = $this->input->post('total_price_product');
//        $product_price = $total_price_product;
//         $total_weight =  $this->input->post('total_weight');
//         $product_weight = $total_weight;
//          $instructions =  $this->input->post('notes');
//          $parcel_cat =  $this->input->post('parcel_cat');
//
//      $res = $this->api_model->update('consignment', [
//          'cash_collection' => $cash_collect,
//          'total_cod_charge' => $total_cod_charge,
//          'product_id' => $product_id,
//          'amounttocollect'=> $amounttocollect,
//          'parcel_category'=> $parcel_cat,
//          'paytomerch' => $paytomerch,
//           'product_price' => $product_price,
//           'total_price_product' => $total_price_product,
//           'product_weight' => $product_weight,
//           'total_weight' => $total_weight,
//           'payment_status_merchant' =>"due",
//           'grand_total' => $grand_total,
//          'instructions' => $instructions,
//          'total_price' => $total_price], ['id' => $id]);
//        }
//        $response['message'] = "Consignment updated successfully";
//        $response['success'] = true;
//
//          $this->output->set_output(json_encode($response));
//    }
//
//    public function raiseatkt(){
//      $this->output->set_content_type('application/json');
//
//      $ticketno = 'AB-T'.$this->random_strings(4);
//      $date = date("Y-m-d H:i:s");
//      $merchantId = $this->input->post('merchant');
//
//        $res = $this->api_model->insert('ticket', ['ticket_no' => $ticketno,
//        'consignment_no' => $this->input->post('consid'),
//        'subject' => $this->input->post('subject'),
//        'merchant' => $merchantId,
//        'description' => $this->input->post('description'),
//        'date_open' => $date,
//        // 'file' => $this->input->post('fileValue')
//        ]);
//
//        $response['message'] = "Ticket raised successfully";
//        $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function trackdetail(){
//      $this->output->set_content_type('application/json');
//       $consid = $this->input->post('considtofetch');
//        $getid= $this->api_model->get_where_all('consignment', [' id' => $consid]);
//       $consignmentId = $getid[0]['consignment_id'];
//
//      $response['consignment_id'] = $this->api_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
//      if(!empty($response['consignment_id'])){
//      $response['customer']= $this->api_model->get_where_all('shiping', [' id' => $response['consignment_id'][0]['recipient_address']]);
//      $response['consignmentDetail']= $this->api_model->get_where_all('tracking', [' consignmentId' => $consignmentId],'','','date','DESC');
//    }
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function gettktd(){
//      $this->output->set_content_type('application/json');
//      $tktId = $this->input->post('tcktId');
//       $response['tktdetail'] = $this->api_model->get_where_all('ticket', [' id' => $tktId]);
//       $response['consid'] = $this->api_model->get_where_all('consignment', [' id' => $response['tktdetail'][0]['consignment_no']]);
//       $response['cusname'] = $this->api_model->get_where_all('shiping', [' id' => $response['consid'][0]['recipient_address']]);
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function financiallistdetail(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $arr['consid'] = $this->input->post('financeId');
//      $arr['customer_id'] = $this->input->post('userid');
//      $data['row'] = $this->api_model->getconsignmentInfodetail($arr);
//      $response['findata'] = $data['row'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function paymnetlist(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $arr['customer_id'] = $this->input->post('userid');
//      $limit = $this->input->post('limit');
//      $offset = $this->input->post('offset');
//      // $data['transaction'] = $this->api_model->get_where_all('trans_history',['merchant'=>$arr['customer_id']],[],[],'date','DESC');
//      $data['transaction'] = $this->api_model->get_all_pymntlist($arr['customer_id'],$limit,$offset);
//      $response['pmtdata'] = $data['transaction'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function paymentlistdetail(){
//      $this->output->set_content_type('application jason');
//      $invid = $this->input->post('pId');
//      $invdetail =  $this->api_model->get_where_all('trans_history',['id'=>$invid]);
//      $row = $invdetail[0]['consignments'];
//      $consignments = explode(',', $row);
//      $out = array();
//      foreach ($consignments as $name => $value) {
//          array_push($out, "'$value'");
//      }
//      $consout = implode(",",$out);
//      $data = array();
//      $data['tran_history'] = $this->api_model->get_history($consout);
//      $response['pymtdata'] = $data['tran_history'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function districts(){
//      $this->output->set_content_type('application jason');
//
//      $data = array();
//      $data['dist'] = $this->api_model->get_where_all('district',['status'=>'active']);
//      $response['distdata'] = $data['dist'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function stationlist(){
//      $this->output->set_content_type('application jason');
//       $distid = $this->input->post('district');
//      $data = array();
//      $data['ps'] = $this->api_model->get_where_all('police_station',['district'=>$distid]);
//      $response['pstdata'] = $data['ps'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function getpromo(){
//      $this->output->set_content_type('application jason');
//      $cus = $this->input->post('cid');
//      $data = array();
//      $data['discode'] = $this->api_model->get_where_all('discount',['merchant' => $cus,'status' => 'active']);
//      $response['codedata'] = $data['discode'];
//      $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function getDiscounredprice(){
//      $this->output->set_content_type('application jason');
//      $code = $this->input->post('promo_code');
//      $merchant = $this->input->post('customer');
//      $data = array();
//      $response['disp'] = $this->api_model->get_where_all('discount',['promo_code' => $code,'merchant' => $merchant,'status' => 'active']);
//      // $response['codedata'] = $result;
//      // $response['message'] = "success";
//      $response['success'] = true;
//
//      $this->output->set_output(json_encode($response));
//    }
//
//    public function submitorder(){
//      $this->output->set_content_type('application/json');
//
//        $consignment_id = $this->input->post('consignment_id');
//        $customer = $this->input->post('customeridd');
//        $del_policeStation = $this->input->post('police_station');
//        $cash_collect = $this->input->post('cash_collect');
//        $amounttocollect = $cash_collect;
//        $total_price = $this->input->post('total_price');
//        $total_cod_charge = $this->input->post('total_cod_price');
//        $paytomerch = floatval($cash_collect) - floatval($total_price)-round($total_cod_charge);
//        $raddress = $this->input->post('recipient_address_shipping');
//        $parcel_cat = $this->input->post('category');
//        $product_id =  $this->input->post('product_id');
//        $parcel_type = 'parcel';
//        $total_weight =  $this->input->post('total_weight');
//        $product_weight = $total_weight;
//        $total_price_product = $this->input->post('total_price_product');
//        $product_price = $total_price_product;
//        $extra_amount = floatval($cash_collect)-floatval($total_price_product);
//        $package_name = $this->input->post('package_name');
//        // $deladdress =
//        $district = $this->input->post('service_ps');
//        $policeStation = $this->input->post('service_dis');
//        $grand_total = floatval($total_price)+round($total_cod_charge);
//        $select_branch = $this->input->post('select_branch');
//        $promo_code = $this->input->post('promo_code');
//        $tomorrow = date("Y-m-d", strtotime('tomorrow'));
//         $instructions =  $this->input->post('notes');
//
//          $resshipping = $this->api_model->insert('shiping', [
//            'recipient_number' => $this->input->post('recipient_number'),
//            'recipient_name' => $this->input->post('recipient_name'),
//            'recipient_address' => $this->input->post('recipient_address_shipping'),
//            'recipient_address_2' => "",
//
//            'district' => $this->input->post('distt'),
//            'police_station' => $this->input->post('police_station'),
//            's_lat' =>"",
//            's_lng'=>"",
//            's_city' =>""]);
//            $deliveraddress = $resshipping;
//            $deladdress = $deliveraddress;
//
//          if($total_price > 0){
//          $consid = $this->api_model->insert('consignment', [
//              'consignment_id' => $consignment_id,
//              'customer' => $customer,
//              'del_police_station' => $del_policeStation,
//              'amounttocollect'=> $amounttocollect,
//              'paytomerch' => $paytomerch,
//              'pickup_address' => $raddress,
//              'parcel_category'=> $parcel_cat,
//              'product_id' => $product_id,
//              'parcel_type' => $parcel_type,
//              'product_weight' => $product_weight,
//              'total_cod_charge' => $total_cod_charge,
//
//              'extra_amount' => $extra_amount,
//              'cash_collection' => $cash_collect,
//
//              'payment_method' => 'cod',
//              'package_name' => $package_name,
//              'package_price' => 0,
//              'total_weight' => $total_weight,
//              'total_price_product' => $total_price_product,
//              'narration' => 'COD',
//              'payment_status_merchant' =>'due',
//              'recipient_address' => $deladdress,
//              'district' => $district,
//              'police_station' => $policeStation,
//              'del_police_station' => $del_policeStation,
//              'grand_total' => $grand_total,
//              'created_by' => $customer,
//              'by_merchant' => 1,
//              'branch' => $select_branch,
//
//               'product_price' => $product_price,
//               'promo_code' => $promo_code,
//               'delivery_date' =>date('Y-m-d', strtotime($tomorrow)),
//               'delivery_time' => 'any',
//              'no_of_items' => 1,
//              'instructions' => $instructions,
//              'delivery_status' => 'pending',
//               'total_price' => $total_price]);
//                 $this->api_model->insert('tracking', ['consignmentId' => $consignment_id,
//                            'detail' => "order placed"]);
//          $response['message'] = "Consignment created successfully";
//          $response['success'] = true;
//        }else{
//          $response['message'] = "Something went wrong! Pls try again";
//          $response['success'] = false;
//        }
//
//          $this->output->set_output(json_encode($response));
//    }
//
//   public function getconsid(){
//     $this->output->set_content_type('application/json');
//     $response['autono'] = 'AB'.$this->random_strings(8);
//     $response['message'] = "success";
//     $response['success'] = true;
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function updateprofile(){
//     $this->output->set_content_type('application/json');
//
//     $id = $this->input->post("userid");
//     $dataedit = $this->input->post();
//     $res = $this->api_model->get_where_all('customer', ['id' => $id]);
//
//     $row_details = array();
//     $update_date = date("Y-m-d");
//     if($res[0]['name'] != $dataedit['name']){$row_details['name'] = $dataedit['name'];}
//     if($res[0]['m_nid'] != $dataedit['m_nid']){$row_details['m_nid'] = $dataedit['m_nid'];}
//     if($res[0]['phone'] != $dataedit['phno']){$row_details['phone'] = $dataedit['phno'];}
//     if($res[0]['email'] != $dataedit['email']){$row_details['email'] = $dataedit['email'];}
//     if($res[0]['address'] != $dataedit['address']){$row_details['address'] = $dataedit['address'];}
//     if($res[0]['merchant_landmark'] != $dataedit['merchant_landmark']){$row_details['merchant_landmark'] = $dataedit['merchant_landmark'];}
//     if($res[0]['district'] != $dataedit['district']){$row_details['district'] = $dataedit['district'];}
//     if($res[0]['police_station'] != $dataedit['police_station']){$row_details['police_station'] = $dataedit['police_station'];}
//     if($res[0]['pincode'] != null && $res[0]['pincode'] != $dataedit['pincode']){$row_details['pincode'] = $dataedit['pincode'];}
//     if($res[0]['company'] != $dataedit['company']){$row_details['company'] = $dataedit['company'];}
//     if($res[0]['website'] != $dataedit['web']){$row_details['website'] = $dataedit['web'];}
//
//     if(!empty($row_details)){
//       $row_details['profile_id'] = $res[0]['id'];
//       $row_details['update_date'] = $update_date;
//       $row_details['company_name'] =$res[0]['company'];
//       $row_details['approved'] =0;
//       $insert_update = $this->api_model->insert('profile_update',$row_details);
//     }
//
//
//     if($this->input->post('office') == ""){
//       $pickofc = $res[0]['office'];
//     }else{
//       $pickofc = $this->input->post('office');
//     }
//
//     if($this->input->post('police_station') == ""){
//       $ps = $res[0]['police_station'];
//     }else{
//       $ps = $this->input->post('police_station');
//     }
//
//     if($this->input->post('district') == ""){
//       $dist = $res[0]['district'];
//     }else{
//       $dist = $this->input->post('district');
//     }
//
//     if(!empty($this->input->post('picname'))){
//       $logo=$this->input->post('picname');
//     }else{
//       $logo=$res[0]['logo'];
//     }
//
//     $res = $this->api_model->update('customer', ['name' => $this->input->post('name'),
//     'm_nid' => $this->input->post('m_nid'),
//     'package' => $this->input->post('package'),
//     'phone' => $this->input->post('phno'),
//     'email' => $this->input->post('email'),
//     'address' => $this->input->post('address'),
//     'address_2' => $this->input->post('address_2'),
//     'address_3' => $this->input->post('address_3'),
//     'merchant_landmark' => $this->input->post('merchant_landmark'),
//     'district' => $dist,
//     'police_station' => $ps,
//     'pincode' => $this->input->post('pincode'),
//     'company' => $this->input->post('company'),
//     'website' => $this->input->post('web'),
//     'facebook' => $this->input->post('fbPage'),
//     'logo' => $logo,
//     'office' => $pickofc], ['id' => $id]);
//     $res=$this->api_model->get_where_all('customer',['id' => $id]);
//     $response['userdetails'] = $res[0];
//     $response['message'] = "Profile updated successfully";
//     $response['success'] = true;
//     $this->output->set_output(json_encode($response));
//   }
//
//
//   public function updateprofilepayment(){
//     $this->output->set_content_type('application/json');
//
//     $id = $this->input->post("userid");
//     $dataedit = $this->input->post();
//     $res = $this->api_model->get_where_all('customer', ['id' => $id]);
//
//     $row_details = array();
//     $update_date = date("Y-m-d");
//     if($res[0]['bank_account_name'] != $dataedit['baccName']){$row_details['bank_account_name'] = $dataedit['baccName'];}
//     if($res[0]['bank_routing'] != $dataedit['brouting']){$row_details['bank_routing'] = $dataedit['brouting'];}
//     if($res[0]['default_pymnt'] != $dataedit['default_pymnt']){$row_details['default_pymnt'] = $dataedit['default_pymnt'];}
//     if($res[0]['bank_name'] != $dataedit['bName']){$row_details['bank_name'] = $dataedit['bName'];}
//     if($res[0]['bank_branch'] != $dataedit['bBranch']){$row_details['bank_branch'] = $dataedit['bBranch'];}
//     if($res[0]['bank_account'] != $dataedit['bAccno']){$row_details['bank_account'] = $dataedit['bAccno'];}
//     if($res[0]['mobile_banking_type'] != $dataedit['mobile_banking_type']){$row_details['mobile_banking_type'] = $dataedit['mobile_banking_type'];}
//     if($res[0]['mobile_banking_no'] != $dataedit['mobile_banking_no']){$row_details['mobile_banking_no'] = $dataedit['mobile_banking_no'];}
//
//     if(!empty($row_details)){
//       $row_details['profile_id'] = $res[0]['id'];
//       $row_details['update_date'] = $update_date;
//       $row_details['company_name'] =$res[0]['company'];
//       $row_details['approved'] =0;
//       $insert_update = $this->api_model->insert('profile_update',$row_details);
//     }
//
//     $ress = $this->api_model->update('customer', [
//     'bank_account_name' => $this->input->post('baccName'),
//     'bank_routing' => $this->input->post('brouting'),
//     'bank_name' => $this->input->post('bName'),
//     'bank_branch' => $this->input->post('bBranch'),
//     'bank_account' => $this->input->post('bAccno'),
//     'mobile_banking_type' => $this->input->post('mobile_banking_type'),
//     'default_pymnt' => $this->input->post('default_pymnt'),
//     'mobile_banking_no' => $this->input->post('mobile_banking_no')], ['id' => $id]);
//     $resd=$this->api_model->get_where_all('customer',['id' => $id]);
//     $response['userdetails'] = $resd[0];
//     $response['message'] = "Profile updated successfully";
//     $response['success'] = true;
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function offices(){
//     $this->output->set_content_type('application jason');
//
//     $data = array();
//     $data['branch'] = $this->api_model->get_where_all(' branch',['status'=>'active']);
//     $response['bdata'] = $data['branch'];
//     $response['message'] = "success";
//     $response['success'] = true;
//
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function changepass(){
//     $this->output->set_content_type('application jason');
//
//     $id = $this->input->post("userid");
//
//     $check=$this->api_model->get_where_all('customer', ['id' => $id]);
//     $user_pass=$check[0]['password'];
//     $input_pass=md5($this->input->post("password"));
//     if($user_pass==$input_pass){
//       $insert = $this->api_model->update('customer', ['password' => md5($this->input->post('psw')),'pass_updated' => 1],['id'=>$id]);
//       if ($insert){
//         $response['message'] = "Password Updated successfully,please login again";
//         $response['success'] = true;
//       }else{
//         $response['message'] = "Password Update failed";
//         $response['success'] = false;
//       }
//     }else
//     {
//       $response['message'] = "Current Password Mismatch,please try again";
//       $response['success'] = false;
//     }
//
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function createpass(){
//     $this->output->set_content_type('application jason');
//
//     $usedotp = $this->input->post("usedotp");
//
//       $insert = $this->api_model->update('customer', ['password' => md5($this->input->post('psw')),'pass_updated' => 1],['otp'=>$usedotp]);
//       if ($insert){
//         $response['message'] = "Password created successfully,please login again";
//         $response['success'] = true;
//       }else{
//         $response['message'] = "Password creation failed";
//         $response['success'] = false;
//       }
//
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function resetpass(){
//     $this->output->set_content_type('application jason');{
//     $res=$this->api_model->get_where_all('customer',['email'=>  $this->input->post('email')]);
//     if($res){
//             $reset_data = array(
//                 'email' => $this->input->post('email'),
//                'hash' => md5(rand(0, 1000))
//             );
//      $address = $this->input->post('email');
//         $id=$this->api_model->update('customer',$reset_data,['email'=>  $this->input->post('email')]);
//         $user_data=$this->api_model->get_where_all('customer',['email'=>  $this->input->post('email')]);
//         $User_hash = $user_data[0]['hash'];
//         $sub='Amarbahok | Reset Password Link';    //subject
//        $msg= /*-----------email body starts-----------*/
//          'Please click this link to change your account password:
//
//         ' . base_url() . 'login/verify/' . $_POST['email'] . '/' . $User_hash;
//
//        $to      = $address;
//        $subject = $sub;
//        $message = $msg;
//        $headers = 'From: hello@amarbahok.com' . "\r\n" .
//            'Reply-To: hello@amarbahok.com' . "\r\n" .
//            'X-Mailer: PHP/' . phpversion();
//        $success = mail($to, $subject, $message, $headers);
//        if($success){
//          $response['message'] = "Reset mail has been sent, please check your mail!!";
//          $response['success'] = true;
//        }
//     }else{
//       $response['message'] = "Email Not found!!";
//       $response['success'] = false;
//     }
//   }
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function tiktcount(){
//     $this->output->set_content_type('application jason');
//     $conis = $this->input->post("ciid");
//     $totaltkt =  $this->api_model->totaltktopencount($conis);
//     $response['totaltkt'] = $totaltkt;
//     $response['message'] = "success";
//     $response['success'] = true;
//
//     $this->output->set_output(json_encode($response));
//   }
//
//   public function gettktchat(){
//     $this->output->set_content_type('application jason');
//     $tcktChatId = $this->input->post("tcktChatId");
//     $res = $this->api_model->update('ticket_chat', ['isread' => 1], ['ticket_id' => $tcktChatId]);
//     $response['chat'] = $this->api_model->get_where_all('ticket_chat', ['ticket_id' => $tcktChatId]);
//     $tktno = $this->api_model->get_where_all('ticket', ['id' => $tcktChatId]);
//     $response['ticket_id'] = $tcktChatId;
//     $response['ticket_no'] = $tktno[0]['ticket_no'];
//     $response['message'] = "success";
//     $response['success'] = true;
//
//     $this->output->set_output(json_encode($response));
//   }
//   public function sendmsg(){
//     $this->output->set_content_type('application jason');
//     $sender = $this->input->post('name');
//     // date_default_timezone_set('Asia/Jakarta');
//     $ticketid = $this->input->post('tckttid');
//     $ticketno = $this->input->post('tcktnno');
//     $mssg = $this->input->post('txtmsg');
//     $date = date('Y-m-d H:i:s');
//     $message = array(
//                 'sender' => $sender,
//                 'ticket_id' => $ticketid,
//                 'time' => $date,
//                 'text' => $mssg
//              );
//
//     $this->api_model->insert('ticket_chat', $message);
//     $response['message'] = "success";
//     $response['success'] = true;
//
//     $this->output->set_output(json_encode($response));
//   }
//
//   function logoUpload(){
//   $countfiles = count($_FILES['files']['name']);
//   $upload_location = "uploads/merchants/";
//   $files_arr = array();
//   for($index = 0;$index < $countfiles;$index++){
//     $filename = $_FILES['files']['name'][$index];
//     $ext = pathinfo($filename, PATHINFO_EXTENSION);
//     $valid_ext = array('gif', 'png', 'jpg','jpeg');
//     if(in_array($ext, $valid_ext)){
//       $fname = time().$filename;
//       $path = $upload_location.$fname;
//         if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
//           $files_arr[] = $fname;
//        }
//     }else{
//       echo "only gif,png,jpg,jpeg files are allowed";
//     }
//   }
//   $filename = implode('###',$files_arr);
//   $response['message'] = $filename;
//   $response['success'] = true;
//
//   $this->output->set_output(json_encode($response));
// }

}
