<?php
//======================================================================
//  ■： 会員情報登録ページ pwハッシュ化
//======================================================================
require_once("PostgreSQL.php");
session_start(); //セッションスタート
//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = "";

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$pgsql->query("SELECT MAX(no) AS no FROM friendinfo");
	if ($pgsql->rows()>0) {
		$row = $pgsql->fetch();
		$no = $row['no'];
		$no++;
	}
	// フォームからデータを受け取る
	//--------------------------------
	$sex = intval(htmlspecialchars($_POST['sex']));
	$age = intval(htmlspecialchars($_POST['age']));

	$sql = "UPDATE friendinfo SET sex='$sex', age='$age' WHERE no='$_SESSION["my_no"]'";
	$pgsql->query($sql);
	$error = "登録が完了しました";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ユーザ登録</title>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
<?php
	//----------------------------------------	
	// ■ エラーメッセージがあったら表示
	//----------------------------------------	
	if (strlen($error)>0){
		if($error != "登録が完了しました"){
			echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
		}
		if($error1 != "登録が完了しました"){
			echo "<font size=\"6\" color=\"#da0b00\">{$error1}</font><p>";
		}
		if ($error == "登録が完了しました" and $error1 == "登録が完了しました") {
			echo "<font size=\"6\" color=\"#da0b00\">"
			echo "続けて、嗜好情報の入力をお願いします。</font><p>";
			echo "<br><center><a href=\"./top.php\">HOMEへ</a></center>";
			echo "</body>";
			echo "</html>";
			exit;
		}
	}
?>
<div id="page">
	<div id="head">
		<a href="./login.php">Loginページへ戻る</a>
	</div>
</div>
<div id="page">
	<div id="contents">
		<!-- #main 本文スペース -->
		<div class="contentswrap">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label" align="center">個人ステータスの登録</div></tr>

			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">表示名<br>[ニックネームor実名]</div></td>
			<td><input type="text" name="usr_name" value="<?=$usr_name ?>" size="30"><br>
			<font size="2">30桁以内の任意の文字で入力してください</font></td></tr>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">性別</div></td>
				<td>
					<input type="radio" name="sex" value="0"<?php if ($sex==0){ print " checked"; }?> >男
					<input type="radio" name="sex" value="1"<?php if ($sex==1){ print " checked"; }?> >女
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">年代</div>
				</td>
						<td>
							<input type="radio" name="age" value="10"<?php if ($age==10){ print " checked"; }?> >10
							<input type="radio" name="age" value="20"<?php if ($age==20){ print " checked"; }?> >20
							<input type="radio" name="age" value="30"<?php if ($age==30){ print " checked"; }?> >30
							<input type="radio" name="age" value="40"<?php if ($age==40){ print " checked"; }?> >40
							<input type="radio" name="age" value="50"<?php if ($age==50){ print " checked"; }?> >50
							<input type="radio" name="age" value="60"<?php if ($age==60){ print " checked"; }?> >60以上
						</td>
			</tr>
			<tr><td align="center" colspan="1">
			<input type="submit" name="submit_toroku" value="登録する"></td></tr>
			</table>
		</form>
		</div>
	</div>
</div>
</body>
</html>
