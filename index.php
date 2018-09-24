<?php

include('init.php');

$helper = $fb->getRedirectLoginHelper();

$redirectURL   = 'https://testpostvk.herokuapp.com/show.php';

$permissions = ['manage_pages','publish_pages'];
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';




?>

