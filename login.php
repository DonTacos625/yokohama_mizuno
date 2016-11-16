<?php

require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

echo "おｋ";

$fb = new Facebook\Facebook([
  'app_id' => 'ID', // Replace {app-id} with your app id
  'app_secret' => 'SECRET',
  'default_graph_version' => 'v2.7',
  ]);

echo "おｋだよ";

$helper = $fb->getRedirectLoginHelper();

//$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php');

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>