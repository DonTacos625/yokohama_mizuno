<?php
	//======================================================================
	//  ■：テンプレート
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
	<title>#ここにタイトル</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
	</script>
</head>
<body>
	<div id="page">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		if(!isset($_SESSION["my_no"])){
			echo "ログインページよりログインしてください";
			echo "</div></body></html>";
			exit;
		}
		require_once("./linkplace.php");
		echo pwd("#現在のファイル名")
		?>
	</div>
	<div id="page">
		<div id="contents">
			<?php
				require_once("left.php"); //左バーの取り込み
			?>
			<!-- ■右表示エリア-->
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap">
					#ここに文章
				</div>
			</div>
		</div>
	</div>
</body>
</html>
