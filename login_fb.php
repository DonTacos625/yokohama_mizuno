<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
$fb = new Facebook\Facebook([
  'app_id' => getenv('ID'), // Replace {app-id} with your app id
  'app_secret' => getenv('SECRET'),
  'default_graph_version' => 'v2.7',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ["public_profile"]; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://study-yokohama-sightseeing.herokuapp.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>