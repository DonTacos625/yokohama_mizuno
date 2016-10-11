<?php

// Content-TypeをJSONに指定する
header('Content-Type: application/json');

require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;

$error = "";
//エラーメッセージ
// POSTメソッドで送信された場合は書き込み処理を実行する

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
	//--------------------------------
	// facebook ID を受け取る
	//--------------------------------
	$usr_id = htmlspecialchars($u_id, ENT_QUOTES);	//ID
	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------
	$pgsql->query("SELECT * FROM friendinfo WHERE id='$usr_id'"); //検索
	$row = $pgsql->fetch();
	if ($row){$error = "登録済み";}
	if (strlen($usr_id)==0){$error = "ユーザIDが未入力です";}
	if (strlen($error)==0){
	//--------------------------------------------
	// □ 会員情報テーブル(friendinfo)に登録
	//--------------------------------------------
		if (!empty($usr_id)) {
			// 名前とメッセージが入力されていればデータの追加を実行する
			// データを追加する
			$sql = "INSERT INTO friendinfo(no,id) VALUES('$no','$usr_id')";
		}
		$pgsql->query($sql);
		$msg = "登録が完了しました";
		$_SESSION["my_id"] = $usr_id;
		http_response_code(400);
		echo json_encode(compact('msg'));
	}else{
		//エラーメッセージ表示用
		http_response_code(400);
		echo json_encode(compact('error'));
	}
}else{
	echo "不正なアクセスです.";
}
?>
