<?php
  ini_set( 'display_errors', 1 );
  require_once("./Facebook/Facebook.php");
  $fb = new Facebook\Facebook([
   'app_id' => 'ID', // Replace {app-id} with your app id
   'app_secret' => 'SECRET',
   'default_graph_version' => 'v2.2',
   ]);

 $helper = $fb->getRedirectLoginHelper();

 $permissions = ['email'];  // Optional permissions
 $loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php', $permissions);

 echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; 
?>
