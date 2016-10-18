<?php
//======================================================================
//  ■： 会員情報登録ページ pwハッシュ化
//======================================================================
require_once("PostgreSQL.php");

//require_once("com_require2.php");
$pgsql = new PostgreSQL;

session_start(); //セッションスタート
//エラーメッセージ
$error = ""; //性別
$error1 = ""; //年齢

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	echo $_SESSION["my_no"];
	/*
	$my_no = $_SESSION["my_no"];

	// フォームからデータを受け取る
	//--------------------------------
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

	//性別,年齢の入力がなかったらエラー出力
	if(!isset($sex) or !isset($age)){
		$error = "年齢又は性別が未入力です."
	}else{
	//性別,年齢のクエリを送信
		$sql = "UPDATE friendinfo SET sex='$sex', age='$age' WHERE no='$my_no'";
		$pgsql->query($sql);
	//嗜好情報のクエリを送信
		$sql = "INSERT INTO tasteinfo(no,a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11) VALUES ('$my_no','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11'";
		$pgsql->query($sql);

		$error = "登録が完了しました.";
	}
	echo $error;
	*/
}
?>