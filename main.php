<?php
	require "fbsdk/src/Facebook/autoload.php";
	session_start();
	$fb = new Facebook\Facebook([
	  'app_id'                => '1166367610178804',
	  'app_secret'            => '4abfedfd4d1ca06939a1ec14a2521f04',
	  'default_graph_version' => 'v2.5',
	]);
?>