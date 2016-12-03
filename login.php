<?php
	//======================================================================
	//  ■：ログインページ
	//======================================================================
require_once __DIR__ . '/vendor/autoload.php';
session_start(); //セッションスタート
require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
$pgsql = new PostgreSQL;
if(isset($_SESSION["my_no"])){
	$my_no = $_SESSION["my_no"];
}
$fb = new Facebook\Facebook([
'app_id' => getenv('ID'), // Replace {app-id} with your app id
'app_secret' => getenv('SECRET'),
'default_graph_version' => 'v2.7',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ["public_profile"]; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://study-yokohama-sightseeing.herokuapp.com/fb-callback.php', $permissions);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>ログインページ</title>
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<?php //require_once("analysis.php");?>
</head>
<body>
	<div id="page">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		require_once("./linkplace.php");
		echo pwd("login");
		?>
		<div id="contents">
			<table>
				<tr>
					<td>
						<div class="label" align="center">会員ログイン</div>
					</td>
				</tr>
			</table>
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
			<table>
				<tr>
					<td>
						<div class="label" align="center">新規利用登録</div>
					</td>
				</tr>
				<tr>
					<td>
						<a href="./register_usr.php"><font size = 4>登録はこちらから</font></a>
					</td>
				</tr>
			</table>
			<br><br>
			<table>
				<tr>
					<td>
						<div class="label" align="center">SNS連帯</div>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
