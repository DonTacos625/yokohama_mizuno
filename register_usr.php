<?php
	//ログイン済み(Cookieが保存されている)なら
	if(isset($_COOKIE["usr_id"])){
		header("HTTP/1.1 301 Moved Permanetly");
		header("Location:./index.php"); //トップページへ
	}
//======================================================================
//  ■： 会員情報登録ページ
//======================================================================
require_once("PostgreSQL.php");
require_once("com_require2.php");
$pgsql = new PostgreSQL;
?>
<?php
$error = "";
//エラーメッセージ
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
	//$usr_pw2 = htmlspecialchars($_POST["usr_pw2"], ENT_QUOTES);	//パスワード確認
	$sex = intval(htmlspecialchars($_POST['sex']));
	$age = intval(htmlspecialchars($_POST['age']));
	$a1 = intval(htmlspecialchars($_POST['a1']));
	$a2 = intval(htmlspecialchars($_POST['a2']));
	$a3 = intval(htmlspecialchars($_POST['a3']));
	$a4 = intval(htmlspecialchars($_POST['a4']));
	$a5 = intval(htmlspecialchars($_POST['a5']));
	$a6 = intval(htmlspecialchars($_POST['a6']));
	$a7 = intval(htmlspecialchars($_POST['a7']));
	$a8 = intval(htmlspecialchars($_POST['a8']));
	$a9 = intval(htmlspecialchars($_POST['a9']));
	$a10 = intval(htmlspecialchars($_POST['a10']));
	$a11 = intval(htmlspecialchars($_POST['a11']));
	//$email = htmlspecialchars($_POST['email']);
	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------
	//パスワード
	if (!preg_match("/^[A-Za-z0-9]{1,10}$/", $usr_pw)){
		$error = "パスワードに誤りがあります<br>";
	}
	if (strlen($usr_pw)==0){$error = "パスワードが未入力です";
	}
	//ユーザID
	if (strlen($usr_id)>30){$error = "ユーザIDは30桁までです";
	}
//	$pgsql->query("SELECT * FROM friendinfo WHERE usrid='$usr_id');
	$row = $pgsql->fetch();
	if ($row){$error = "このユーザIDは既に使われています";
	}
	if (strlen($usr_id)==0){$error = "ユーザIDが未入力です";
	}
	if (strlen($error)==0){
	//--------------------------------------------
	// □ 会員情報テーブル(friendinfo)に登録
	//--------------------------------------------
		if (!empty($usr_id) and !empty($usr_pw)) {
			// 名前とメッセージが入力されていればデータの追加を実行する
			// データを追加する
			 $sql = "INSERT INTO friendinfo VALUES('$no','$usr_id','$usr_pw','$sex','$age','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11')";
		}
		$pgsql->query($sql);
		$error = "登録が完了しました";
		$_SESSION["my_id"] = $usr_id;
	}
}

// SQLコマンド用の文字列に変換する関数
function cnv_dbstr($string) {
// タグを無効にする
	$string = htmlspecialchars($string);
	// magic_quotes_gpcがONの場合はエスケープを解除する
	if (get_magic_quotes_gpc()) {
	$string = stripslashes($string);
	}
	// SQLコマンド用の文字列にエスケープする
	$string = mysql_real_escape_string($string);
	return $string;
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
		echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
		if ($error == "登録が完了しました") {
			echo "ok1";
			echo "<br><center><a href=\"./index.php\">HOMEへ</a></center>";
			echo "</body>";
			echo "</html>";
			exit;
		}
	}
?>
<div id="page">
	<div id="head">
		<a href="./login_fb.php">Loginページへ戻る</a>
	</div>
