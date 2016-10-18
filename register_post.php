<? php
//======================================================================
//  ■： 会員情報登録送信ページ(regster_usr.phpより遷移) regster_post.php
//======================================================================
require_once("PostgreSQL.php");
//require_once("com_require2.php");
$pgsql = new PostgreSQL;

$error = "";
//エラーメッセージ
// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD']  == "POST") {
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
	//$usr_msg = htmlspecialchars($_POST["usr_msg"], ENT_QUOTES);	//メッセージ
	$gender = htmlspecialchars($_POST['gender']);
	$age = htmlspecialchars($_POST['age']);
	//$local = htmlspecialchars($_POST['local']);
	//$twi_id = htmlspecialchars($_POST['twi_id']);
	$a1 = htmlspecialchars($_POST['a1']);
	$a2 = htmlspecialchars($_POST['a2']);
	$a3 = htmlspecialchars($_POST['a3']);
	$a4 = htmlspecialchars($_POST['a4']);
	$a5 = htmlspecialchars($_POST['a5']);
	$a6 = htmlspecialchars($_POST['a6']);
	$a7 = htmlspecialchars($_POST['a7']);
	$a8 = htmlspecialchars($_POST['a8']);
	$a9 = htmlspecialchars($_POST['a9']);
	$a10 = htmlspecialchars($_POST['a10']);
	$a11 = htmlspecialchars($_POST['a11']);
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
	// □ 友達情報テーブル(friendinfo)に登録
	//--------------------------------------------
		if (!empty($usr_id) and !empty($usr_pw)) {
			// 名前とメッセージが入力されていればデータの追加を実行する
			// データを追加する
//			if (strlen($_SESSION["my_id"]) == 0){	//新規
			 $sql = 'INSERT INTO friendinfo ('$no','$usr_pw','$usr_msg',now(),'$usr_id','$age','$gender','$email')';
			// $sql = "INSERT INTO friendinfo ('$no','$usr_pw','$usr_msg',now(),'$usr_id','$age','$gender','$email','0','0','0','null','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11')";
		}
		$pgsql->query($sql);
//			$sql = null;
//			$sql = "INSERT INTO friends VALUES('$usr_no','$usr_id','', '$email')";
//			$pgsql->query($sql);
		$error = "<font size =\"6\">登録が完了しました。</font>";
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