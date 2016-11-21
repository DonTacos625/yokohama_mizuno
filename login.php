<?php

require_once __DIR__ . '/vendor/autoload.php';
session_start();
$fb = new Facebook\Facebook([
  'app_id' => getenv('ID'), // Replace {app-id} with your app id
  'app_secret' => getenv('SECRET'),
  'default_graph_version' => 'v2.7',
  ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions

$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php', $permissions);
//$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php',$permissions);

echo "5";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>
</body>
</html>