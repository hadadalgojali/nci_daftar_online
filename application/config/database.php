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
		'hostname' => '192.168.1.36',
		'username' => 'postgres',
		'password' => 'ipderssm',
		'database' => 'medismart',
		'dbdriver' => 'postgre',
		'dbprefix' => '',
		'pconnect' => TRUE,
		'db_debug' => FALSE,
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
/*
	'dsn'	=> '',
	'hostname' => $hostname,
	'username' => $username,
	'password' => $password,
	'database' => $database,
	// 'dbdriver' => 'mysqli',
	'dbdriver' => $driver,
	'dbprefix' => '',
	// 'port' => '5432',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE*/
$db['other']['hostname'] = "192.168.1.36";
$db['other']['port'] = "5432";
$db['other']['username'] = "postgres";
$db['other']['password'] = "ipderssm";
$db['other']['database'] = "medismart";
$db['other']['dbdriver'] = "postgre";
$db['other']['dbprefix'] = "";
$db['other']['pconnect'] = TRUE;
$db['other']['db_debug'] = FALSE;
$db['other']['cache_on'] = FALSE;
$db['other']['cachedir'] = "";
$db['other']['char_set'] = "utf8";
$db['other']['dbcollat'] = "utf8_general_ci";

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


