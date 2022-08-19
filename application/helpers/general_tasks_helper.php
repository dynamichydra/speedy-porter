<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function rendernonlogin($content,$param=  array()) {     //used for sending view file into the layout content...
    $ci = & get_instance();
    $view_data = array(
        'content' => $content,
        'param'=>$param
    );
    $ci->load->view('admin/layout/nonlogin', $view_data);
}

function render($param) {     //used for sending view file into the layout content...
    $ci = & get_instance();
    $ci->load->view('admin/layout/main', $param);
}


function fontendrender($content,$param=  array()) {     //used for sending view file into the layout content...
    $ci = & get_instance();
    $view_data = array(
        'content' => $content,
        'param'=>$param
    );
    $ci->load->view('front/layout/main', $view_data);
}

function frender($param) {     //used for sending view file into the layout content...
    $ci = & get_instance();
    $ci->load->view('frontend/layout/main2', $param);
}

function get_general_settings() {
    $ci = & get_instance();
    $settings = $ci->general_model->get_where_all('settings', array('id' => 1));

    return $settings['0'];
}

function get_menu_icon_name($page_slug = '') {
    $ci = & get_instance();
    $menu_icon = $ci->general_model->get_where_all('menu_icons', array('page_slug' => $page_slug));

    return $menu_icon['0']['name'];
}

function get_menu_icon($page_slug = '') {
    $ci = & get_instance();
    $menu_icon = $ci->general_model->get_where_all('menu_icons', array('page_slug' => $page_slug));

    return $menu_icon['0']['icon'];
}

function get_menu() {     //used for get menu...
    $ci = & get_instance();
    $menu_content = $ci->general_model->get_where_all('category', array('isDelete' => 0, 'isActive' => 1));

    return $menu_content;
}

function get_top_menu() {     //used for get menu...
    $ci = & get_instance();
    $menu_content = $ci->general_model->get_where_all('pages', array('isDelete' => 0, 'isActive' => 1));

    return $menu_content;
}

function get_footer_menu() {     //used for get menu...
    $ci = & get_instance();
    $menu_content = array();
    $main_menu = $ci->general_model->get_where_all('pages', array('isDelete' => 0, 'isActive' => 1, 'parent_id' => 0, 'position' => 'footer'));

    return $main_menu;
}

function get_settings() {     //used for get menu...
    $ci = & get_instance();
    $settings = $ci->general_model->get_where_all('settings', array('id' => 1));
    $current_url = $ci->uri->segment(1);
    $route = $ci->general_model->get_where_all('route', array('url' => $current_url));
    if (count($route) > 0) {
        if (isset($route['0']) && $route['0'] != '') {
            $settings[0]['meta_title'] = $route['0']['meta_name'] != '' ? $route['0']['meta_name'] : $settings[0]['meta_title'];
            $settings[0]['meta_description'] = $route['0']['meta_description'] != '' ? $route['0']['meta_description'] : $settings[0]['meta_description'];
            $settings[0]['meta'] = $route['0']['meta_keywords'] != '' ? $route['0']['meta_keywords'] : $settings[0]['meta'];
        }
    }
    return $settings[0];
}

