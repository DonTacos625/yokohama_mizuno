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
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
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
			<?php
				//----------------------------------------
				// ■左バーの取り込み
				//----------------------------------------
			require_once("left.php");
			?>
			<div id ="main">
				<div class ="contentswrap">
					<form name="category" method="post" action="./localinfo2.php">
						<ul><h4>カテゴリーをお選びください。</h4></ul>
						<ul>
							<p>
								<input type="radio" name="cate" value="1" checked> 飲食<br>
								<input type="radio" name="cate" value="2"> ショッピング<br>
								<input type="radio" name="cate" value="3"> テーマパーク・公園<br>
								<input type="radio" name="cate" value="4"> 名所・史跡<br>
								<input type="radio" name="cate" value="5"> 芸術・博物館<br>
								<input type="radio" name="cate" value="6"> その他<br>
							</p>
						</ul>
						<ul>
						<p>
								<input type="submit" name="Submit" value=" 送信 ">
						</p>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>