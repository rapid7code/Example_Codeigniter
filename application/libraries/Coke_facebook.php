<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Coke facebook
*
* Author: rapid7code
*		  rapid7code@gmail.com
*
*/

class Coke_facebook
{
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;
		
	var $facebook;
	var $loaded = false;
	// 
	var $app_id;
	var $app_secret;
	var $access_token;
	var $app_token;
	var $app_data;
	var $authorized;
	
	public $fb_user;
	public $fb_userid;

	/**
	 * __construct
	 *
	 * @return void	 
	 **/
	public function __construct()
	{
		$this->ci =& get_instance();
		require_once(APPPATH.'third_party/facebook/facebook.php');

		$this->app_id = $this->ci->config->item('app_id');
		$this->app_secret = $this->ci->config->item('app_secret');

		$this->facebook = new Facebook(array(
		  'appId'  => $this->app_id,
		  'secret' => $this->app_secret
		));
	}
	
	/*
	 * For Facebook API
	 *
	 * */
	
	public function set_access_token($access_token){		
		$this->facebook->setAccessToken($access_token);
	}
	
	public function reload(){
		$this->loaded = false;
		$this->load(true);
	}
	
	public function get_app_token(){
		if( empty($this->app_token) )
			$this->app_token = $this->app_id . '|' . $this->app_secret;
		return $this->app_token;
	}
	
 	public function load(){
        // Load via facebook iframe
        $signed_request = $this->facebook->getSignedRequest();
        $this->access_token = $this->facebook->getAccessToken();
        $this->authorized = ( !empty($this->access_token) && $this->access_token != $this->get_app_token() );

        // Load via facebook iframe
        // get signed request
        if( !empty($signed_request) ) {
            $this->signed_request = $signed_request;
            $this->fb_userid = $signed_request["user_id"];
            $this->page_id = $signed_request["page"]["id"];
            $this->page_admin = $signed_request["page"]["admin"];
            $this->is_liked = $signed_request["page"]["liked"];
            $this->fb_user_country = $signed_request["user"]["country"];
            $this->fb_user_locale = $signed_request["user"]["locale"];
        }  else if( $this->authorized ) {
            $this->fb_userid = $this->facebook->getUser();
        }

        $this->fb_user = $this->get_fb_user();

		return $this->fb_user;
		
	}
	
	public function get_fb_user( $fb_userid = 'me' ) {
		if( empty($fb_userid) ) 
			return false;
		
		//stdClass Object
		$fb_user = json_decode(json_encode($this->graph_fb_user( $fb_userid )));

		return $fb_user;
	}
	
	public function graph_fb_user( $fb_userid = 'me' ) {		
		if( !$this->authorized )
			return false;
			
		// Graph facebook user info.
		try{
			// Query user info using FQL		
			$result = $this->facebook->api('/v2.0/' . $fb_userid);
			
			return $result;
		}catch( Exception $e ) {
			return false;
		}
	}
	

}