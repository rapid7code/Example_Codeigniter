<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Coke Customize
*
* Author: rapid7code
*		  rapid7code@gmail.com
*
*/

class Customize
{
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	private $CI;

	/**
	 * __construct
	 *
	 * @return void	 
	 **/
	public function __construct()
	{
		//Get an Instance of CodeIgniter
		$this->CI =& get_instance();
		$this->CI->load->library('Validate');
	}
	
	/*
	 * 
	 * This is the funtion for random string 
	 * 
	 */

  function draw_text_up_image(){

  }

  public function __dum($obj){
      print '<pre>';
      print_r($obj);
      print '</pre>';
  }

	public function create_guid($prefix="guid"){
		return md5(time().uniqid($prefix));
	}
	
	public function _guid($prefix="guid"){
		return $this->create_guid($prefix="guid");
	}
	
	public function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
    $str = '';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}
	
	
	/*
	 * 
	 * The string for check security
	 * 
	 */ 
	public function coke_sercurity_code(){
		$sercurity_str = 'aNYwfcoke!Xomtu&2015@#EQYQj';
		
		$_md5 = md5($sercurity_str);
		
		return $_md5;
	}
	
	/*
	 * 
	 * This is the funtion for merge 2 array
	 * 
	 * 
	 */
	public function coke_parse_args( $args, $defaults = '' ) {
        if ( is_object( $args ) )
                $r = get_object_vars( $args );
        elseif ( is_array( $args ) )
                $r =& $args;
        else
               $this->coke_parse_str( $args, $r );

        if ( is_array( $defaults ) )
                return array_merge( $defaults, $r );
        return $r;
	}
	
	public function coke_parse_str($string, &$array){
		parse_str( $string, $array );
		
	 	if ( get_magic_quotes_gpc() )
		 	$array = $this->stripslashes_deep( $array );
		 
		return $array;
		 
	}
	
	public function stripslashes_deep($value) {
        if ( is_array($value) ) {
            $value = array_map('stripslashes_deep', $value);
        } elseif ( is_object($value) ) {
            $vars = get_object_vars( $value );
            foreach ($vars as $key=>$data) {
                $value->{$key} = stripslashes_deep( $data );
            }
        } elseif ( is_string( $value ) ) {
            $value = stripslashes($value);
        }

        return $value;
	}
	
	/*
	 * 
	 * The function about the image/file/video
	 * $dir = media/uploads/
	 */

  public function create_folder_date($dir){
    $year_folder = date("Y");
    $month_folder = date("m");
    $year_dir = $dir.$year_folder;

    if( !file_exists($year_dir)){
      mkdir($year_dir, 0777, true);
      chmod($year_dir, 0777);
    }

    $month_dir = $year_dir.'/'.$month_folder;
    if( !file_exists($month_dir)){
      mkdir($month_dir, 0777, true);
      chmod($month_dir, 0777);
    }

    return $month_dir;
  }
	 
	public function created_user_folder($dir, $uid){
		$year_folder = date("Y");
		$month_folder = date("m");
		$year_dir = $dir.$year_folder;
		
		if( !file_exists($year_dir)){
			mkdir($year_dir, 0777, true);
			chmod($year_dir, 0777);
		}
		
		$month_dir = $year_dir.'/'.$month_folder;
		if( !file_exists($month_dir)){
			mkdir($month_dir, 0777, true);
			chmod($month_dir, 0777);
		}
		
		$dir_user = $month_dir.'/'.$uid;
		$dir_user_photo = $dir_user.'/photos';
		$dir_user_video = $dir_user.'/videos';
		$dir_user_photo_thumb = $dir_user_photo.'/thumb';
		$dir_user_video_thumb = $dir_user_video.'/thumb';
		
		
		if( !file_exists($dir_user) ){		
			mkdir($dir_user, 0777, true);
			chmod($dir_user, 0777);
			
			mkdir($dir_user_photo, 0777, true);
			chmod($dir_user_photo, 0777);
			mkdir($dir_user_photo_thumb, 0777, true);
			chmod($dir_user_photo_thumb, 0777);
			
			mkdir($dir_user_video, 0777, true);
			chmod($dir_user_video, 0777);
			mkdir($dir_user_video_thumb, 0777, true);
			chmod($dir_user_video_thumb, 0777);
	    }
		
		return $dir_user;
		
	}
	
	public function _created_user_folder( $dir_user, $uid ){
		$dir_user = $dir_user.$uid;
		$dir_user_photo = $dir_user.'/photos';
		$dir_user_video = $dir_user.'/videos';
		$dir_user_photo_thumb = $dir_user_photo.'/thumb';
		$dir_user_video_thumb = $dir_user_video.'/thumb';
		
		
		if( !file_exists($dir_user) ){		
			mkdir($dir_user, 0777, true);
			chmod($dir_user, 0777);
			
			mkdir($dir_user_photo, 0777, true);
			chmod($dir_user_photo, 0777);
			mkdir($dir_user_photo_thumb, 0777, true);
			chmod($dir_user_photo_thumb, 0777);
			
			mkdir($dir_user_video, 0777, true);
			chmod($dir_user_video, 0777);
			mkdir($dir_user_video_thumb, 0777, true);
			chmod($dir_user_video_thumb, 0777);
    }
		
		return $dir_user;
	} 
	 
	public function get_info($file){
		if (file_exists($file)) {
			
			$info = getimagesize($file);
	
		$info = array(
	        	'width'  => $info[0],
	        	'height' => $info[1],
	        	'bits'   => $info['bits'],
	        	'mime'   => $info['mime']
	    	);
			return $info;
		} else {
	  		exit('Error: Could not load image ' . $file . '!');
		}	
	} 
	
	public function created_file($image){
		$info = $this->get_info($image);
		$mime = $info['mime'];
			
		if ($mime == 'image/gif') {
			return imagecreatefromgif($image);
		} elseif ($mime == 'image/png') {
			return imagecreatefrompng($image);
		} elseif ($mime == 'image/jpeg') {
			return imagecreatefromjpeg($image);
		}
	}
	
	public function replace_image_as_base64($image_source){	
		if ( preg_match('/png;base64/',$image_source) ) {
			return str_replace('data:image/png;base64,', '', $image_source);
		} elseif( preg_match('/jpeg;base64/',$image_source) ) {
			return str_replace('data:image/jpeg;base64,', '', $image_source);
		} elseif( preg_match('/jpg;base64/',$image_source) ) {
			return str_replace('data:image/jpg;base64,', '', $image_source);
		} elseif( preg_match('/gif;base64/',$image_source) ) {
			return str_replace('data:image/gif;base64,', '', $image_source);
		} elseif( preg_match('/bmp;base64/',$image_source) ) {
			return str_replace('data:image/bmp;base64,', '', $image_source);
		}
	}
	
	public function create_file_zip( $dir_user, $file_name, $base64_str){		
		$dir_zip = $dir_user.'/zip';
		$dir_file_name = $dir_zip.'/'.$file_name.'.zip';
		
		if( !file_exists($dir_zip)){
			mkdir($dir_zip, 0777, true);
			chmod($dir_zip, 0777);
		}
		
		if( !file_exists($dir_file_name)){			
			$files = fopen($dir_file_name, "w");
			fclose($files);
		}
		
		$zip = new ZipArchive();
		$zip->open($dir_file_name, ZipArchive::OVERWRITE);
		
		// Add contents
		$zip->addFromString($file_name, $base64_str);
		
		// Close and send to users
		$zip->close();
	}
	
	public function create_image_as_base64($dir, $imgsrc) {
		$img = str_replace(' ', '+', $imgsrc);
		$data = base64_decode($img);
		
		$success = file_put_contents($dir, $data);
		
		return $dir;
	}
	 
	//Create Thumbnal exactly with the width and height thumbnail
	public function create_thumbnail($file, $dir_save, $thumb_width = 400, $thumb_height = 400){
		$info = $this->get_info($file);
		$image = $this->created_file($file);
		
		if (!$info['width'] || !$info['height']) {
			return;
		}	
		
	  	$original_aspect = $info['width'] / $info['height'];
	  	$thumb_aspect = $thumb_width / $thumb_height;
	
	  	if ( $original_aspect >= $thumb_aspect ) {
	
	     	// If image is wider than thumbnail (in aspect ratio sense)
	     	$new_height = $thumb_height;
	     	$new_width = $info['width'] / ($info['height'] / $thumb_height);
	
	  	}
	  	else {
	     	// If the thumbnail is wider than the image
	    	$new_width = $thumb_width;
	    	$new_height = $info['height'] / ($info['width'] / $thumb_width);
	  	}
		
		$image_old = $image;
	    $image = imagecreatetruecolor($thumb_width, $thumb_height);
		
		$xpos = 0 - (int)(($new_width - $thumb_width) / 2);
		$ypos = 0 - (int)(($new_height - $thumb_height) / 2);
			
		if (isset($info['mime']) && $info['mime'] == 'image/png') {		
			imagealphablending($image, false);
			imagesavealpha($image, true);
			$background = imagecolorallocatealpha($image, 255, 255, 255, 127);
			imagecolortransparent($image, $background);
		} else {
			$background = imagecolorallocate($image, 255, 255, 255);
		}
		
		imagefilledrectangle($image, 0, 0, $thumb_width, $thumb_height, $background);
	
	    imagecopyresampled($image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $info['width'], $info['height']);	
		$this->save_image($image,$dir_save);
		imagedestroy($image_old);
	}

  public function Text_To_An_Image($file, $dir_save, $text, $font, $font_size = '38'){
    $im = imagecreatefromjpeg($file);

    // Create some colors
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, 0, 0, $black);
    $angle = 0;

    $splittext = explode ( "\n" , $text );
    $lines = count($splittext);

    foreach ($splittext as $text) {
      $text_box = imagettfbbox($font_size,$angle,$font,$text);
      $text_width = abs(max($text_box[2], $text_box[4]));
      $text_height = abs(max($text_box[5], $text_box[7]));
      $x = (imagesx($im) - $text_width)/2;
      $y = ((imagesy($im) + $text_height)/2)-($lines-2)*$text_height;
      $lines=$lines-1;
      imagettftext($im, $font_size, $angle, $x+1, $y+2, $black, $font, $text);
      imagettftext($im, $font_size, $angle, $x, $y, $white, $font, $text);
    }

    // Add the text
    #imagettftext($im, $text_size, 0, 232, 220, $white, $font, $text);

    // Using imagepng() results in clearer text compared with imagejpeg()
    imagepng($im, $dir_save);
    imagedestroy($im);
  }

	// Output
	public function save_image($image, $file, $quality = 90) {
		$info = pathinfo($file);
	   
		$extension = strtolower($info['extension']);
		if (is_resource($image)) {
			if ($extension == 'jpeg' || $extension == 'jpg') {				
				imagejpeg($image, $file, $quality);
			} elseif($extension == 'png') {
				imagepng($image, $file);
			} elseif($extension == 'gif') {
				imagegif($image, $file);
			}
			
			imagedestroy($image);
		}	
	}
	
	//Save Avatar from facebook avatar
	public function save_avatar($src_file, $dir){
		//$src_file = str_replace('https', 'http', $src_file);
		if( !empty( $src_file ) ){
			//$image = file_get_contents($src_file);
			$image = $this->getUrlContent($src_file);
			file_put_contents($dir, $image);
			  
			return $dir;
		} else {
			return 0;
		}
	}
	
	public function getUrlContent($url) {
		if (function_exists('curl_init')) {
			$curl = curl_init();
			$max_redirects = 10;

			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($curl, CURLOPT_URL, $url);
			

			curl_setopt($curl, CURLOPT_USERAGENT, "ownCloud Server Crawler");
			
			if (ini_get('open_basedir') === '' && ini_get('safe_mode' === 'Off')) {
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($curl, CURLOPT_MAXREDIRS, $max_redirects);
				$data = curl_exec($curl);
			} else {
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
				$mr = $max_redirects;
				if ($mr > 0) { 
					$newurl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
					
					$rcurl = curl_copy_handle($curl);
					curl_setopt($rcurl, CURLOPT_HEADER, true);
					curl_setopt($rcurl, CURLOPT_NOBODY, true);
					curl_setopt($rcurl, CURLOPT_FORBID_REUSE, false);
					curl_setopt($rcurl, CURLOPT_RETURNTRANSFER, true);
					do {
						curl_setopt($rcurl, CURLOPT_URL, $newurl);
						$header = curl_exec($rcurl);
						if (curl_errno($rcurl)) {
							$code = 0;
						} else {
							$code = curl_getinfo($rcurl, CURLINFO_HTTP_CODE);
							if ($code == 301 || $code == 302) {
								preg_match('/Location:(.*?)\n/', $header, $matches);
								$newurl = trim(array_pop($matches));
							} else {
								$code = 0;
							}
						}
					} while ($code && --$mr);
					curl_close($rcurl);
					if ($mr > 0) {
						curl_setopt($curl, CURLOPT_URL, $newurl);
					} 
				}
				
				if($mr == 0 && $max_redirects > 0) {
					$data = false;
				} else {
					$data = curl_exec($curl);
				}
			}
			curl_close($curl);
		} else {
			$contextArray = null;

			$contextArray = array(
					'http' => array(
						'timeout' => 10
					)
				);

			$ctx = stream_context_create(
				$contextArray
			);
			$data = @file_get_contents($url, 0, $ctx);

		}
		return $data;
	}

	public function ago($i){
	    $m = time()-$i; $o='just now';
	    $t = array('year'=>31556926, 'month'=>2629744, 'week'=>604800, 'day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1);
		
	    foreach($t as $u=>$s){
	        if($s<=$m){$v=floor($m/$s); $o="Posted $v $u".($v==1?'':'s').' ago'; break;}
	    }
	    return $o;
	}

	

}