<?php
  //Facebook SDK for PHP の src/ にあるファイルを
  //サーバ内の適当な場所にコピーしておく
  $config = array(
    'appId'  => 'ID',
    'secret' => 'SECRET'
  );
  require_once('./src/Facebook/facebook.php');
  $facebook = new Facebook($config);

  $feed = $facebook->api('/id', 'GET');

  // 結果を出力
  var_dump($feed);
?>
