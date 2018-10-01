<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__.'/src/Facebook/autoload.php');
	session_start();

	$fb = new Facebook\Facebook([
	  'app_id'                => '316912795786699',
	  'app_secret'            => '5e91123a93da94e53facb79536deee66',
	  'default_graph_version' => 'v3.1',
	]);
?>
