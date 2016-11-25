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
	<!--google解析-->
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87819413-1', 'auto');
  ga('send', 'pageview');

</script>
<!--ここまで-->
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
					<form name="category" method="get" action="./localinfo2.php">
						<ul><h4>カテゴリーをお選びください。</h4></ul>
						<ul>
							<p>
								<input type="radio" name="c_check" value="1" checked> 飲食<br>
								<input type="radio" name="c_check" value="2"> ショッピング<br>
								<input type="radio" name="c_check" value="3"> テーマパーク・公園<br>
								<input type="radio" name="c_check" value="4"> 名所・史跡<br>
								<input type="radio" name="c_check" value="5"> 芸術・博物館<br>
								<input type="radio" name="c_check" value="6"> その他<br>
							</p>
						</ul>
						<ul>
						<p>
								<input type="submit" name="submit" value="送信">
						</p>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>