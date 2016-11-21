<?php

session_start();

header("Content-type: text/html; charset=utf-8");

require_once("config.php");

$helper = $fb->getRedirectLoginHelper();

$permissions = ""; // Optional permissions

$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php', $permissions);
//$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php',$permissions);
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