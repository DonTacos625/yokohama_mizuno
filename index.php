<?php
//======================================================================
//  ■： ログインページ login.php
//======================================================================
	/*
		管理はセッションでやるといいかも
	*/

	/*
	//ログイン済み(Cookieが保存されている)なら
	if(isset($_COOKIE["usr_id"])){
		header("HTTP/1.1 301 Moved Permanetly");
		header("Location:./index.php"); //トップページへ
	}
	*/
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '783967058409220', // Replace {app-id} with your app id
  'app_secret' => 'SECRET',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$loginUrl = $helper->getLoginUrl('https://websitetest1234.herokuapp.com/fb-callback.php');

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';


?>
<html>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>研究用SNSページ</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<body>
	<!--fecebookを使ったログイン-->
	<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '783967058409220',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
	<h3>ログインページ</h3>
	<!--
	<?php
//--------------------------------------------------------------------
// ■ エラーメッセージがあったら表示
//--------------------------------------------------------------------
	/*	if (strlen($error)>0){
		echo "<font size=\"2\" color=\"#da0b00\">エラー：{$error}</font><p>";
	}
	*/
	?>
-->
<table cellpadding="5">
	<tr>
		<td>会員ログイン</td>
	</tr>
	<tr>
		<td><form action="./login_submit.php" method="POST">
			<table border="0">
				<tr>
					<td align="left">ユーザID</td>
					<td><input type="text" name="usr_id" size="25"></td>
				</tr>
				<tr>
					<td align="left">パスワード</td>
					<td><input type="password" name="usr_pw"></td></tr>
					<tr>
						<td align="right" colspan="4"><input type="submit" value="Submit"></td>
					</tr>
				</table>
			</form></td>
		</tr>
		<tr>
			<td>Facebook連帯ログイン</td>
		</tr>
		<tr>
			<td>
				</td>
			</tr>
		</table>
		<br>
		<a href="./register_usr.php"><font size = 4>新規利用登録(Sign up)</font></a>
		<br><br>
		<a href="./setsumei.pdf"><font size = 4>利用方法の説明はこちら(How to use)</font></a>
		<br>

	</div>
</body>
</html>