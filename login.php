<?php
	//======================================================================
	//  ■：テンプレート
	//======================================================================
	session_start(); //セッションスタート
	require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
	$pgsql = new PostgreSQL;
	if(isset($_SESSION["my_no"]))
		$my_no = $_SESSION["my_no"];
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylet.css"></link>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>ログインページ</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
		<script type="text/javascript">
		</script>
	</head>
	<body>
		<script type="text/javascript">
	// This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
			//document.getElementById('status').innerHTML = '認証はしたよ.';
			// Logged into your app and Facebook.
			testAPI();
			//Ajaxを使った通信
			connection();
		} else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			//document.getElementById('status').innerHTML = 'アプリを認証して下さい.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			//document.getElementById('status').innerHTML = 'Facebookにログインして下さい.';
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
			userid = response.id;
			document.getElementById('status').innerHTML = 'Facebook用ログインボタンを(もう一度)押して下さい.';
		});
	}

	//Ajax通信関数
	function connection(){
		$.ajax({
			url: 'api.php',
            type: 'post', // getかpostを指定(デフォルトは前者)
            dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
            data: { // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
            	u_id: userid
            },
        success:function(){ //facebook初回ログイン
        	//document.getElementById('status').innerHTML = "登録できた！";
        	//alert("しっぱい！");
        	location.href = "./fb_register.php"; //facebook初回ログイン登録用
        	exit;
        },
        error:function(){ //2回目以降のログイン
        	location.href = "./index.php";
        	exit;
        }
      });
	}

	/* エラー文字列の生成 */
	function errorHandler(args) {
		var error;
    // errorThrownはHTTP通信に成功したときだけ空文字列以外の値が定義される
    if (args[2]) {
    	try {
            // JSONとしてパースが成功し、且つ {"error":"..."} という構造であったとき
            // (undefinedが代入されるのを防ぐためにtoStringメソッドを使用)
            error = $.parseJSON(args[0].responseText).error.toString();
          } catch (e) {
            // パースに失敗した、もしくは期待する構造でなかったとき
            // (PHP側にエラーがあったときにもデバッグしやすいようにレスポンスをテキストとして返す)
            error = 'parsererror(' + args[2] + '): ' + args[0].responseText;
          }
        } else {
        // 通信に失敗したとき
        error = args[1] + '(HTTP request failed)';
      }
      return error;
    }

  </script>
  <div id="page">
	<div id="header">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		?>
	</div>
	</div>
  <div id="page">
  	<div id="contents">
  	<div class="label1" align="center">会員ログイン</div>
  	<br>
  		<table cellpadding="5">
  			<form action="./login_submit.php" method="POST">
  				<tr>
  					<td>ユーザID</td>
  					<td><input type="text" name="usr_id" size="25"></td>
  				</tr>
  				<tr>
  					<td>パスワード</td>
  					<td><input type="password" name="usr_pw"></td>
  				</tr>
  				<tr>
  					<td align="right" colspan="4"><input type="submit" value="Submit"></td>
  				</tr>
  			</form>
  		</table>
  		<br><br>
	  	<br>
  		<table>
  		<tr><div class="label1" align="center">SNS連帯</div></tr>
  			<tr>
  				<td>
  					<fb:login-button scope="public_profile" onlogin="checkLoginState();"></fb:login-button>
  					<div id="status"></div>
  				</td>
  			</tr>
  		</table>
  		<table>
  			<tr>
  				<td>
  					<a href="./register_usr.php"><font size = 4>新規利用登録(Sign up)</font></a>
  				</td>
  			</tr>
  				<br><br>
  				<tr>
  				<td>
  					<a href="./setsumei.pdf"><font size = 4>利用方法の説明はこちら(How to use)</font></a>
  				</td>
  			</tr>
  		</table>
  	</div>
  </div>
</body>
</html>