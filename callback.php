<?php

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

//OAuth トークンも用いて TwitterOAuth をインスタンス化
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

//アプリでは、access_token(配列になっています)をうまく使って、Twitter上のアカウントを操作していきます
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
/*
ちなみに、この変数の中に、OAuthトークンとトークンシークレットが配列となって入っています。
*/

//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

//ユーザー情報をGET
$user = $connection->get("account/verify_credentials");
//(ここらへんは、Twitter の API ドキュメントをうまく使ってください)

//GETしたユーザー情報をvar_dump
var_dump( $user );
echo $user["id"];

unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

?>