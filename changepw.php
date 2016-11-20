<?php
session_start();
//======================================================================
//  ■： 会員登録ページ パスワード変更
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
	$oldpw = htmlspecialchars($_POST["oldpw"], ENT_QUOTES); //旧パスワード
	$newpw = htmlspecialchars($_POST["newpw"], ENT_QUOTES);	//新パスワード
	$newpw2 = htmlspecialchars($_POST["newpw2"], ENT_QUOTES);	//新パスワード確認

	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------

	//パスワード
	if(strlen($oldpw)==0)
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
	if(isset($_SESSION["my_no"])&&!isset($_SESSION["fb"])){
		$my_no = $_SESSION["my_no"];
	}else{
		$access_error = "不正なアクセスです";
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>パスワード変更</title>
	<!-- style.cssの読み込み -->
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
	<?php
	//----------------------------------------	
	// ■ヘッダーの取り込み
	//----------------------------------------	
	require_once("header.php");
	?>
	<div id="page">
		<div id="head">
			<?php
			require_once("linkplace.php"); //現在地表示用php
			echo pwd("changepw"); //現在値の表示
	//----------------------------------------	
	// ■ エラーメッセージがあったら表示
	//----------------------------------------	
				if(strlen($access_error)>0){
					echo "<br>";
					echo $access_error;
					echo "</dvi></dvi></div></body></html>";
					exit;
				}
				if($error != "登録が完了しました."){
					echo "<br><font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
				}else{
					echo "<br>登録が完了しました";
					echo "</dvi></dvi></div></body></html>";
					exit;
				}
				?>
		</div>
	</div>
<div id="page">
	<div id="contents">
		<div class="contentswrap">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label" align="center">パスワード変更</div></tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">旧パスワード</div></td>
				<td>
					<input type="password" name="oldpw" value="<?=$oldpw ?>"><br>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">新パスワード</div></td>
				<td>
					<input type="password" name="newpw" value="<?=$newpw ?>"><br>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">新パスワード(確認用)</div></td>
				<td>
					<input type="password" name="newpw2" value="<?=$newpw2 ?>"><br>
				</td>
			</tr>
			<tr><td align="center" colspan="2">
			<input type="submit" name="Submit" value="変更する"></td></tr>
			</table>
		</form>
</div>
</div>
</div>
</body>
</html>