<?php
//======================================================================
//  ■： 会員登録ページ register_usr.php 
//======================================================================
session_start();
require_once("PostgreSQL.php");
//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = ""; //ID関係
$error1 = ""; //PW関係

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	// フォームからデータを受け取る
	//--------------------------------
	$usr_id = htmlspecialchars($_POST["usr_id"], ENT_QUOTES);	//ID
	$usr_pw = htmlspecialchars($_POST["usr_pw"], ENT_QUOTES);	//パスワード
	$usr_pw2 = htmlspecialchars($_POST["usr_pw2"], ENT_QUOTES);	//パスワード確認

	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------

	//パスワード
	if(strlen($usr_pw)==0)
		$error1 = "パスワードが未入力です<br>";
	else if(strlen($usr_pw)==0)
		$error1 = "確認用パスワードが未入力です<br>";
	else if (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $usr_pw))
		$error1 = "パスワードに誤りがあります<br>";
	else if($usr_pw != $usr_pw2)
		$error1 = "パスワードが一致しません<br>";
	else
		$error1 = "";

	//ユーザID
	if (strlen($usr_id)==0)
		$error = "ユーザIDが未入力です<br>";
	else if (!preg_match('/\A[a-z\d]{5,30}+\z/i', $usr_id))
		$error = "IDに誤りがあります<br>";
	else{
		$array = array($usr_id);
		$pgsql->query("SELECT id FROM friendinfo WHERE id=$1",$array); //検索
		$row = $pgsql->fetch();
		if ($row)
			$error = "このユーザIDは既に使われています<br>";
	}
	//登録
	if (strlen($error)==0 and strlen($error1)==0){
	//--------------------------------------------
	// □ 会員情報テーブル(friendinfo)に登録
	//--------------------------------------------
		if (!empty($usr_id) and !empty($usr_pw)) {
			$pgsql->query_null("SELECT MAX(no) AS no FROM friendinfo");
			if ($pgsql->rows()>0) {
				$row = $pgsql->fetch();
				$no = $row['no'];
				$no++;
			}
			//hash化
			$usr_pw = hash("sha256",$usr_pw);
			// データを追加する
			$sql = "INSERT INTO friendinfo(no,id,pw,anq) VALUES($1,$2,$3,$4)";
			$array = array($no,$usr_id,$usr_pw,0);
			$pgsql->query($sql,$array);
			//Sessionの登録
			$_SESSION["my_no"] = $row["no"];
			$_SESSION["anq"] = $row["anq"];
		}
		header("Location: ./register_info.php");
		exit;
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>新規登録</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
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
		echo pwd("register_usr");
		?>
		<div id="contents">
			<!-- #main 本文スペース -->
			<div class="contentswrap">
				<?php
	//----------------------------------------
	// ■ エラーメッセージがあったら表示
	//----------------------------------------
				if(strlen($error)>0||strlen($error1)>0){
					echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
					echo "<font size=\"6\" color=\"#da0b00\">{$error1}</font><p>";
				}
				?>
				<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
					<table align="center" border="0" cellspacing="2" cellpadding="2"  width="600px">
						<tr><div class="label" align="center">会員登録</div></tr>
						<tr>
							<td><div class="label" align="center">ユーザID</div></td>
							<td>
								<input type="text" name="usr_id" value="<?=$usr_id ?>" size="30">
								<br><font size="2">5〜30文字の半角英数字</font>
							</td>
						</tr>
						<tr>
							<td><div class="label" align="center">パスワード</div></td>
							<td>
								<input type="password" name="usr_pw" value="<?=$usr_pw ?>"><br>
								<font size="2">6文字以上かつ<font color="red"><b>半角英小文字,半角英大文字,数字</b></font>を混在させたもの</font>
							</td>
						</tr>
						<tr>
							<td><div class="label" align="center">確認用パスワード</div></td>
							<td>
								<input type="password" name="usr_pw2" value="<?=$usr_pw2 ?>"><br>
								<font size="2">もう一度パスワードの入力をお願いします</font>
							</td>
						</tr>
						<tr><td align="center" colspan="2"><input type="submit" name="Submit" value="登録する"></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
