<?php
	//======================================================================
	//  ■：トップページ画面 index.php
	//======================================================================
session_start(); //セッションスタート
require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
$pgsql = new PostgreSQL;
if(isset($_SESSION["my_no"])){
	$my_no = $_SESSION["my_no"];
	$gender = $_SESSION["gender"];
	$age = $_SESSION["age"];
	$anq=$_SESSION["anq"];
}
//echo "工事中です";
//exit;
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>横浜みなとみらい観光推薦システム</title>
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script>
		if (window.location.hash == "#_=_") window.location.hash = "";
	</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<div id = "header">
			<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
			require_once("header.php");
			?>
		</div>
	</div>
	<div id="page">
		<div id="contents">
			<div id="menuL">
			<?php
				//----------------------------------------
				// ■左バーの取り込み
				//----------------------------------------
			require_once("left.php");
			?>
			</div>
			<!-- ■右表示エリア-->
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap">
					<div class="title">
					<div id="sitename">横浜みなとみらい観光推薦システム</div>
						<h5>本運用中</h5>
						Webサイトの目的</br>
						<p>
						家族や友達、恋人、ご夫婦など、とくに<font color="red"><b>グループ</b></font>での観光回遊行動を<br>支援するための観光情報の共有と推薦になります。
						</p>
						使い方</br>
						<p>
						皆さまに横浜の観光スポットを推薦することがメインとなります。<br>
						実際に訪れたことのある観光スポットについてはレビューをお願いします。<br>
						詳しい使い方は<a href="./howtouse.php" title="使い方">こちら</a>。
						</p>
						<p>不具合等ございましたら、下記メールアドレスにご連絡ください。<br>
						作成者 水谷<br>
						y.mizutani[アットマーク]uec.ac.jp<br>
						※[アットマーク]を@へ置換してください。
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>