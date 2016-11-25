<?php
session_start(); //セッションのスタートの宣言
//======================================================================
//  ■： facebookログインに必要なDB操作 api.php
//======================================================================

// Content-TypeをJSONに指定する
header('Content-Type: application/json');

require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;

$error = ""; //エラーメッセージ

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {

// $_POST['age']、$_POST['job']をエラーを出さないように文字列として安全に展開する
	foreach (['u_id'] as $v) {
		$$v = (string)filter_input(INPUT_POST, $v);
	}

	//--------------------------------
	// facebook ID を受け取る
	//--------------------------------
	$usr_id = hash("sha256", htmlspecialchars($u_id, ENT_QUOTES));	//ID
//--------------------------------
	// □ 入力内容チェック
	//--------------------------------
	$sql="SELECT no,age,gender,anq FROM friendinfo WHERE id=$1";
	$stl = array($usr_id);
	$pgsql->query($sql,$stl); //検索
	$row = $pgsql->fetch();

	if(isset($row['no'])){
		$error = "登録済みです";
		$_SESSION["my_no"] = $row['no'];
		$_SESSION["gender"] = $row['gender'];
		$_SESSION["age"] = $row['age'];
		$_SESSION["fb"] = 1;
		$_SESSION["anq"] = $row['anq'];
	}
	if (strlen($usr_id)==0){$error = "ユーザIDが未入力です";}
	if (strlen($error)==0){
		//ユーザナンバーの最大値を取得
		$pgsql->query_null("SELECT MAX(no) AS no FROM friendinfo");
		if ($pgsql->rows()>0) {
			$row = $pgsql->fetch();
			$no = $row['no'];
			$no++;
		}
	//--------------------------------------------
	// □ 会員情報テーブル(friendinfo)に登録
	//--------------------------------------------
		if (!empty($usr_id)) {
			// データを追加する
			$_SESSION["my_no"] = $no;
			$_SESSION["fb"] = 1;
			$sql = "INSERT INTO friendinfo(no,id,anq) VALUES($1,$2,$3)";
			$array = array($no,$usr_id,0);
			$pgsql->query($sql,$array);
		}
		//$_SESSION["my_no"] = $row['no'];
		$msg = "登録が完了しました.";
		echo json_encode(compact('msg'));
	}else{
		//エラーメッセージ表示用
		http_response_code(400);
		echo json_encode(compact('error'));
	}
}else{
	echo "不正なアクセスです.";
}

exit;
?><!DOCTYPE html>
<html>
<head>
			<!--google解析-->
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87819413-1', 'auto');
  ga('send', 'pageview');

</script>
<!--ここまで-->
</head>
<body>

</body>
</html>
