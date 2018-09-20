<?php
if(!session_id()){
    session_start();
}


define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/src/Facebook/');
require_once(__DIR__.'/src/Facebook/autoload.php');

$redirectURL   = 'https://testpostvk.herokuapp.com/show.php'; //Callback URL
$fbPermissions = array('publish_actions'); 

$fb = new Facebook\Facebook([
	'app_id' => '1166367610178804',
	'app_secret' => '4abfedfd4d1ca06939a1ec14a2521f04',
	'default_graph_version' => 'v2.2',
   ]);
   
   $helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
		$accessToken = $helper->getAccessToken();
		echo 'Graph returned an error: ' . $accessToken;
    }
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
        // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    //FB post content
    $message = 'Test message from CodexWorld.com website';
    $title = 'Post From Website';
    $link = 'http://www.codexworld.com/';
    $description = 'CodexWorld is a programming blog.';
    $picture = 'http://www.codexworld.com/wp-content/uploads/2015/12/www-codexworld-com-programming-blog.png';
            
    $attachment = array(
        'message' => $message,
        'name' => $title,
        'link' => $link,
        'description' => $description,
        'picture'=>$picture,
    );
    
    try{
        // Post to Facebook
        $fb->post('/me/feed', $attachment, $accessToken);
        
        // Display post submission status
        echo 'The post was published successfully to the Facebook timeline.';
    }catch(FacebookResponseException $e){
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    }catch(FacebookSDKException $e){
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}else{
    // Get Facebook login URL
    $fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
    // Redirect to Facebook login page
    echo '<a href="'.$fbLoginURL.'"><img src="fb-btn.png" /></a>';
}



?>

