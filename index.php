<?php
	require "main.php";
	 
	if (isset($_SESSION['token'])) {
	  try {
          
          $res = $fb->get('/me/accounts', $_SESSION['token']);
          $res = $res->getDecodedBody();
          
          foreach($res['data'] as $page){
              echo $page['id'] . " - " . $page['name'] . "<br>";
              
          }
          
          ?>
        
        <form method = "post" action = "page.php">
            <input type = "text" name = "pageid" placeholder = "Page ID">
            <input type = "text" name = "message" placeholder="Message">
            <input type = "submit">
        </form>

        <?php
          
	  } catch( Facebook\Exceptions\FacebookSDKException $e ) {
	    echo $e->getMessage();
	    exit;
	  }
	}
	else{
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_posts', 'manage_pages', 'publish_pages'];
		$callback   = 'https://testpostvk.herokuapp.com/show.php';
		$loginUrl    = $helper->getLoginUrl($callback, $permissions);
		echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	}
?>