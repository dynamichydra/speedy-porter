
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->CI = get_instance();
        $this->load->model('main_model');
        $this->load->model('customer_model');
    }

    public function index() {
        // $height = $this->main_model->get_where_all('volumetric', ["status" => 'active']);
        $height = $this->main_model->get_allheight();
        $pincodes = $this->main_model->get_where_all('police_station', ["status" => 'active']);
        $data=array('page_title'=>':: SPEEDY PORTER ::','page_name'=>'home','height'=>$height,'pincodes'=>$pincodes);
        $content = $this->load->view('front/home', $data, true);
        fontendrender($content,$data);
    }

    public function getwidth() {

            $response = array();
            if ($this->input->post('height') != '') {
                $height = $this->input->post('height');
                $response = $this->main_model->get_where_all('volumetric',['height' => $height,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getpackage() {

            $response = array();
                $response = $this->main_model->get_where_all('package',['status' => 'active']);
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function register(){
    	$data=array('page_title'=>'Register | :: SPEEDY PORTER ::','page_name'=>'login');
        $content = $this->load->view('front/register0', $data, true);
        fontendrender($content,$data);
    }

    public function tracking(){
        $data=array('page_title'=>'Tracking | :: SPEEDY PORTER ::','page_name'=>'tracking');
        $content = $this->load->view('front/tracking', $data, true);
        fontendrender($content,$data);
    }

    public function pricing(){
        $data=array('page_title'=>'Pricing | :: SPEEDY PORTER ::','page_name'=>'pricing');
        $content = $this->load->view('front/pricing', $data, true);
        fontendrender($content,$data);
    }

    public function contact(){
        $data=array('page_title'=>'Contact Us | :: SPEEDY PORTER ::','page_name'=>'contact');
        $content = $this->load->view('front/contact', $data, true);
        fontendrender($content,$data);
    }

    public function about_us(){
        $data=array('page_title'=>'About Us | :: SPEEDY PORTER ::','page_name'=>'about');
        $content = $this->load->view('front/about', $data, true);
        fontendrender($content,$data);
    }

    public function privacy_policy(){
        $data=array('page_title'=>'Privacy Policy | :: SPEEDY PORTER ::','page_name'=>'Privacy Policy');
        $content = $this->load->view('front/privacy', $data, true);
        fontendrender($content,$data);
    }

    public function terms(){
        $data=array('page_title'=>'Terms & Conditions | :: SPEEDY PORTER ::','page_name'=>'Terms & Conditions');
        $content = $this->load->view('front/terms', $data, true);
        fontendrender($content,$data);
    }

    public function track_order(){
        $consignmentId = $this->input->post('tracking_number');
        $consignment_id = $this->customer_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
        $consignment= $this->customer_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
        $data=array('page_title'=>'TRACKING STATUS | :: SPEEDY PORTER ::','page_name'=>'TRACKING STATUS','layout_page'=>'delivery_report_nonlogin','consignment'=>$consignment, 'consignment_id'=> $consignment_id);
        $content = $this->load->view('tracking_status', $data, true);
        fontendrender($content,$data);
    }


























    // public function track_order(){
    //     $consignmentId = $this->input->post('track-input');
    //     $consignment_id = $this->customer_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
    //     $consignment= $this->customer_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
    //     $data=array('page_title'=>'TRACKING STATUS | :: SPEEDY PORTER ::','banner_title'=>'TRACKING STATUS','layout_page'=>'delivery_report_nonlogin','consignment'=>$consignment, 'consignment_id'=> $consignment_id);
    //     $this->load->view('layout',$data);
    // }

    public function registerInsert(){
        $this->output->set_content_type('application jason');
        $result = $this->customer_model->get_where_all('customer', ['phone' => $this->input->post('phone')]);
            if (count($result) > 0) {
                $response['message'] = "Contact No already exits";
                $response['target'] = "phone";
                $response['success'] = false;
            } else {
                $result = $this->customer_model->get_where_all('customer', ['email' => $this->input->post('email')]);
            if (count($result) > 0) {
                $response['message'] = "email already exits";
                $response['target'] = "email";
                $response['success'] = false;
            } else {

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('email'),
            'password' => $this->input->post('email')
        );
        $res=$this->customer_model->insert('customer',$data);
        if($res){
            $response['message'] = "Registration successfull!!";
            $response['success'] = true;
        }else{
            $response['message'] = "Registration failed!!";
            $response['success'] = false;
        }
                $this->output->set_output(json_encode($response));
    }
    }
    $this->output->set_output(json_encode($response));
    }


    function insert() {
        $this->output->set_content_type('application jason');
        $msg_err = '';

        $txtEmail    = 	strtolower($this->input->post('email'));
        $txtName     = 	ucwords($this->input->post('name'));
        $txtPhone    = 	$this->input->post('phone');
        $txtPassword = 'ab'.$this->random_strings(6);
        $registration_date = date("Y-m-d");
        // $txtAddress = 	$this->input->post('address');

        if($txtEmail && $txtName && $txtPhone && $txtPassword){   // if mandetory data exist
            $isValidEmail = false;
            $isValidPhone = false;

            // $txtEmail formate validation & uniq check
            if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
                if ($this->customer_model->get_where_all('customer', ['email' => $txtEmail])) {
                    $response['message'] = "Email is already registered!!
                     For more info, please contact
                     Merchant Care Number:
                     +8801401333000";
                    // $response['message'] = "<p> Email already registered!! <br> For more info <br>contact Merchant Care Number: <br>+8801401333000 </p>";
                    $response['success'] = false;
                    $this->output->set_output(json_encode($response));
                    return false;
                } else {
                    $isValidEmail = true;
                }
            } else {
                $response['message'] = "Incorrect email format!!";
                    $response['success'] = false;
                    $this->output->set_output(json_encode($response));
                    return false;
            }

            // $txtPhone numeric check
            if (is_numeric($txtPhone) && strlen($txtPhone)) {
                if ($this->customer_model->get_where_all('customer', ['phone' => $txtPhone])) {
                    $response['message'] = "Phone no. already exist!!";
                    $this->output->set_output(json_encode($response));
                    $response['success'] = false;
                    return false;
                } else {
                    $isValidPhone = true;
                }
            } else {
                $response['message'] = "Incorrect phone no.!!";
                    $response['success'] = false;
                    $this->output->set_output(json_encode($response));
                    return false;
            }


            if ($isValidEmail && $isValidPhone) {
                // inserting into user table
                $user_id = $this->customer_model->insert('customer',[
                    'name'	    =>  $txtName,
                    'email'	    =>  $txtEmail,
                    'phone'	    =>  $txtPhone,
                    'registered_on' => $registration_date,
                    // 'address'	    =>  $txtAddress,
                    'password'	=>  md5($txtPassword),
                    'status'	=>  'active',
                ]);

                $sub="SPEEDY PORTER Registration Successfull";    //subject
         			 $msg= /*-----------email body starts-----------*/
         				 'Dear Merchant, '.$txtName.' thank you for registering with us,please use below credentials to login to your account,

         				 User Details:-
         				 -------------------------------------------------
         				 Email   : ' . $txtEmail . '
         				 Password: ' . $txtPassword . '
         				 -------------------------------------------------

         				 Note* -Kindly change your password after loging in to your account for the first time.

         				 ';

         			 $to      = $txtEmail;
         			 $subject = $sub;
         			 $message = $msg;
         			 $headers = 'From: hello@SPEEDYPORTER.com' . "\r\n" .
         					 'Reply-To: hello@SPEEDYPORTER.com' . "\r\n" .
         					 'X-Mailer: PHP/' . phpversion();

         			 $success = mail($to, $subject, $message, $headers);
                    $response['message'] = "Registration successfull!!
                     Your password Will be sent to your EMAIL.";
                    $response['success'] = true;
                } else {
                    $response['message'] = "Registration fail.";
                    $response['success'] = false;
                }
        } else {
            $response['message'] = "All mandatory fields are not filled up.";
            $response['success'] = false;
        }
        $this->output->set_output(json_encode($response));
    }

    function contact_mailing() {
        $this->output->set_content_type('application jason');
        $msg_err = '';

        $txtEmail    = 	strtolower($this->input->post('email'));
        $txtName     = 	ucwords($this->input->post('name'));
        $txtmsg    = 	$this->input->post('message');

        if($txtEmail && $txtName && $txtmsg){   // if mandetory data exist
            $isValidEmail = false;

            // $txtEmail formate validation & uniq check
            if (filter_var($txtEmail, FILTER_VALIDATE_EMAIL)) {
                    $isValidEmail = true;
            } else {
                $response['message'] = "Incorrect email format!!";
                    $response['success'] = false;
                    $this->output->set_output(json_encode($response));
                    return false;
            }


            if ($isValidEmail) {

                $sub="SPEEDY PORTER Contact Message";    //subject
         			 $msg= /*-----------email body starts-----------*/
         				 'Message: '.$txtmsg.'

         				 User Details:-
         				 -------------------------------------------------
                 Name: ' . $txtName . '
         				 Email   : ' . $txtEmail . '
         				 -------------------------------------------------

         				 ';

         			 $to      = 'debnath.rubel@gmail.com';
         			 $subject = $sub;
         			 $message = $msg;
         			 $headers = 'From: contact@SPEEDYPORTER.com' . "\r\n" .
         					 'Reply-To: contact@SPEEDYPORTER.com' . "\r\n" .
         					 'X-Mailer: PHP/' . phpversion();

         			 $success = mail($to, $subject, $message, $headers);
                    $response['message'] = "Email sent successfully";
                    $response['success'] = true;
                } else {
                    $response['message'] = "Mail sending failed.";
                    $response['success'] = false;
                }
        } else {
            $response['message'] = "All mandatory fields are not filled up.";
            $response['success'] = false;
        }
        $this->output->set_output(json_encode($response));
    }

    public function saveProfile(){
        $this->output->set_content_type('application jason');
        $msg_err = '';

        $txtEmail    =  strtolower($this->input->post('email'));
        $txtName     =  ucwords($this->input->post('name'));
        $txtPhone    =  $this->input->post('phone');
        $txtAddress =   $this->input->post('address');

        if($txtEmail && $txtName && $txtPhone && $txtAddress){   // if mandetory data exist
            $isValidEmail = true;
            $isValidPhone = true;


            if ($isValidEmail && $isValidPhone) {
                // inserting into user table
                $user_id = $this->customer_model->update('customer',[
                  'website' => $this->input->post('web'),
                  'company' => $this->input->post('company'),
                  'bank_name' => $this->input->post('bank_name'),
                  'bank_branch' => $this->input->post('bank_branch'),
                  'bank_account' => $this->input->post('bank_account'),
                  'others' => $this->input->post('others'),
                  'facebook' => $this->input->post('facebook'),
                    'name'      =>  $txtName,
                    'email'     =>  $txtEmail,
                    'phone'     =>  $txtPhone,
                    'address'       =>  $txtAddress,
                ],['id' => $this->session->userdata('id')]);

                    $response['message'] = "Updated successfully!!";
                    $response['success'] = true;
                } else {
                    $response['message'] = "Updated failed.";
                    $response['success'] = false;
                }
        } else {
            $response['message'] = "All mandatory fields are not filled up.";
            $response['success'] = false;
        }
        $this->output->set_output(json_encode($response));
    }

    public function contact_mail()
	{
    $this->output->set_content_type('application jason');
				 $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
				 if ($this->form_validation->run() == TRUE) {
					 $mess = $this->input->post('message');
					 $name = $this->input->post('name');
						 $mail_data = array(
								 'email' => $this->input->post('email'),
								 'name' => $this->input->post('name'),
								 'message' => $this->input->post('message'),
						 );
						 $id=$this->customer_model->insert('contact_mail',$mail_data);

			 $sub="Contact Form";    //subject
			 $msg= /*-----------email body starts-----------*/
				 'Message from '.$name.' ,

				 User Details:-
				 -------------------------------------------------
				 Name   : ' . $name . '
				 Email: ' . $this->input->post('email') . '
				 -------------------------------------------------

				 User Message:-

				 ' . $mess;

			 $to      = 'contact@SPEEDYPORTER.com';
			 $subject = $sub;
			 $message = $msg;
			 $headers = 'From: hello@SPEEDYPORTER.com' . "\r\n" .
					 'Reply-To: hello@SPEEDYPORTER.com' . "\r\n" .
					 'X-Mailer: PHP/' . phpversion();

			 $success = mail($to, $subject, $message, $headers);
			 if($success){
       $this->output->set_output(json_encode(['msg_succ' => 'Mail sent,Thank You For Contacting Us.</br>']));
       return false;
		 }else
		 {
			 $msg_err = error_get_last()['message'];
       $this->output->set_output(json_encode(['msg_err' => $msg_err]));
       return false;
		 }

	 }else{
     $this->output->set_output(json_encode(['msg_err' => 'All mandatory fields are not filled up/please enter valid email.</br>']));

	 }
 }

 public function forgot_password(){

 }

 public function random_strings($length_of_string)
{
 $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
 return substr(str_shuffle($str_result),
                    0, $length_of_string);
}

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

}
