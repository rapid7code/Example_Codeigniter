<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends DOVE_Controller {
  var $created_date;
  var $fonts;
  var $file_share;


  public function __construct() {
    parent::__construct();
    $this->load->model('Users');
    $this->load->library('MyCommon');
    $this->load->library('coke_facebook');
    $this->load->library('Customize');

    $this->fonts = 'public/fonts/UVFDartangnonITCStd.ttf';
    $this->file_share = 'public/fb-background.jpg';

    $this->created_date = date('Y-m-d H:i:s');
  }

	function index(){
		redirect('/');
	}

	function thankyou(){
    $this->data['title'] = 'Thank You';
    $fb_userid = $this->session->userdata('fb_userid');

    if( empty($fb_userid) ){
      redirect('/');
    }

    $this->data['fullname'] = $this->session->userdata('fullname');

    $total = $this->Users->get_total();
    $this->data['total'] = $total;

		$this->render();
	}


  function profile(){
    $returnData = array();
    $access_token = $_POST['access_token'];

    if( !empty($access_token) ) {
		
      $this->coke_facebook->set_access_token($access_token);
      $fb_user = $this->coke_facebook->load();

      if (empty($fb_user->id)) {
          $returnData['E_CODE'] = 401;
          $returnData['E_MSG'] = 'Unauthorized';
          print json_encode($returnData);
          die;
      }
      $dir_save = '';

      if( $this->Users->check_user_exists($fb_user->id) == 0){
        $dir_save = $this->create_avatar_share($fb_user->name);
      }

      if( $this->Users->check_user_exists($fb_user->id) == 2 ){
        $dir_save = $this->create_avatar_share($fb_user->name);
        $upd = array( 'fb_userid' => $fb_user->id, 'avatar' => $dir_save );
        $this->Users->upd_avatar($upd);
      }

      //Insert data
      $info = array(
          'fb_userid' => $fb_user->id,
          'email' => $fb_user->email,
          'full_name' => $fb_user->name,
          'gender' => $fb_user->gender,
          'avatar' => $dir_save,
          'link' => $fb_user->link,
          'status' => 1,
          'created_date' => $this->created_date
      );

      $id = $this->Users->ins_user($info);

      $this->session->set_userdata('fullname', $fb_user->name );
      $this->session->set_userdata('fb_userid', $fb_user->id );
      $this->session->set_userdata('email', $fb_user->email );
      $returnData['E_CODE'] = 0;
      $returnData['E_MSG'] = 'Success';

      print json_encode($returnData);
      die;

    }

    $returnData['E_CODE'] = 401;
    $returnData['E_MSG'] = 'Unauthorized';
    print json_encode($returnData);
    die;

  }

  function update_phone(){
    $returnData = array();
    $phone = $_POST['phone'];
    $fb_userid = $this->session->userdata('fb_userid');

    if( !empty($phone) && !empty($fb_userid) ) {
      $info = array(
        'fb_userid' => $fb_userid,
        'phone' => $phone,
        'modify_date' => $this->created_date
      );


      if( $this->Users->upd_user($info) ){
        $user_data = $this->Users->get_user($fb_userid);

        $returnData['URL_SHARE'] = base_url() . $user_data['avatar'];
        $returnData['E_CODE'] = 0;
        $returnData['E_MSG'] = 'Success';
        print json_encode($returnData);
        die;
      } else {
        $returnData['E_CODE'] = 402;
        $returnData['E_MSG'] = 'Not Success';
        print json_encode($returnData);
        die;
      }
    }

    $returnData['E_CODE'] = 401;
    $returnData['E_MSG'] = 'Unauthorized';
    print json_encode($returnData);
    die;
  }

  function create_avatar_share($name){
    //--->Create File Share FB By User
    $filename = date("Ymd") . uniqid().'.jpg';
    $text_size = 38;

    if( strlen($name) >= 10 ){
      $text_size = 25;
    }

    //$text = substr($name,0, 13).'..'; //word_limiter($fb_user->name, 13); //$fb_user->name;
    $text = $name;
    $dir = $this->customize->create_folder_date('public/user_photos/');
    $dir_save = $dir . '/'. $filename;
    $this->customize->Text_To_An_Image($this->file_share, $dir_save, $text, $this->fonts, $text_size);
    //Create File Share FB By User <---

    return $dir_save;
  }

}