</div>
<div id="page">
	<div id="contents">
		<!-- #main 本文スペース -->
		<div class="contentswrap">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label" align="center">個人ステータスの登録</div></tr>
			<? php
				//fbからのユーザ認証がされているなら、IDとPWの入力が要らないように分岐する
			?>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">ユーザID<br>[ニックネームor実名]</div></td>
			<td><input type="text" name="usr_id" value="<?=$usr_id ?>" size="30"><br>
			<font size="2">30桁以内の任意の文字で入力してください</font></td></tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">パスワード</div></td>
				<td>
					<input type="password" name="usr_pw" value="<?=$usr_pw ?>"><br>
					<font size="2">10桁以内の英数字で入力してください</font>
				</td>
			</tr>
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
			</table>
			<br>
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label2" align="center">嗜好情報の入力</div></tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報1</div>
				</td>
					<td>
						<input type="radio" name="a1" value="1"<?php if ($a1==1){ print " checked"; }?> >1
						<input type="radio" name="a1" value="2"<?php if ($a1==2){ print " checked"; }?> >2
						<input type="radio" name="a1" value="3"<?php if ($a1==3){ print " checked"; }?> >3
						<input type="radio" name="a1" value="4"<?php if ($a1==4){ print " checked"; }?> >4
						<input type="radio" name="a1" value="5"<?php if ($a1==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報2</div>
				</td>
					<td>
						<input type="radio" name="a2" value="1"<?php if ($a2==1){ print " checked"; }?> >1
						<input type="radio" name="a2" value="2"<?php if ($a2==2){ print " checked"; }?> >2
						<input type="radio" name="a2" value="3"<?php if ($a2==3){ print " checked"; }?> >3
						<input type="radio" name="a2" value="4"<?php if ($a2==4){ print " checked"; }?> >4
						<input type="radio" name="a2" value="5"<?php if ($a2==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報3</div>
				</td>
					<td>
						<input type="radio" name="a3" value="1"<?php if ($a3==1){ print " checked"; }?> >1
						<input type="radio" name="a3" value="2"<?php if ($a3==2){ print " checked"; }?> >2
						<input type="radio" name="a3" value="3"<?php if ($a3==3){ print " checked"; }?> >3
						<input type="radio" name="a3" value="4"<?php if ($a3==4){ print " checked"; }?> >4
						<input type="radio" name="a3" value="5"<?php if ($a3==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報4</div>
				</td>
					<td>
						<input type="radio" name="a4" value="1"<?php if ($a4==1){ print " checked"; }?> >1
						<input type="radio" name="a4" value="2"<?php if ($a4==2){ print " checked"; }?> >2
						<input type="radio" name="a4" value="3"<?php if ($a4==3){ print " checked"; }?> >3
						<input type="radio" name="a4" value="4"<?php if ($a4==4){ print " checked"; }?> >4
						<input type="radio" name="a4" value="5"<?php if ($a4==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報5</div>
				</td>
					<td>
						<input type="radio" name="a5" value="1"<?php if ($a5==1){ print " checked"; }?> >1
						<input type="radio" name="a5" value="2"<?php if ($a5==2){ print " checked"; }?> >2
						<input type="radio" name="a5" value="3"<?php if ($a5==3){ print " checked"; }?> >3
						<input type="radio" name="a5" value="4"<?php if ($a5==4){ print " checked"; }?> >4
						<input type="radio" name="a5" value="5"<?php if ($a5==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報6</div>
				</td>
					<td>
						<input type="radio" name="a6" value="1"<?php if ($a6==1){ print " checked"; }?> >1
						<input type="radio" name="a6" value="2"<?php if ($a6==2){ print " checked"; }?> >2
						<input type="radio" name="a6" value="3"<?php if ($a6==3){ print " checked"; }?> >3
						<input type="radio" name="a6" value="4"<?php if ($a6==4){ print " checked"; }?> >4
						<input type="radio" name="a6" value="5"<?php if ($a6==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報7</div>
				</td>
					<td>
						<input type="radio" name="a7" value="1"<?php if ($a7==1){ print " checked"; }?> >1
						<input type="radio" name="a7" value="2"<?php if ($a7==2){ print " checked"; }?> >2
						<input type="radio" name="a7" value="3"<?php if ($a7==3){ print " checked"; }?> >3
						<input type="radio" name="a7" value="4"<?php if ($a7==4){ print " checked"; }?> >4
						<input type="radio" name="a7" value="5"<?php if ($a7==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報8</div>
				</td>
					<td>
						<input type="radio" name="a8" value="1"<?php if ($a8==1){ print " checked"; }?> >1
						<input type="radio" name="a8" value="2"<?php if ($a8==2){ print " checked"; }?> >2
						<input type="radio" name="a8" value="3"<?php if ($a8==3){ print " checked"; }?> >3
						<input type="radio" name="a8" value="4"<?php if ($a8==4){ print " checked"; }?> >4
						<input type="radio" name="a8" value="5"<?php if ($a8==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報9</div>
				</td>
					<td>
						<input type="radio" name="a9" value="1"<?php if ($a9==1){ print " checked"; }?> >1
						<input type="radio" name="a9" value="2"<?php if ($a9==2){ print " checked"; }?> >2
						<input type="radio" name="a9" value="3"<?php if ($a9==3){ print " checked"; }?> >3
						<input type="radio" name="a9" value="4"<?php if ($a9==4){ print " checked"; }?> >4
						<input type="radio" name="a9" value="5"<?php if ($a9==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報10</div>
				</td>
					<td>
						<input type="radio" name="a10" value="1"<?php if ($a10==1){ print " checked"; }?> >1
						<input type="radio" name="a10" value="2"<?php if ($a10==2){ print " checked"; }?> >2
						<input type="radio" name="a10" value="3"<?php if ($a10==3){ print " checked"; }?> >3
						<input type="radio" name="a10" value="4"<?php if ($a10==4){ print " checked"; }?> >4
						<input type="radio" name="a10" value="5"<?php if ($a10==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報11</div>
				</td>
					<td>
						<input type="radio" name="a11" value="1"<?php if ($a11==1){ print " checked"; }?> >1
						<input type="radio" name="a11" value="2"<?php if ($a11==2){ print " checked"; }?> >2
						<input type="radio" name="a11" value="3"<?php if ($a11==3){ print " checked"; }?> >3
						<input type="radio" name="a11" value="4"<?php if ($a11==4){ print " checked"; }?> >4
						<input type="radio" name="a11" value="5"<?php if ($a11==5){ print " checked"; }?> >5
					</td>
			</tr>
			<!--
			<tr>
				<td align="center" bgcolor="#ffe4e1"><div class="label">メールアドレス</div></td>
				<td><input type="text" name="email" value="<?=$email ?>" size="30"><br>
			<font size="2">PCのメールアドレスを登録してください</font></td></tr>
			-->
			<!--			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">twitterアカウント</div></td>
			<td><input type="text" name="twi_id" value="<?=$twi_id ?>" size="30"><br>
			<font size="2">＠は不要です</font></td></tr>-->
			<!--
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">メッセージ</div></td>
			<td><textarea name="usr_msg" cols="40" rows="10"><?=$usr_msg?></textarea></td></tr>
			-->
			<tr><td align="center" colspan="2">
			<!--
			<input type="submit" name="submit_reset" value="リセット">
			-->
			<input type="submit" name="submit_toroku" value="登録する"></td></tr>
			</table>
		</form>
		</div>
	</div>
</div>

</body>
</html>
