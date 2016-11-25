<?php
header("Content-type: text/html; charset=utf-8"); //文字形式をUTF-8に
//======================================================================
//  ■： ログイン送信管理(ID,PWを用いたログイン) login_submit.php
//======================================================================
//----------------------------------------	
// ■ PostgreSQLクラスファイルの取り込み
//----------------------------------------	
require_once("PostgreSQL.php");
//----------------------------------------	
// □：PostgreSQLクラスインスタンスの作成
//----------------------------------------	
$pgsql = new PostgreSQL;
//----------------------------------------	
// ■ SESSION設定
//----------------------------------------	
session_start();		//セッション開始

//----------------------------------------	
// ■ 変数初期化
//----------------------------------------	
$error = "";
$usr_no = 0;
$usr_id = "";
$usr_pw = "";
//タグ出力用
$regist_url = './fb_regster.php';
$regist_html = '<a href="'.$regist_url.'">会員情報登録ページ</a>';
$login_url = './login.php';
$login_html = '<a href="'.$login_url.'">ログインページ</a>';
$signup_url = './register_usr.php';
$signup_html = '<a href="'.$signup_url.'">利用登録ページ</a>';
$br = '<br>';
//----------------------------------------
// ■ POSTされたとき
//----------------------------------------
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ POSTされたデータを取得
	//--------------------------------
	$usr_id = htmlspecialchars($_POST["usr_id"], ENT_QUOTES);	//ID
	$usr_pw = htmlspecialchars($_POST["usr_pw"], ENT_QUOTES);	//パスワード
	//--------------------------------
	// □ 入力内容チェック
	//--------------------------------
	//ユーザID
	if (strlen($usr_id)==0){
		$error = "ユーザIDが入力されていません";
		echo $error.$br;
	}
	//パスワード
	if (strlen($usr_pw)==0){
		$error = "パスワードが入力されていません";
		echo $error.$br;
	}
	//エラーなし
	if (strlen($error)==NULL){
		//--------------------------------------------
		// □ 会員情報テーブル(friendinfo)をチェック
		//--------------------------------------------
		$array = array($usr_id);
		$pgsql->query("SELECT no,id,pw,gender,age,anq FROM friendinfo WHERE id=$1",$array);
		$row = $pgsql->fetch();
		if (isset($row['id'])){//IDが存在した場合
			if ($row["pw"] == hash("sha256",$usr_pw)){
				$_SESSION["my_no"] = $row["no"];
				$_SESSION["gender"] = $row["gender"];
				$_SESSION["age"] = $row["age"];
				$_SESSION["anq"] = $row["anq"];
				if(isset($row["gender"])){
					header("Location: ./index.php");
					exit;
				}else{
					header("Location: ./fb_register.php");
					exit;
				}
			}else{
				echo "Passwordsが間違っています。".$br;
				echo $login_html."よりログインし直して下さい。";
			}
		}else{	//IDが存在しない場合
			echo "IDが間違っています。".$br;
			echo $login_html."よりログインし直して下さい。".$br;
			echo "登録がまだの方は".$signup_html."より登録してください。";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ログイン送信</title>
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