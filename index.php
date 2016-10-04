<?php
//======================================================================
//  ■： ログインページ login_fb.php
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
    // アップロードしたFacebook SDKのfacebook.phpまでのパス
    require_once("./src/facebook.php");
    // appIdとsecretを入力。appIdとsecretはDashboardで確認できます。
    $config = array(
        'appId' => 'ID', 
        'secret' => 'SECRET'
    );
    // 下記の様に$configを引数に持たせて、インスタンス化させます
    $facebook = new Facebook($config);
		// ユーザIDの取得
    $user = $facebook->getUser();

    if($user){
        // ユーザの情報を取得
        $userStatus = $facebook->api('/me','GET');
        var_dump($userStatus);
    }
?>
<html>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>研究用SNSページ</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<body>
<!--fecebookを使ったログイン-->
	<script>
	function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }
	function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '694949437320111',
      xfbml      : true,
      version    : 'v2.7'
    });
    FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  	});
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>

	<h3>研究用みなとみらい観光スポットページへようこそ</h3>
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
	Login<br>
	<!--facebookを使わないログイン-->
	<form action="./login_submit.php" method="POST">
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
	</form>
		<a href="./register_usr.php"><font size = 4>利用登録(Sign up)</font></a>
		<br><br>
		<a href="./setsumei.pdf"><font size = 4>利用方法の説明はこちら(How to use)</font></a>

		<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

<a href="<?php echo $facebook->getLoginUrl();?>">ログイン</a>

</body>
</html>