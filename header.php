<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="./stylet.css"></link>
</head>
<body>
<div id="page">
	<div class = label3><a href="./mypage_s.php">スマートフォン用ページ</a></div>
	<div id="menu">
			<ul class="menu_f02">
			<?php
			//-----------------------------------------------------
			// □：ログインしていたらマイページへのリンクを出力
			//-----------------------------------------------------
			if (isset($_SESSION["my_no"])){
				echo "<li><a href=\"./index.php\">トップページ</a></li>";
				echo "<li><a href=\"./mypage.php\">マイページ</a></li>";
				echo "<li><a href=\"./localinfo.php\">観光スポット閲覧</a></li>";
				echo "<li><a href=\"./local_evaluation.php\">観光スポット評価</a></li>";
				echo "<li><a href=\"./recomend1.php\">観光スポット推薦</a></li>";
				echo "<li><a href=\"./logout.php\">ログアウト</a></li>";
			}else{
				echo "<li><a href=\"./login.php\">ログイン</a></li>";
			}
			?>
			</ul>
	</div>
</div>
</body>
</html>
