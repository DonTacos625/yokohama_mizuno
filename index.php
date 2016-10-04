<?php
  ini_set( 'display_errors', 1 );
session_start();

// autoload.phpの場所(パス)を記載
require_once __DIR__ . '/Facebook/autoload.php';

$fb = new Facebook\Facebook(array('app_id' => "ID", 'app_secret' => "SECRET", 'default_graph_version' => 'v2.5'));
$helper = $fb->getRedirectLoginHelper();

if(isset($_GET['code'])){
  try {
    $access_token = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (isset($access_token)) {
    var_dump($fb->get('/me/accounts', $access_token));
  }
} else {
  $this_url = (empty($_SERVER['HTTPS'])?'http://':'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $permissions = array('manage_pages', 'publish_pages');
  $login_url = $helper->getLoginUrl($this_url, $permissions);
  echo '<a href="' . $login_url . '">Log in with Facebook!</a>';
}
?>
