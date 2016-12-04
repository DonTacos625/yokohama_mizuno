<?php
// Twitterのコールバック用PHP
session_start();

require_once 'common.php';
require_once 'twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

//login.phpでセットしたセッション
$request_token = [];  // [] は array() の短縮記法。詳しくは以下の「追々記」参照
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

//Twitterから返されたOAuthトークンと、あらかじめlogin.phpで入れておいたセッション上のものと一致するかをチェック
if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
	die( 'Error!' );
}
//不正なアクセスではないかチェック
if(isset( $_REQUEST['oauth_token']) && !empty( $_GET['oauth_token'] ) && isset( $_GET['oauth_verifier'] ) && !empty( $_GET['oauth_verifier'] ) ){
//OAuth トークンも用いて TwitterOAuth をインスタンス化
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

//アプリでは、access_token(配列になっています)をうまく使って、Twitter上のアカウントを操作していきます
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

//ちなみに、この変数の中に、OAuthトークンとトークンシークレットが配列となって入っています。


//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	//ユーザー情報をGET
	$user = $connection->get("account/verify_credentials");
	//(ここらへんは、Twitter の API ドキュメントをうまく使ってください)

	//GETしたユーザー情報をvar_dump
	//var_dump( $user );
	//echo htmlspecialchars($user->id); //id出力

	$usr_id = hash("sha256",htmlspecialchars($user->id));
	$array = array($usr_id);
	$pgsql->query("SELECT id FROM friendinfo WHERE id=$1",$array); //検索
	$row = $pgsql->fetch();
	if($row){
		$_SESSION["my_no"] = $row["no"];
		$_SESSION["gender"] = $row["gender"];
		$_SESSION["age"] = $row["age"];
		$_SESSION["anq"] = $row["anq"];
	}else{
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
		$_SESSION["my_no"] = $no;
		$_SESSION["anq"] = 0;
	}
	//sessionを消す
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	if($_SESSION["gender"]==NULL||$_SESSION["age"]==NULL){
		header( 'Location: https://study-yokohama-sightseeing.herokuapp.com/register_info.php' ) ;
		exit ;
	}else{
		header( 'Location: https://study-yokohama-sightseeing.herokuapp.com/index.php' ) ;
		exit ;
	}


}else if( isset( $_GET['denied'] ) && !empty( $_GET['denied'] ) ){
	//sessionを消す
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
		// エラーメッセージを出力して終了
	echo 'You have rejected the app...Bye...' ;
		// ログインページに飛ばす
	header( 'Location: https://study-yokohama-sightseeing.herokuapp.com/login.php' ) ;

	exit ;
}else{
	echo "不正なアクセス";
}
?>