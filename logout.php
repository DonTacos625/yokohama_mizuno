<?php
//======================================================================
//  ■：ログアウト画面 logout.php
//======================================================================
//----------------------------------------	
// ■SESSIONを初期化する
//----------------------------------------	
	session_start();		//セッション開始
	unset($_SESSION["my_no"]);		//Sessionの初期化
	unset($_SESSION["gender"]);
	unset($_SESSION["age"]);
	unset($_SESSION["anq"]);
	if(isset($_SESSION["fb"]))
		unset($_SESSION["fb"]);
	?>
	<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>ログアウト</title>
	</head>
	<body>
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