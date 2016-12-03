<?php
	//======================================================================
	//  ■：トップページ画面 index.php
	//======================================================================
session_start(); //セッションスタート
require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
$pgsql = new PostgreSQL;
if(isset($_SESSION["my_no"]))
	$my_no = $_SESSION["my_no"];
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
	<?php //require_once("analysis.php");?>
</head>
<body>
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
			<?php
				//----------------------------------------
				// ■左バーの取り込み
				//----------------------------------------
			require_once("left.php");
			?>
			<!-- ■右表示エリア-->
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap"> 
					<div class="title">	
						<h5>横浜みなとみらい観光支援システム</h5>
						<br>
						<h2>運用停止中</h2>
						<br>
						Webサイトの目的</br>
						<p>
						個人又はグループ観光回遊行動を支援するための観光情報の共有と推薦になります。
						</p>
						使い方</br>
						<p>
						皆さまに横浜の観光スポットを推薦することがメインとなります。<br>
						これまでに訪れたことのある観光スポットについては評価をお願いします。<br>
						</p>
						<p>設定方法がわからない場合は下記メールアドレスにご連絡ください。<br>
						作成者 水谷<br>
						y.mizutani[アットマーク]uec.ac.jp<br>
						※[アットマーク]を@へ置換してご利用ください。
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>