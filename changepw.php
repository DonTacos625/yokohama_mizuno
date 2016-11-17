<?php
session_start();
//======================================================================
//  ■： 会員登録ページ register_usr.php 
//======================================================================
require_once("PostgreSQL.php");
//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = ""; //ID関係
$error1 = ""; //PW関係

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$my_no = $_SESSION["my_no"];

	// フォームからデータを受け取る
	//--------------------------------
	$oldpw = htmlspecialchars($_POST["oldpw"], ENT_QUOTES) //旧パスワード
	$newpw = htmlspecialchars($_POST["newpw"], ENT_QUOTES);	//新パスワード
	$newpw2 = htmlspecialchars($_POST["newpw2"], ENT_QUOTES);	//新パスワード確認

	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------

	//パスワード
	if(strlen($oldpw)!=0)
		$error = "旧パスワードが未入力です<br>";
	else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $oldpw))
		$error ="旧パスワードに誤りがあります<br>";
	else if(strlen($newpw)==0)
		$error = "新パスワードが未入力です<br>";
	else if (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $newpw))
		$error = " 新パスワードに誤りがあります<br>";
	else if($newpw != $newpw2)
		$error = "新パスワードが確認用パスワードと一致しません<br>";
	else{
		$sql = "SELECT no,pw FROM friendinfo WHERE no=$1";
		$array = array($my_no);
		$pgsql->query($sql,$array);
		$row = $pgsql->fetch();
		if($row["pw"]==hash("sha256",$oldpw)){
			$newpw =hash("sha256",$newpw);
			$sql = "UPDATE friendinfo SET pw=$1 WHERE no=$2";
			$array = array($newpw,$my_no);
			$pgsql->query($sql,$array);
			$error = "登録が完了しました<br>";
		}else{
			$error = "旧パスワードが一致しません<br>";
		}
	}
}else{
	if(isset($_SESSION["my_no"])){
		$my_no = $_SESSION["my_no"];
	}else{
		$access_error = "不正なアクセスです";
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8"><head>
	<title>管理人パスワード変更完了</title>
	<!-- style.cssの読み込み -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>パスワード変更</h1>
		<form action ="<?=$_SERVER["PHP_SELF"]?>" method="POST">
			<table border="0">
				<tr>
					<td>ID</td>
					<td><input type ="text" name="usr_id"></td>
				</tr>
				<tr>
					<td>古いパスワード</td>
					<td><input type="text" name="oldpw"></td>
				</tr>
				<tr>
					<td>新しいパスワード</td>
					<td><input type="text" name="newpw"></td>
				</tr>
				<tr>
					<td>新しいパスワード(確認用)</td>
					<td><input type="text" name="newpw2"></td>
				</tr>
			</table>
			<input type="submit" value="submit">
		</form>
</body>
</html>
