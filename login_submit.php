<? php
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
$postgresql = new PostgreSQL;
//----------------------------------------	
// ■ 外部ファイルの取り込み
//----------------------------------------	
//require_once("com_define.php");		//定数
require_once("com_function.php");	//関数
//----------------------------------------	
// ■ HOSTの取得
//----------------------------------------	
//$host = get_host();
//----------------------------------------	
// ■ SESSION設定
//----------------------------------------	
/*session_start();		//セッション開始
$_SESSION["my_no"] = 0;		//自分の番号
$_SESSION["my_id"] = "";	//自分のID
$_SESSION["my_login"] = 0;	//ログイン
*/
//----------------------------------------	
// ■ 変数初期化
//----------------------------------------	
$error = "";
$usr_no = 0;
$usr_id = "";
$usr_pw = "";
//----------------------------------------	
// ■ POSTされたとき
//----------------------------------------	
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------------------
	// □ ログインボタンが押されたとき
	//--------------------------------------------
	if (isset($_POST["submit"])){
		//--------------------------------
		// □ POSTされたデータを取得
		//--------------------------------
		$usr_id = htmlspecialchars($_POST["usr_id"], ENT_QUOTES);	//ID
		$usr_pw = htmlspecialchars($_POST["usr_pw"], ENT_QUOTES);	//パスワード
		//--------------------------------
		// □ 入力内容チェック
		//--------------------------------
		//ユーザID
		if (strlen($usr_id)==0){$error = "ユーザIDが入力されていません";}
		//パスワード
		if (strlen($usr_pw)==0){$error = "パスワードが入力されていません";}
		//エラーなし
		if (strlen($error)==NULL){
			//--------------------------------------------
			// □ 会員情報テーブル(friendinfo)をチェック
			//--------------------------------------------
			$pgsql->query("SELECT * FROM friendinfo WHERE id='$usr_id'");
			if ($pgsql->rows()>0){//会員情報が存在した場合
				$row = $pgsql->fetch();
				if ($row["pw"] == $usr_pw){
					//$_SESSION["my_no"] = $row["no"];
					//$_SESSION["my_id"] = $usr_id;
					//$_SESSION["my_login"] = 1;
					//------------------------------------
					// □ クッキーを保存する
					//------------------------------------
					//setcookie("usr_id",$usr_id);//ユーザIDを保存
					//------------------------------------
					// □ トップページへジャンプ
					//------------------------------------
					header("Location: ./top.php"); //トップページへ(ゆくゆくはindex.php)
					exit;
				}
			}else{	//会員情報が存在しない場合
				$login_url = './login_fb.php';
				$login_html = '<a href="'.$login_url.'">ログインページ</a>';
				$signup_url = './sregister2.php';
				$signup_html = '<a href="'.$signup_url.'">会員登録ページ</a>';

				echo "ID 又は Passwords が間違っています。";
				echo $login_html."よりログインし直して下さい。";
				echo "登録がまだの方は".$signup_html."より登録してください。";
				/*
				//------------------------------------
				// □ 友達テーブル(friends)をチェック
				//------------------------------------
				$sql = "SELECT friends.no,friendinfo.usrid FROM friends";
				$sql.= " LEFT JOIN friendinfo ON friends.no=friendinfo.no";
				$sql.= " WHERE friends.email='$usr_id'";
				$pgsql->query($sql);
				print $sql;
				if ($pgsql->rows()>0){
					$row = $pgsql->fetch();
					//----------------------------------------------
					// 一番最初にログインするときのチェック
					//----------------------------------------------
					if (!$row["usrid"] && $usr_pw == FIRST_PASS){
						print "1番最初にログインですね？";
						$_SESSION["my_no"] = $row["no"];
						$_SESSION["my_login"] = 1;
						//------------------------------------
						// □ マイ情報設定ページへジャンプ
						//------------------------------------
						header("Location: http://$host/friendinfo.php");
						exit;
					}
				}else{
					print "ミス！";
				}
				*/
			}
			//$error = "ユーザIDかパスワードに誤りがあります";
		}
	}
}
//--------------------------------------------------------------------
// ■ ブラウザからHTMLページを要求されたとき(クッキーを取得する)
//--------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"]!="POST"){
	if (isset($_COOKIE["sns"])) {
		$sns = $_COOKIE["sns"];	//クッキーを変数に保存
		$usr_id = $sns["usrid"];	//ユーザIDを取得
		$usr_pw= $sns["usrpw"];	//ユーザパスワードを取得
	}else{
		echo "不正なアクセスです。";
	}
}
?>