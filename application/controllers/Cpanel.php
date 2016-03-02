<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cpanel extends CI_Controller {

  var $CI;

  function __construct()
  {
    parent::__construct();
    $this->CI =& get_instance();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('table');
    $this->load->library('pagination');
    $this->load->library('exporter');

    $this->load->model('Users');

  }

  function index(){
    $data['page_title'] = 'Administration';

    //$this->lucky_draw();

    $user_id = intval($this->session->userdata('admin_id'));
    $username = $this->session->userdata('username');
    $draw_status = $this->session->userdata('draw_status');

    if( $user_id == 0 && empty($username) ){
      redirect($this->config->item('admin_url').'/login/', 'refresh');
    }

    //Paging Config
    $config = array();
    $config["base_url"] = base_url() . "cpanel/index";

    $total_row = $this->Users->get_total();
    $config["total_rows"] = $total_row;
    $config["per_page"] = 50;
    $config["uri_segment"] = 3;
    $choice = $config["total_rows"] / $config["per_page"];
    $config["num_links"] = 5;//floor($choice);

    $config['cur_tag_open'] = '&nbsp;<a class="current">';
    $config['cur_tag_close'] = '</a>';
    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Previous';
    //Paging Config

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $list = (object)$this->Users->get_all($config["per_page"], $page);

    //Generate table data
    $this->table->set_heading('ID', 'Avatar', 'Full Name', 'Email', 'Gender', 'Phone', 'Winner', 'Created Date' );
    foreach($list as $value){
      $avatar = '<img src="https://graph.facebook.com/'.$value['fb_userid'].'/picture?width=100&height=100" alt="Beauty House of Orchid">';
      if( $value['win_status'] == 0 ){
        $winner = 'No';
      } else {
        $winner = 'Yes';
      }
      $this->table->add_row($value['id'], $avatar, $value['full_name'], $value['email'], $value['gender'], $value['phone'], $winner, $value['created_date']  );
    }
    $table = $this->table->generate();
    $data['table'] = $table;

    $str_links = $this->pagination->create_links();
    $data["pagnation"] = explode('&nbsp;',$str_links );

    //Export data list
    if( $this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('export') != '' ){
      $data_export = array();
      $list = $this->Users->get_all();

      foreach($list as $value){
        if( $value['win_status'] == 0 ){
          $winner = 'No';
        } else {
          $winner = 'Yes';
        }

        $data_export[] = array(
          'id' => $value['id'],
          'full_name' => $value['full_name'],
          'email' => $value['email'],
          'gender' => $value['gender'],
          'phone' => $value['phone'],
          'winner' => $winner,
          'created_date' => $value['created_date']
        );
      }

      $this->exporter->export_excel($data_export, 'list_data_' . date('YmdHis'));
      exit();
    }

    //Draw Data List
    if( $this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('draw') != '' && $draw_status == 0){
      $this->lucky_draw();
      $this->session->set_flashdata('message', 'Draw Winner Success' );
      redirect( '/cpanel/', 'reload');
      exit;
    }

    //Export Winner List
    if( $this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('draw_winner') != '' ) {
      $data_export = array();
      $list = $this->Users->get_winner_list();

      foreach ($list as $value) {
        if ($value['win_status'] == 0) {
          $winner = 'No';
        } else {
          $winner = 'Yes';
        }

        $data_export[] = array(
          'id' => $value['id'],
          'full_name' => $value['full_name'],
          'email' => $value['email'],
          'gender' => $value['gender'],
          'phone' => $value['phone'],
          'winner' => $winner,
          'created_date' => $value['created_date'],
          'winner_date' => $value['winner_date']
        );
      }

      $this->exporter->export_excel($data_export, 'winner_list_data_' . date('YmdHis'));
      exit();
    }

    //Reset Winner for testing
    if( $this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('reset') != ''){
      $this->reset_winner();
      $this->session->set_flashdata('message', 'Reset Winner Success' );
      redirect( '/cpanel/', 'reload');
      exit;
    }

    $data['draw_status'] = $draw_status;
    $this->load->view('cpanel/index', $data);
  }

  public function login(){
    $data['page_title'] = 'Login';
    if($this->input->server('REQUEST_METHOD') == 'POST') {
      if ( $this->input->post('username') && $this->input->post('password') ) {

        $query = $this->db->get_where('dove_users', array( 'username' => $this->db->escape_str($this->input->post('username')), 'password' => md5($this->db->escape_str($this->input->post('password'))) ));

        if ($query->num_rows() > 0) {
          $admin_info = (object) $query->row_array();


          $this->session->set_userdata('admin_id', $admin_info->id );
          $this->session->set_userdata('username', $admin_info->username );
          $this->session->set_userdata('draw_status', $admin_info->draw_status );
          $this->session->set_flashdata('message', 'Login Success' );

          redirect($this->config->item('admin_url'));

        } else {
          $this->session->set_flashdata('message', 'Username or password incorrect. Please try again!' );
        }
      } else {
        $this->session->set_flashdata('message', 'Please input username and password!' );
      }
    }

    $this->load->view('cpanel/login', $data);
  }

  public function logout ()
  {
    $this->session->sess_destroy();
    redirect($this->config->item('admin_url').'/login');
  }

  public function lucky_draw(){
    $data['page_title'] = 'Luck Draw';

    $draw_list = $this->Users->__lucky_draw(5);

    //Update status draw winner
    foreach( $draw_list as $value){
      $id = $value['id'];
      $this->Users->upd_status_winner($id);
    }

    $user_id = intval($this->session->userdata('admin_id'));
    $username = $this->session->userdata('username');

    //Update action draw
    if( $user_id > 0 && !empty($username) ){
      $this->Users->upd_admin_draw($username);
    }

    $this->session->set_userdata('draw_status', 1 );
  }

  public function reset_winner(){
    $this->Users->__reset_winner();
    $this->session->set_userdata('draw_status', 0 );
  }
}