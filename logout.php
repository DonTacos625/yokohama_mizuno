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