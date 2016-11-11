<?php
//======================================================================
//  ■： 会員情報登録ページ user情報登録は、fbと一緒に
//======================================================================
require_once("PostgreSQL.php");
//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = ""; //ID関係
$error1 = ""; //PW関係

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
	$usr_id = htmlspecialchars($_POST["usr_id"], ENT_QUOTES);	//ID
	$usr_pw = htmlspecialchars($_POST["usr_pw"], ENT_QUOTES);	//パスワード
	$usr_pw2 = htmlspecialchars($_POST["usr_pw2"], ENT_QUOTES);	//パスワード確認

	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------

	//パスワード
	if (!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/', $usr_pw)){
		$error1 = "パスワードに誤りがあります<br>";
	}
	if($usr_pw != $usr_pw2){
		$error1 = "パスワードが一致しません<br>";
	}
	if (strlen($usr_pw)==0){$error1 = "パスワードが未入力です<br>";
	}

	//ユーザID
	if (!preg_match('/\A[a-z\d]{8,30}+\z/i', $usr_id)){
		$error = "IDに誤りがあります<br>";
	}
	$pgsql->query("SELECT * FROM friendinfo WHERE id='$usr_id'"); //検索
	$row = $pgsql->fetch();
	if ($row){$error = "このユーザIDは既に使われています<br>";
	}
	if (strlen($usr_id)==0){$error = "ユーザIDが未入力です<br>";
	}

	//登録
	if (strlen($error)==0 and strlen($error1)==0){
	//--------------------------------------------
	// □ 会員情報テーブル(friendinfo)に登録
	//--------------------------------------------
		if (!empty($usr_id) and !empty($usr_pw)) {
			//hash化
			$usr_pw = hash("sha256",$usr_pw);
			// データを追加する
			$sql = "INSERT INTO friendinfo(no,id,pw) VALUES('$no','$usr_id','$usr_pw')";
			$pgsql->query($sql);
		}
		$error = "登録が完了しました";
		$error1 = "登録が完了しました";
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新規登録</title>
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
			echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
			echo "<br><center><a href=\"./index.php\">Login画面へ</a></center>";
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
			<tr><div class="label" align="center">会員登録</div></tr>

			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">ユーザID<br></div></td>
			<td><input type="text" name="usr_id" value="<?=$usr_id ?>" size="30"><br>
			<font size="2">8〜30文字の半角英数字を入力して下さい</font></td></tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">パスワード</div></td>
				<td>
					<input type="password" name="usr_pw" value="<?=$usr_pw ?>"><br>
					<font size="2">8文字以上で半角英[小文字/大文字],数字を混在させたものを入力して下さい</font>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">確認用パスワード</div></td>
				<td>
					<input type="password" name="usr_pw2" value="<?=$usr_pw2 ?>"><br>
				</td>
			</tr>
			<tr><td align="center" colspan="2">
			<input type="submit" name="submit_toroku" value="登録する"></td></tr>
			</table>
		</form>
		</div>
	</div>
</div>

</body>
</html>
