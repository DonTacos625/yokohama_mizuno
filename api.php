<?php

// Content-TypeをJSONに指定する
header('Content-Type: application/json');

require_once("PostgreSQL.php");
require_once("com_require2.php");
$pgsql = new PostgreSQL;

$error = "";
//エラーメッセージ
// POSTメソッドで送信された場合は書き込み処理を実行する

//if ($_SERVER['REQUEST_METHOD'] == "POST") {
// $_POST['age']、$_POST['job']をエラーを出さないように文字列として安全に展開する
foreach (['u_id'] as $v) {
    $$v = (string)filter_input(INPUT_POST, $v);
}
	$pgsql->query("SELECT MAX(no) AS no FROM friendinfo");
	if ($pgsql->rows()>0) {
		$row = $pgsql->fetch();
		$no = $row['no'];
		$no++;
	}
	// フォームからデータを受け取る
	//--------------------------------
	$usr_id = htmlspecialchars($u_id, ENT_QUOTES);	//ID
	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------
	$pgsql->query("SELECT * FROM friendinfo WHERE id='$usr_id'"); //検索
	$row = $pgsql->fetch();
	if ($row){$error = "このユーザIDは既に使われています";
		echo $error;
	//ここに登録済みの処理を書く
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
			 $sql = "INSERT INTO friendinfo(no,id) VALUES('$no','$usr_id')";
		}
		$pgsql->query($sql);
		$error = "登録が完了しました";
		$_SESSION["my_id"] = $usr_id;
	}
//}

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
