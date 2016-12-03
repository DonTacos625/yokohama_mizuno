<?php
//======================================================================
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
		$array = array($no);

		//会員情報テーブル(friendinfo)から削除
		$sql = "DELETE FROM friendinfo WHERE no=$1";
		$pgsql->query($sql,$array); //クエリの送信
		//会員関係テーブル(relationinfo)から削除
		$sql = "DELETE FROM relationinfo WHERE no=$1";
		$pgsql->query($sql,$array); //クエリの送信
		//見解間距離均等法による会員関係の値(valueinfo)から削除
		$sql = "DELETE FROM valueinfo WHERE no=$1";
		$pgsql->query($sql,$array); //クエリの送信

		/*もしかしたらアンケートのcsvの行削除もするかもしれない*/

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
<td align="center"><font size="2">ID</font></td>
<td align="center"><font size="2">性別</font></td>
<td align="center"><font size="2">年代</font></td>
</tr>
<?php
//----------------------------------------
// □：テーブルからデータを読む (friendinfoテーブル)
//----------------------------------------
$pgsql->query_null("SELECT no,id,gender,age FROM test ORDER BY no ASC");
$row = $pgsql->fetch_all(); //該当行全て取り出し
$count = count($row);
for($i=0;$i<$count;$i++){
	$no = $row[$i]["no"];
	$id = $row[$i]["id"];
	if(strlen($id)>30){
		$id = "Facebook";
	}
	$gender = $row[$i]["gender"];
	$age = $row[$i]["age"];
	if($gender==1){
		$gender = "男";
	}elseif($gender==2){
		$gender = "女";
	}elseif($gender==NULL){
		$gender = "未入力";
	}else{
		$gender = $row[$i]["gender"];
	}
	echo "<tr>";
	echo "<td align=\"\center\">$no</td>";
	echo "<td>$id</td>";
	echo "<td>$gender</td>";
	echo "<td>$age</td>";
	echo "<td><input type=\"submit\" name=\"submit_del[$no]\" value=\"削除\"></td>";
	echo "</tr>";
}
?>
</table>
</form>
</body>
</html>