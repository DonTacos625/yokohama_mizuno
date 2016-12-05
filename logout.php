<?php
//======================================================================
//  ■：ログアウト画面 logout.php
//======================================================================
//----------------------------------------	
// ■SESSIONを初期化する
//----------------------------------------	
session_start();		//セッション開始
$_SESSION = array();
session_destroy();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}
?>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>ログアウト</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<div id ="header.php">
			<?php
			require_once("header.php");
			?>
		</div>
		<div id="contents">
			<!-- ■右表示エリア-->
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap">
					みなとみらい観光支援サイトからログアウトしました。
				</div>
			</div>
		</div>
	</div>
</body>
</html>