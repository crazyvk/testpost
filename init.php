<?php


session_start();

require_once(__DIR__.'/src/Facebook/autoload.php');

// $fb = new Facebook\Facebook([
// 'app_id' => 'APP_ID',
// 'app_secret' => 'APP_SECRET',
// 'default_graph_version' => 'v2.9',
// ]);

$fb = new Facebook\Facebook([
	'app_id' => '1166367610178804',
	'app_secret' => '4abfedfd4d1ca06939a1ec14a2521f04',
	'default_graph_version' => 'v2.2',
   ]);

?>