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
// □：MYSQLクラスインスタンスの作成
//----------------------------------------	
$pgsql = new PostgreSQL;
//----------------------------------------	
// ■ 外部ファイルの取り込み
//----------------------------------------	
//require_once("com_define.php");		//定数
//require_once("com_function.php");	//関数
//----------------------------------------	
// ■ HOSTの取得
//----------------------------------------	
//$host = get_host();
//----------------------------------------	
// ■ SESSION設定
//----------------------------------------	
session_start();		//セッション開始
$_SESSION["my_no"] = 0;		//自分の番号
//$_SESSION["my_id"] = "";	//自分のID
//$_SESSION["my_login"] = 0;	//ログイン

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
$login_url = './index.php';
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
		$pgsql->query("SELECT * FROM friendinfo WHERE id='$usr_id'");
		$row = $pgsql->fetch();
		if (isset($row['id'])){//IDが存在した場合
			if ($row["pw"] == hash("sha256",$usr_pw)){
				$_SESSION["my_no"] = $row["no"];
				echo "てすと";
				/*if(isset($row["sex"])){
					header("Location: ./top.php"); //トップページへ(ゆくゆくはindex.php)
					exit;
				}else{
					header("Location: ./fb_regster.php");
					exit;
				}*/
				//$_SESSION["my_id"] = $usr_id;
				//$_SESSION["my_login"] = 1;
				//------------------------------------
				// □ クッキーを保存する
				//------------------------------------
				//setcookie("usr_id",$usr_id);//ユーザIDを保存
				//------------------------------------
				// □ トップページへジャンプ
				//------------------------------------
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