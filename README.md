# Example_Codeigniter
* Step 1: Setup database for site
- Go to application/config/database.php

	$db['default'] = array(
	
		'dsn'	=> '',
		
		'hostname' => 'localhost',
		
		'username' => '', //Input info here
		
		'password' => '', //Input info here
		
		'database' => '', //Input info here
		
		'dbdriver' => 'mysqli',
		
		'dbprefix' => '',
		
		'pconnect' => FALSE,
		
		'db_debug' => (ENVIRONMENT !== 'production'),
		
		'cache_on' => FALSE,
		
		'cachedir' => '',
		
		'char_set' => 'utf8',
		
		'dbcollat' => 'utf8_general_ci',
		
		'swap_pre' => '',
		
		'encrypt' => FALSE,
		
		'compress' => FALSE,
		
		'stricton' => FALSE,
		
		'failover' => array(),
		
		'save_queries' => TRUE
		
	);
	

* Step 2: 
- Go to application/config/config.php:

  - Create ci_session Table:

 `$config['sess_driver'] = 'database';
 
 `$config['sess_cookie_name'] = 'ci_session';
 
 `$config['sess_expiration'] = 7200;
 
 `$config['sess_save_path'] = 'ci_session';
 
 `$config['sess_match_ip'] = FALSE;
 
 `$config['sess_time_to_update'] = 300;
 
 `$config['sess_regenerate_destroy'] = FALSE;
 

* SQL

CREATE TABLE `ci_session` (

	`id` VARCHAR(40) NOT NULL,
	
	`ip_address` VARCHAR(45) NOT NULL,
	
	`timestamp` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	
	`data` BLOB NOT NULL,
	
	PRIMARY KEY (`id`),
	
	INDEX `ci_sessions_timestamp` (`timestamp`)
	
)

COLLATE='latin1_swedish_ci'

ENGINE=InnoDB

;


* Index.php
 - Edit here for debug or disable debug
 -> Turn on
 
`case 'development':

	`error_reporting(-1);
	
	`ini_set('display_errors', 1);
	
-> Turn off	

`case 'development':

	`error_reporting(-1);
	
	`ini_set('display_errors', 0);
	