<?php
//======================================================================
//  ■：トップページ画面 index.php
//======================================================================
//----------------------------------------	
// ■　共通　require_once
//----------------------------------------	
//require_once("com_require.php");
//=====================================================================
// ■　H T M L
//=====================================================================
session_start();
?>

<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!-- <link rel="stylesheet" type="text/css" href="stylet.css"></link> -->
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>横浜みなとみらい観光推薦システム</title>

	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
</script>
</head>
<body>
	<div id="page">
		<?php
			//----------------------------------------	
			// ■　ヘッダーの取り込み
			//----------------------------------------	
		require_once("header.php");
			//----------------------------------------	
			// ■　エラーメッセージがあったら表示
			//----------------------------------------	
		?>
		<div id="contents"> 
			<!--<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">-->
			<?php
		//----------------------------------------	
		// ■　左バーの取り込み
		//----------------------------------------	
		//require_once("left.php");
		//----------------------------------------	
		// ■　右表示エリア
		//----------------------------------------	
			?>
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap"> 
					<div class="title">	
						<h1>横浜みなとみら観光支援システム</h1>
						<p class="subh">
							目的
							サイトマップ

							Webサイトの目的</br>
							研究用途で構築し，目的は観光回遊行動を支援のための観光情報の共有と推薦になります。</br></br>
							使い方</br>
							様々な観光スポットの情報・評価を皆様には掲載していただき，観光スポットの推薦をすることがメインになります。
							また，「知らなかった」「行きたい」ボタンの機能により，どのような情報に注目されているを判断するために利用します。
							特に掲載する情報を持ってないというユーザは主にこの二つのボタンをクリックしていただければと思っています。</br></br>

							設定がわからない方は作成者（池田宰）までご連絡ください。</br>
							下の図はサンプル情報になります。
						</p>
					</div>
					<div id="map_canvas" style="width:635; height:600"></div>
					<br/>
					<p>マーカーの凡例
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
						<style type="text/css"><!-- #table5932{text-align:left;background:#ffffff;border:solid 2px #ff99d6;border-collapse:collapse}#table5932>tbody>tr>td{border:solid 0px #ff99d6;padding:4px;min-width:60px} --></style><br/></p>
					</div> 
				</div>
			</div>
		</div>
	</body>
	</html>