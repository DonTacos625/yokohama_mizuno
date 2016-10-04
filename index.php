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
?>
<html>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>研究用SNSページ</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<body>
	<!--fecebookを使ったログイン-->
	<script>
	// This is called with the results from from FB.getLoginStatus().
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
			document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
		}
	}

	// This function is called when someone finishes with the Login
	// Button.  See the onlogin handler attached to it in the sample
	// code below.
	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '783967058409220',
			cookie     : true,  // enable cookies to allow the server to access the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.7' // use graph api version 2.5
		});

	// Now that we've initialized the JavaScript SDK, we call 
	// FB.getLoginStatus().  This function gets the state of the
	// person visiting this page and can return one of three states to
	// the callback you provide.  They can be:
	//
	// 1. Logged into your app ('connected')
	// 2. Logged into Facebook, but not your app ('not_authorized')
	// 3. Not logged into Facebook and can't tell if they are logged into
	//    your app or not.
	//
	// These three cases are handled in the callback function.

		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	};

	// Load the SDK asynchronously
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function testAPI() {
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', function(response) {
			console.log('Successful login for: ' + response.name);
			document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.id + '!';
			});
		}
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
				<fb:login-button scope="public_profile" onlogin="checkLoginState();">
			</fb:login-button>
			<div id="status"></td>
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