<?php

require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
session_start();
echo "1";

$fb = new Facebook\Facebook([
  'app_id' => 'ID', // Replace {app-id} with your app id
  'app_secret' => 'SECRET',
  'default_graph_version' => 'v2.7',
  ]);

echo "2";

$helper = $fb->getRedirectLoginHelper();

echo "3";

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php',$permissions);

echo "3";
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