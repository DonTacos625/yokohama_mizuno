<? php
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
	//facebookログインのPHP記述
	/*
	ここに記述
	*/

?>
<html>
<!--<head>-->
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>研究用SNSページ</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<body>
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
				<td align="right" colspan="4"><input type="submit" value="submit"></td>
			</tr>
		</table>
	</form>
	<!--fecebookを使ったログイン-->
	
	<!--
		ここに記述
	-->
	
		<a href="./.test/register_usr.php"><font size = 4>利用登録(Sign up)</font></a>
		<br><br>
		<a href="./setsumei.pdf"><font size = 4>利用方法の説明はこちら(How to use)</font></a>
</body>
</html>