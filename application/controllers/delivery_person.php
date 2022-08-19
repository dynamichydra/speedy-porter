
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class delivery_person extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('delivery_person_model');
    }

    public function index() {
        $data = array();
        $data['row'] = $this->delivery_person_model->get_where_all('delivery_persons');
        $content = $this->load->view('admin/delivery_person/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'delivery_person list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'delivery_person list']], true);
        $renderdata = ['page_title' => 'Wellcome to admin user', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create delivery_person', 'nav' => ['dashboard' => 'Dashboard', 'delivery' => 'delivery_person list', 'blank' => 'Create delivery_person']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit delivery_person";
            $pageData["nav"]["blank"] = "Edit delivery_person";
            $data['row'] = $this->user_model->get_where_all('delivery_persons', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/delivery_person/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Wellcome to admin user', 'js' => ['delivery_person'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
            $res = $this->user_model->get_where_all('delivery_persons', ['email' => $this->input->post('email'), 'id<>' . $id => null]);
            if (count($res) > 0) {
                $response['message'] = "Email address already exits";
                $response['success'] = false;
            } else {
                $res = $this->delivery_person_model->update('delivery_persons', ['name' => $this->input->post('name'), 'email' => $this->input->post('email')], ['id' => $id]);
                $response['message'] = "User updated successfully";
                $response['success'] = true;
            }
        } else {
            $res = $this->delivery_person_model->get_where_all('users', ['email' => $this->input->post('email')]);
            if (count($res) > 0) {
                $response['message'] = "Email address already exits";
                $response['success'] = false;
            } else {
                $res = $this->delivery_person_model->insert('users', ['name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'password' => $this->input->post('password')]);
                $response['message'] = "delivery_person creation successfully";
                $response['success'] = true;
            }
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->delivery_person_model->delete('delivery_persons', ['id' => $id]);
        $response['message'] = "User deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

}