function get_message($id = '') {
    if ($id != '') {
        $ci = & get_instance();
        $settings = $ci->general_model->get_where_all('message', array('id' => $id));


        if (isset($settings[0])) {
            return $settings[0];
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function get_text_message() {     //used for get menu...
    $ci = & get_instance();
    $text_content = array();
    $text_data = $ci->general_model->get_where_all('list_data', array('isDelete' => 0, 'isActive' => 1, 'type' => 'text_message'));
    foreach ($text_data as $key => $value) {
        array_push($text_content, $value['value']);
    }
    //echo js_array($text_content);
    return js_array($text_content);
}

function js_array($array) {
    $temp = array_map('js_str', $array);
    return '[' . implode(',', $temp) . ']';
}

function js_str($s) {
    return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}

function get_name_list() {
    $ci = & get_instance();
    $text_content = array();
    $text_data = $ci->general_model->get_where_all('consultant', array('isDelete' => 0, 'isActive' => 1));
    foreach ($text_data as $key => $value) {
        array_push($text_content, $value['personal_name']);
    }
    //echo js_array($text_content);
    if (count($text_content) < 1) {
        $text_content['0'] = "No Data Found";
    }
    return js_array($text_content);
}

function make_url_param($data) {
    $data = str_replace(" ", "-", $data);
    $data = str_replace("(", "-", $data);
    $data = str_replace(")", "-", $data);
    $data = str_replace("-(", "-", $data);
    $data = str_replace(")-", "-", $data);
    $data = str_replace("&", "and", $data);
    $data = str_replace(",-", "-", $data);
    $data = str_replace("--", "-", $data);
    $data = str_replace("---", "-", $data);
    $data = str_replace("----", "-", $data);
    $data = str_replace("?", "-", $data);
    $data = str_replace("/", "-", $data);
    $data = str_replace(",", "-", $data);
    return $data;
}

function get_url($page_name) {
    $ci = &get_instance();
    $route_data = $ci->general_model->get_where_all('route', array('page_name' => $page_name));
    return $route_data['0']['url'];
}

function get_text($page_name) {
    $ci = &get_instance();
    $route_data = $ci->general_model->get_where_all('route', array('page_name' => $page_name));
    return $route_data['0']['page_text'];
}

function get_link_by_slug($page_slug) {
    $ci = &get_instance();
    $page = $ci->general_model->get_where_all('pages', array('page_slug' => $page_slug));
    return $page['0']['url_param'];
}

function get_allnotifcount() {
    $ci = &get_instance();
    $notiftkt = $ci->general_model->get_where_all('ticket', array('isread' => 0,'status=' =>'open'));
    $notifprofile = $ci->general_model->get_where_all('profile_update', array('approved' => 0));
    $totalnotif = count($notiftkt) + count($notifprofile);
    // $totalnotif = count($notif);
    return $totalnotif;
}

function get_allnotifcountprofile() {
    $ci = &get_instance();
    $notif = $ci->general_model->get_where_all('profile_update', array('approved' => 0));
    $totalnotifprofile = count($notif);
    return $totalnotifprofile;
}

function get_allnotifcountticket() {
    $ci = &get_instance();
    $notif = $ci->general_model->get_where_all('ticket', array('isread' => 0,'status=' =>'open'));
    $totalnotiftkt = count($notif);
    return $totalnotiftkt;
}

// function get_allnotif() {
//     $ci = &get_instance();
//     $notif = $ci->general_model->get_where_all('ticket', array('isread' => 0,'status=' =>'open'));
//     // $notif_profile_update = $ci->general_model->get_where_all('profile_update', array('approved' => 0));
//     // foreach ($notif_profile_update as $key => $value) {
//     //   if($value[''])
//     // }
//     return $notif;
// }

function get_allnotif() {
    $ci = &get_instance();
    $exclude = array('id', 'profile_id', 'company_name', 'update_date');
    $notif = $ci->general_model->get_where_all('ticket', array('isread' => 0,'status=' =>'open'));
    $notif_profile_update = $ci->general_model->get_where_all('profile_update', array('approved' => 0));

    $changes = array();
    foreach ($notif_profile_update as $key => $arr) {
      $cname = $arr['company_name'];
      $timer = $arr['update_date'];
      $chngid = $arr['id'];
      unset($arr['id'],$arr['profile_id'],$arr['company_name'],$arr['update_date']);
      foreach ($arr as $ke => $value) {
        if(!empty($value)){
          $chang['description'] = $cname." have changed their ".$ke;
          $chang['timer'] = $timer;
          $chang['subject'] = "Merchant Profile Update";
          $chang['id'] = $chngid;
          array_push($changes,$chang);
        }
      }
    }
    $finalnotif = array_merge($notif,$changes);
    return $finalnotif;
}

function get_branchname($bid) {
    $ci = &get_instance();
    if($bid == ""){
      return "N/A";
    }else{
    $bname = $ci->general_model->get_where_all('branch', array('id' => $bid));
    return $bname[0]['name'];
  }
}

?>
