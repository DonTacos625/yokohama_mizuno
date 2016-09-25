<?php
//======================================================================
//  完了
//  ■： 研究用SNSシステム ユーザ管理 userkanri.php
//======================================================================

//------------------------------------
// ■  BASIC認証 for heroku
//------------------------------------
if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
        ||!( $_SERVER['PHP_AUTH_USER'] === getenv('BASIC_AUTH_USERNAME')
        && $_SERVER['PHP_AUTH_PW'] === getenv('BASIC_AUTH_PASSWORD'))) {
	header('WWW-Authenticate: Basic realm="認証失敗"');
  header('HTTP/1.0 401 Unauthorized');
  echo("認証に失敗しました。");
  exit();
}

//----------------------------------------
// ■  PostgreSQLクラスファイルの取り込み
//----------------------------------------
require_once("PostgreSQL.php"); //ユーザ情報を読むPostgreSQL.phpにする
//----------------------------------------
// □：PostgreSQLクラスインスタンスの作成
//----------------------------------------
$pgsql = new PostgreSQL;
//----------------------------------------
// ■  変数初期化
//----------------------------------------
$sql = "";
$error = "";

//----------------------------------------
// ■  POSTされたとき
//----------------------------------------
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ ユーザの削除
	//--------------------------------
	if (isset($_POST["submit_del"])){
		$no = key($_POST["submit_del"]);		//押下したボタン番号を取得
		/*友達テーブル(friends)から削除
		$sql = "DELETE FROM friends WHERE no=$no";
		$pgsql->query($sql);
		*/
		//友達情報テーブル(friendinfo)から削除
		$sql = "DELETE FROM friendinfo WHERE no=$no";
		$pgsql->query($sql);
		/*もしかしたらアンケートのcsvの行削除もするかもしれない*/
		//クエリの送信
		$pgsql->query($sql);
		//完了の出力
		$error = "{$no}番のデータを削除しました";
	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>みなとみらい観光スポット  会員管理画面</title>
</head>
<body>
<?php
//--------------------------------------------------------------------
// ■  エラーメッセージがあったら表示 削除完了も表示
//--------------------------------------------------------------------
if (strlen($error)>0){
	echo "<font size=\"2\" color=\"#da0b00\">{$error}</font><p>";
}
?>
<h3>会員管理</h3>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
<table border="1" cellspacing="0" cellpadding="3" width="100%" bordercolor="#666666">
<tr bgcolor="#eee8aa">
<td align="center"><font size="2">番号</font></td>
<td align="center"><font size="2">名前</font></td>
<td align="center"><font size="2">性別</font></td>
<td align="center"><font size="2">年代</font></td>
</tr>
<?php
//----------------------------------------
// □：テーブルからデータを読む (friendinfoテーブル)
//----------------------------------------
$pgsql->query("SELECT * FROM friendinfo ORDER BY no ASC");
while($row = $pgsql->fetch()){
	$no = $row["no"];
	$id = $row["id"];
	$sex = $row["sex"];
	$age = $row["age"];
	if($sex==0){
		$sex = "男";
	}else{
		$sex = "女";
	}
	echo <<<EOT
<tr>
<td align="center">$no</td>
<td>$name</td>
<td>$sex</td>
<td>$age</td>
<td><input type="submit" name="submit_del[$no]" value="削除"></td>
</tr>
EOT;
}
//ここまでwhileループ[終了の閉じカッコ]
?>
</table>
</form>
</body>
</html>