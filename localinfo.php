<?php
//観光スポット推薦システム 推薦項目ページ
session_start();
require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;
$my_no = $_SESSION["my_no"];
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>観光スポット情報閲覧</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("header.php");
		if(!isset($_SESSION["my_no"])){
			echo "ログインページよりログインしてください";
			echo "</div></body></html>";
			exit;
		}
		require_once("./linkplace.php");
		echo pwd("localinfo");
		?>
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
			<div id ="main">
				<div class ="contentswrap">
					<h6>カテゴリーから探す</h6>
					<ul>
						<li><a href="./localinfo2.php?c_check=1">飲食</a></li>
						<li><a href="./localinfo2.php?c_check=2">ショッピング</a></li>
						<li><a href="./localinfo2.php?c_check=3">テーマパーク・公園</a></li>
						<li><a href="./localinfo2.php?c_check=4">名所・史跡</a></li>
						<li><a href="./localinfo2.php?c_check=5">芸術・博物館</a></li>
						<li><a href="./localinfo2.php?c_check=6">その他</a></li>
					</ul>
					<h6>地図から探す</h6>
					<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="yokohama_map" src="//uec-yamamoto.maps.arcgis.com/apps/Embed/index.html?webmap=c09c8c1dd8bc4a708e69d7a74ea1605e&amp;extent=139.6153,35.4369,139.6627,35.4645&amp;zoom=true&amp;scale=false&amp;legendlayers=true&amp;disable_scroll=true&amp;theme=light"></iframe>
				</div>
			</div>
		</div>
	</div>
</body>
</html>