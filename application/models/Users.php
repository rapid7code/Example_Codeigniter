<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

  function get_user($fb_userid){
    $query = $this->db->get_where('dove_register', array('fb_userid' => $this->db->escape_str($fb_userid) ));
    return $query->row_array();
  }

  function get_total(){
    $query = $this->db->get_where('dove_register');
    return $query->num_rows();
  }

  function get_all($limit = '', $start = '' ){
    if( !empty($limit) ){
      $sql = 'select * from dove_register order by id desc limit ' . $start . ', ' . $limit;
      $query = $this->db->query($sql);
    } else {
      $query = $this->db->order_by('id', 'desc')->get_where('dove_register');
    }
    return $query->result_array();
  }

  function get_winner_list(){
    $query = $this->db->order_by('id', 'desc')->get_where('dove_register', array('win_status' =>  1) );
    return $query->result_array();
  }

  function check_user_exists($fb_userid){
    $query = $this->db->get_where('dove_register', array( 'fb_userid'=> $this->db->escape_str($fb_userid) ));

    $arr_db = $query->row_array();

    if( empty($arr_db) ) {
      return 0;
    } else if( empty($arr_db['avatar'])) {
      return 2;
    } else {
      return 1;
    }
  }

  function ins_user($info){
    $query = $this->db->get_where('dove_register', array( 'fb_userid'=> $this->db->escape_str($info['fb_userid']) ));

    $arr_db = $query->result_array();

    if( empty($arr_db) ){

      $this->db->insert('dove_register', $info);

      $id = $this->db->insert_id();

      return $id;
    }

    return 1;
  }

  function upd_user($info){
    $query = $this->db->get_where('dove_register', array( 'fb_userid'=> $this->db->escape_str($info['fb_userid']) ));

    $arr_db = $query->row_array();

    if( !empty($arr_db) ){

      $data = array('phone' => $info['phone'], 'modify_date' => $info['modify_date'] );

      $this->db->update('dove_register', $data, array('fb_userid' => $this->db->escape_str($info['fb_userid']) ));

      return TRUE;

    } else {
      return FALSE;
    }
  }

  function upd_avatar($info){
    $query = $this->db->get_where('dove_register', array( 'fb_userid'=> $this->db->escape_str($info['fb_userid']) ));

    $arr_db = $query->row_array();

    if( !empty($arr_db) ){

      $data = array('avatar' => $info['avatar']  );

      $this->db->update('dove_register', $data, array('fb_userid' => $this->db->escape_str($info['fb_userid']) ));

      return TRUE;

    } else {
      return FALSE;
    }
  }

  function __lucky_draw($total_win = '200'){
    $query = $this->db->order_by('id', 'RANDOM')
                      ->limit($total_win)
                      ->get_where('dove_register');

    $arr_db = $query->result_array();

    return $arr_db;
  }

  function upd_status_winner($id){
    $query = $this->db->get_where('dove_register', array( 'id'=> $this->db->escape_str($id) ));

    $arr_db = $query->row_array();

    if( !empty($arr_db) ){

      $data = array('win_status' => 1, 'winner_date' => date('Y-m-d H:i:s')  );

      $this->db->update('dove_register', $data, array('id' => $this->db->escape_str($id) ));

      return TRUE;

    } else {
      return FALSE;
    }
  }

  function upd_admin_draw($username){
    $query = $this->db->get_where('dove_users', array( 'username'=> $this->db->escape_str($username) ));

    $arr_db = $query->row_array();

    if( !empty($arr_db) ){

      $data = array('draw_status' => 1, 'action_date' => date('Y-m-d H:i:s')  );

      $this->db->update('dove_users', $data, array('username' => $this->db->escape_str($username) ));

      return TRUE;

    } else {
      return FALSE;
    }
  }

  function __reset_winner(){
    $data = array( 'win_status' => 0, 'winner_date' => '0000-00-00 00:00:00' );
    $this->db->update('dove_register', $data);

    $data1 = array( 'draw_status' => 0, 'action_date' => '0000-00-00 00:00:00' );
    $this->db->update('dove_users', $data1);
  }
}