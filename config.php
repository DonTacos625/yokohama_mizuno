<?php
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => getenv('ID'), // Replace {app-id} with your app id
  'app_secret' => getenv('SECRET'),
  'default_graph_version' => 'v2.7',
  ]);
?>