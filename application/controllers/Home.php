<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends DOVE_Controller {

    var $CI;

    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();

        $this->load->model('Users');

    }
	function index(){
        $this->data['title'] = 'Hoa Lan Tỏa Sắc';
        $this->render();
	}

  function pledge(){
    $fb_userid = $this->session->userdata('fb_userid');

    if( empty($fb_userid) ){
      redirect('/');
    }
    $this->data['title'] = 'Chia Sẻ Cùng Bạn Bè';
    $this->data['fullname'] = $this->session->userdata('fullname');

    $total = $this->Users->get_total();
    $this->data['total'] = $total;

    $this->render();
  }

}