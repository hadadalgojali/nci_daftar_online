<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;
include('./config.php');
$db['default'] = array(
	'hostname' => $iHostName,
	'username' => $iUserName,
	'password' => $iPassword,
	'database' => $iDb,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE,
	'port'=>$iPort
);

// $db['SIM'] = array(
// 		'hostname' => 'localhost',
// 		'username' => 'postgres',
// 		'password' => 'ncimedis',
// 		'database' => 'local_rssm',
// 		'dbdriver' => 'postgre',
// 		'dbprefix' => '',
// 		'pconnect' => TRUE,
// 		'db_debug' => TRUE,
// 		'cache_on' => FALSE,
// 		'cachedir' => '',
// 		'char_set' => 'utf8',
// 		'dbcollat' => 'utf8_general_ci',
// 		'swap_pre' => '',
// 		'encrypt' => FALSE,
// 		'compress' => FALSE,
// 		'stricton' => FALSE,
// 		'failover' => array(),
// 		'save_queries' => TRUE,
// 		'port'=>'5432'
// );

$db['SIM'] = array(
		'hostname' => '192.168.0.138',
		'username' => 'postgres',
		'password' => '123456',
		'database' => 'medismart_madiun',
		'dbdriver' => 'postgre',
		'dbprefix' => '',
		'pconnect' => TRUE,
		'db_debug' => TRUE,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE,
		'port'=>'5432'
);

$db['other']['hostname'] 	= "192.168.0.138";
$db['other']['port'] 		= "5432";
$db['other']['username'] 	= "postgres";
$db['other']['password'] 	= "123456";
$db['other']['database'] 	= "medismart_madiun";
$db['other']['dbdriver'] 	= "postgre";
$db['other']['dbprefix'] 	= "";
$db['other']['pconnect'] 	= FALSE;
$db['other']['db_debug'] 	= true;
$db['other']['cache_on'] 	= FALSE;
$db['other']['cachedir'] 	= "";
$db['other']['char_set'] 	= "utf8";
$db['other']['dbcollat'] 	= "utf8_general_ci";

// $db['other'] = array(
// 	'hostname' => "localhost",
// 	'username' => "postgres",
// 	'password' => "ncimedis",
// 	'database' => "local_rssm",
// 	'dbdriver' => 'postgre',
// 	'dbprefix' => '',
// 	'pconnect' => TRUE,
// 	'db_debug' => TRUE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE,
// 	'port'=>"5432"
// );


