<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('customer_model');
        $this->load->model('delivery_model');
        $this->load->model('consignment_model');
    }

    public function index() {
      if($this->session->userdata('user_type')!= 'customer')
        // if(empty($this->session->userdata('name')))
      redirect('login');
        $customer=$this->customer_model->get_where_all('customer', ['id' => $this->session->userdata('id')]);
        $packing = $this->delivery_model->get_where_all('package', ['status' => 'active']);
        $data=array('page_title'=>'Create Delivery | :: SPEEDY PORTER ::','banner_title'=>'Create Delivery','layout_page'=>'create_delivery','customer'=>$customer,'packing' => $packing);
        $this->load->view('layout',$data);
    }

    public function createsave() {
        $this->output->set_content_type('application/json');
        // echo $this->input->post('recipient_address');
        // die;
        // $customer = $this->delivery_model->insert('customer', [
        //             'phone' => $this->input->post('recipient_phno'),'name' => $this->input->post('recipient_name'),'address' => $this->input->post('recipient_address')
        //                    ]);

        $from_address = $this->delivery_model->insert('shiping', [
                    'customer' => $this->session->userdata('id'),
                    'recipient_number' => $this->input->post('recipient_phno'),'recipient_name' => $this->input->post('recipient_name'),'recipient_address' => $this->input->post('recipient_address'),'recipient_city' => $this->input->post('recipient_city'),'recipient_area' => $this->input->post('recipient_zone'),'recipient_landmark' => $this->input->post('recipient_landmark'),'recipient_postalcode' => $this->input->post('recipient_postalcode')
                           ]);
        $to_address = $this->delivery_model->insert('shiping', [
                    'recipient_number' => $this->input->post('phno'),'recipient_name' => $this->input->post('name'),'recipient_address' => $this->input->post('address'),'recipient_city' => $this->input->post('city'),'recipient_area' => $this->input->post('zone'),'recipient_landmark' => $this->input->post('landmark'),'recipient_postalcode' => $this->input->post('postalcode')
                           ]);
        $maxno =  $this->consignment_model->get_max_no();
        $no = (((int)$maxno[0]['no']) + 1);
        // $autono = str_pad(((int)$no) + 1,12,'0',STR_PAD_LEFT);
        $autono = $this->random_strings(10);

        $consignment = $this->delivery_model->insert('consignment', ['id' => $this->input->post('id'),
                    'autono' => $no,
                    'consignment_id' => $autono,
                    'customer' => $this->session->userdata('id'),
                    'pickup_address' => $from_address,
                    'recipient_address' => $to_address,
                    'parcel_type' => $this->input->post('product_types'),
                    'payment_method' => $this->input->post('payment_method'),
                //    'delivery_type' => $this->input->post('delivery_type'),
                //    'package_name' => $this->input->post('package_name'),
                //     'product_price' => $this->input->post('product_price'),
                //     'delivery_type' => $this->input->post('delivery_type'),
                //     'promo_code' => $this->input->post('promo_code'),
                     'delivery_date' => $this->input->post("delivery_date") != "" ? date('Y-m-d', strtotime($this->input->post("delivery_date"))) : NULL,
                //     'delivery_time' => $this->input->post('delivery_time'),
                    'no_of_items' => $this->input->post('qnty'),
                //    'item_types' => $this->input->post('item_types'),
                //    'instructions' => $this->input->post('instructions'),
                    ]);

                $res = $this->delivery_model->insert('front_delivery', ['id' => $this->input->post('id'),
                    'consignment' => $consignment,
                    'recipient_from' => $from_address,
                    'recipient_to' => $to_address,
                    'shipment_type' => $this->input->post('product_types'),
                    'quantity' => $this->input->post('qnty'),
                    'packing' => $this->input->post('packing'),
                    'payment_type' => $this->input->post('payment_method'),
                    'delivery_date' => $this->input->post("delivery_date") != "" ? date('Y-m-d', strtotime($this->input->post("delivery_date"))) : NULL
                           ]);

                /*if($this->input->post('product_types') == 'document'){
                    $res['shipment_content'] = $this->input->post('doc_type');
                    $res['shipment_reference'] = $this->input->post('doc_reference');
                }
                else if($this->input->post('product_types') == 'packages'){
                    $res['shipment_content'] = $this->input->post('package_type');
                    $res['shipment_reference'] = $this->input->post('package_reference');
                }*/
                $response['message'] = "Delivery created successfully";
                $response['success'] = true;

        // $this->output->set_content_type('application/json')
        //         ->set_output(json_encode($response))->_display();
        // exit();
                    $this->output->set_output(json_encode($response));
                    return false;
    }


    public function random_strings($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Shufle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}




}
