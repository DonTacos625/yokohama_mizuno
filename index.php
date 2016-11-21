<?php
	//======================================================================
	//  ■：トップページ画面 index.php
	//======================================================================
session_start(); //セッションスタート
require_once __DIR__ . '/vendor/autoload.php';
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
	<script type="text/javascript">
	</script>
</head>
<body>
	<div id="page">
		<div id = "head">
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
						<br>研究用途で構築しました。<br>
						Webサイトの目的</br>
						<p>
						観光回遊行動を支援のための観光情報の共有と推薦になります。
						</p>
						</br></br>
						使い方</br>
						<p>
						皆様に横浜の観光スポットを推薦することがメインになります。<br>
						訪れたことのある観光スポットについては評価をして頂けると幸甚です。<br>
						</p>
						<p>設定がわからない方は下記フォームよりご連絡ください。
						作成者 水谷
						<a href="./contact.html">お問い合わせフォーム</a>
						</p>
					</div>
					<br>
					<!--<p>マーカーの凡例
						<table id="table5932" border="1">
							<tr>
								<td><img src="./marker/purple.png">飲食</td>
								<td><img src="./marker/yellow.png">ショッピング</td>
								<td><img src="./marker/red.png">テーマパーク・公園</td>
							</tr>
							<tr>
								<td><img src="./marker/orange.png">名所・史跡</td>
								<td><img src="./marker/ltblue.png">芸術・博物館</td>
								<td><img src="./marker/blue.png">その他</td>
							</tr>
						</table>
						<style type="text/css"><!-- #table5932{text-align:left;background:#ffffff;border:solid 2px #ff99d6;border-collapse:collapse}#table5932>tbody>tr>td{border:solid 0px #ff99d6;padding:4px;min-width:60px} </style>
						<br>
					</p>-->
				</div>
			</div>
		</div>
	</div>
</body>
</html>