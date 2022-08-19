
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('user_model');
    }

    public function index() {
        $data=array('page_title'=>'Login | :: SPEEDY PORTER ::','page_name'=>'login');
        $content = $this->load->view('front/login',$data,true);
        fontendrender($content,$data);
    }

    public function forgot_password() {
        $data=array('page_title'=>'Forgot Password | :: SPEEDY PORTER ::','page_name'=>'Forgot Password');
        $content = $this->load->view('front/forgot_password',$data,true);
        fontendrender($content,$data);
    }

    public function reset_mail(){
      $this->output->set_content_type('application jason');{
      $res=$this->user_model->get_where_all('customer',['email'=>  $this->input->post('email')]);
      if($res){
              $reset_data = array(
                  'email' => $this->input->post('email'),
                 'hash' => md5(rand(0, 1000))
              );
       $address = $this->input->post('email');
          $id=$this->user_model->update('customer',$reset_data,['email'=>  $this->input->post('email')]);
          $user_data=$this->user_model->get_where_all('customer',['email'=>  $this->input->post('email')]);
          $User_hash = $user_data[0]['hash'];
          $sub='SPEEDY PORTER | Reset Password Link';    //subject
  			 $msg= /*-----------email body starts-----------*/
  				 'Please click this link to change your account password:

          ' . base_url() . 'login/verify/' . $_POST['email'] . '/' . $User_hash;

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
    $res=$this->user_model->get_where_all('customer',['email'=>  $email, 'hash'=> $hash]);
    if($res){
    $data = array();
    $data['email'] =  $email;
    $data['hash'] =  $hash;
    $data['user_id']= $res[0]['id'];
    $data['user_type']= $res[0]['user_type'];
    $data=array('page_title'=>'Reset Password | :: SPEEDY PORTER ::','page_name'=>'Reset Password','user_type'=>$res[0]['user_type'],'user_id'=>$res[0]['id']);
    $content = $this->load->view('front/reset_password', $data, true);
    fontendrender($content);
  }
}

public function update_password(){
  $this->output->set_content_type('application jason');{
  if(!empty($this->input->post('pass'))){
  $update_data = array(
     'password' => md5($this->input->post('pass')),
     'hash' => ''
  );
  $res=$this->user_model->update('customer',$update_data,['id'=>  $this->input->post('user_id')]);

    $response['message'] = "Password updated successfully,please login again";
    $response['success'] = true;
  }else{
    $response['message'] = "New password cannot be empty!!";
    $response['success'] = false;
  }
}
  $this->output->set_output(json_encode($response));
}





















    public function login_check(){
        $this->output->set_content_type('application jason');
        $res=$this->user_model->get_where_all('customer',['email'=>  $this->input->post('email'),'password'=>  md5($this->input->post('password')), 'status'=>  'active']);
        // print_r($res[0]);die;
        if(count($res)>0){
            $this->session->set_userdata($res[0]);
            $response['message'] = "Login successfull!!";
            $response['success'] = true;
            $response['pass_updated'] = $res[0]['pass_updated'];
            // redirect(base_url().'merchant/dashboard');
        }else{
            $response['message'] = "Email or Password did not found or Account Inactive!!";
            $response['success'] = false;
        }
        $this->output->set_output(json_encode($response));

    }

    public function login_merchant($merchemail){
        $this->output->set_content_type('application jason');
        $res=$this->user_model->get_where_all('customer',['email'=>  $merchemail]);
        // $res=$this->user_model->get_where_all('customer',['email'=>  $this->input->post('email'),'password'=>  md5($this->input->post('password'))]);
        if(count($res)>0){
            $this->session->set_userdata($res[0]);
            if($res[0]['pass_updated'] == 1){
            redirect(base_url().'admin/dashboard');
            $response['message'] = "Login successfull!!";
            $response['success'] = true;
          }else{
            redirect(base_url().'admin/user/change_pass');
            $response['message'] = "Login successfull!!";
            $response['success'] = true;
          }
            // redirect('frontend/main/customerDashboard');
        }else{
            $response['message'] = "Email or Password did not found!!";
            $response['success'] = false;
        }
        $this->output->set_output(json_encode($response));

    }

}
