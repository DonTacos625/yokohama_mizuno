<?php
	session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<title>マイ情報の編集</title>
</head>
<body>
	<?php
	require_once('header.php');
	if(!isset($_SESSION["my_no"])){ //ログインしていない場合はログインページに誘導
		echo "<a href = './login.php'>ログインページ</a>よりログインしてください。";
		echo "</body></html>";
		exit;
	}
	?>
<body>
<?php
	require_once("header.php");
	if(!isset($_SESSION["my_no"])){
		echo "ログインページよりログインしてください";
		echo "</body></html>";
		exit;
	}
?>
メニューを選んでください。
	<form action="" onsubmit="with(this)for(i=0;i&lt;s.length;i++)if(s[i].checked)location.href=s[i].value;return!1"><b><label><input type="radio" name="s" value="./fb_register.php">個人情報編集</label><br><br><label><input type="radio" name="s" value="./register_group.php">グループ編集</label><br><br><label><input type="radio" name="s" value="./changepw.php">パスワード変更</label><br><br><input type="submit" value="送信" style="font-weight:bold"></b></form>
</body>
</html>