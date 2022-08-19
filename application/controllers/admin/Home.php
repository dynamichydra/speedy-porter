<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('customer_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'delivery' || $this->session->userdata('user_type') == 'staff' || $this->session->userdata('user_type') == 'customer_care' || $this->session->userdata('user_type') == 'branch')
        redirect('admin/dashboard');
        $data = array();
        $content = $this->load->view('admin/nonlogin/login', $data, true);
        rendernonlogin($content,['js'=>'user']);
    }

    public function forgot_password()
    {
      $data = array();
      $content = $this->load->view('admin/nonlogin/forgot_password', $data, true);
      rendernonlogin($content,['js'=>'user']);
    }

    public function reset_mail(){
      $this->output->set_content_type('application jason');
      if($this->input->post('user_type') == "delivery" || $this->input->post('user_type') == "receiver"){
        $res=$this->user_model->get_where_all('delivery_person',['email'=>  $this->input->post('email')]);
        if($res){
                $reset_data = array(
                    'email' => $this->input->post('email'),
                   'hash' => md5(rand(0, 1000))
                );
         $address = $this->input->post('email');
            $id=$this->user_model->update('delivery_person',$reset_data,['email'=>  $this->input->post('email')]);
            $user_data=$this->user_model->get_where_all('delivery_person',['email'=>  $this->input->post('email')]);
            $User_hash = $user_data[0]['hash'];
            $sub='SPEEDY PORTER | Reset Password Link';    //subject
    			 $msg= /*-----------email body starts-----------*/
    				 'Please click this link to change your account password:

            ' . base_url() . 'admin/home/verify/' . $_POST['email'] . '/' . $User_hash;

    			 $to      = $address;
    			 $subject = $sub;
    			 $message = $msg;
    			 $headers = 'From: hello@SPEEDYPORTER.com' . "\r\n" .
    					 'Reply-To: hello@SPEEDYPORTER.com' . "\r\n" .
    					 'X-Mailer: PHP/' . phpversion();
    			 $success = mail($to, $subject, $message, $headers);
           if($success){
             $response['message'] = "Reset mail has been sent, please check your mail!!";
             $response['success'] = true;
           }
        }else{
          $response['message'] = "Email Not found!!";
          $response['success'] = false;
        }
      }else{
      $res=$this->user_model->get_where_all('users',['email'=>  $this->input->post('email')]);
      if($res){
              $reset_data = array(
                  'email' => $this->input->post('email'),
                 'hash' => md5(rand(0, 1000))
              );
       $address = $this->input->post('email');
          $id=$this->user_model->update('users',$reset_data,['email'=>  $this->input->post('email')]);
          $user_data=$this->user_model->get_where_all('users',['email'=>  $this->input->post('email')]);
          $User_hash = $user_data[0]['hash'];
          $sub='SPEEDY PORTER | Reset Password Link';    //subject
  			 $msg= /*-----------email body starts-----------*/
  				 'Please click this link to change your account password:

          ' . base_url() . 'admin/home/verify/' . $_POST['email'] . '/' . $User_hash;

  			 $to      = $address;
  			 $subject = $sub;
  			 $message = $msg;
  			 $headers = 'From: hello@SPEEDYPORTER.com' . "\r\n" .
  					 'Reply-To: hello@SPEEDYPORTER.com' . "\r\n" .
  					 'X-Mailer: PHP/' . phpversion();
  			 $success = mail($to, $subject, $message, $headers);
         if($success){
           $response['message'] = "Reset mail has been sent, please check your mail!!";
           $response['success'] = true;
         }
      }else{
        $response['message'] = "Email Not found!!";
        $response['success'] = false;
      }
    }
      $this->output->set_output(json_encode($response));
    }

    public function verify($email=null,$hash=null)
  {
    $res=$this->user_model->get_where_all('users',['email'=>  $email, 'hash'=> $hash]);
    if($res){
    $data = array();
    $data['email'] =  $email;
    $data['hash'] =  $hash;
    $data['user_id']= $res[0]['id'];
    $data['user_type']= $res[0]['user_type'];
    $content = $this->load->view('admin/nonlogin/reset_password', $data, true);
    rendernonlogin($content,['js'=>'user']);
  }elseif(!empty($this->user_model->get_where_all('delivery_person',['email'=>  $email, 'hash'=> $hash]))){
    $resdelivery=$this->user_model->get_where_all('delivery_person',['email'=>  $email, 'hash'=> $hash]);
    if($resdelivery){
    $data = array();
    $data['email'] =  $email;
    $data['hash'] =  $hash;
    $data['user_id']= $resdelivery[0]['id'];
    $data['user_type']= $resdelivery[0]['user_type'];
    $content = $this->load->view('admin/nonlogin/reset_password', $data, true);
    rendernonlogin($content,['js'=>'user']);
  }else{
    redirect('admin/home');
  }
  }
}

  public function update_password(){
    $this->output->set_content_type('application jason');
    if($this->input->post('user_type') == "delivery" || $this->input->post('user_type') == "receiver"){
      if(!empty($this->input->post('password'))){
      $update_data = array(
          'email' => $this->input->post('email'),
         'password' => md5($this->input->post('password')),
         'hash' => ''
      );
      $res=$this->user_model->update('delivery_person',$update_data,['id'=>  $this->input->post('user_id'),'email'=> $this->input->post('email')]);

        $response['message'] = "Password updated successfully,please login again";
        $response['success'] = true;
      }else{
        $response['message'] = "New password cannot be empty!!";
        $response['success'] = false;
      }
    }else{
    if(!empty($this->input->post('password'))){
    $update_data = array(
        'email' => $this->input->post('email'),
       'password' => md5($this->input->post('password')),
       'hash' => ''
    );
    $res=$this->user_model->update('users',$update_data,['id'=>  $this->input->post('user_id'),'email'=> $this->input->post('email')]);

      $response['message'] = "Password updated successfully,please login again";
      $response['success'] = true;
    }else{
      $response['message'] = "New password cannot be empty!!";
      $response['success'] = false;
    }
  }
    $this->output->set_output(json_encode($response));
  }

    public function login(){
        $this->output->set_content_type('application jason');
        $res=$this->user_model->get_where_all('users',['email'=>  $this->input->post('email'),'password'=>  md5($this->input->post('password'))]);
        $deliveryBoy= $this->user_model->get_where_all('delivery_person',['email'=>  $this->input->post('email'),'password'=>  md5($this->input->post('password'))]);
        if(count($res)>0){
            $this->session->set_userdata($res[0]);
            $response['message'] = "Login successfull!!";
            $response['success'] = true;
        }else if(count($deliveryBoy)>0){
          $this->session->set_userdata($deliveryBoy[0]);
          $response['message'] = "Login successfull!!";
          $response['success'] = true;
      }else{
            $response['message'] = "Email or Password did not found!!";
            $response['success'] = false;
        }
        $this->output->set_output(json_encode($response));

    }

    public function register(){
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

    function logout() {
        //delete_cookie('user_id');
        $this->session->sess_destroy();
        $this->load->helper('cookie');
        if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'delivery'  || $this->session->userdata('user_type') == 'staff'  || $this->session->userdata('user_type') == 'branch'){
        redirect('admin');
      }else{
        redirect('/login');
      }
    }

}
