<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="./stylet_s.css"></link>
</head>
<body>
	<div id="page">
		<div class = label3><a href="./mypage.php">PC用ページ</a></div>
		<div id="menu">
			<ul class="menu_f02">
				<?php
			//-----------------------------------------------------
			// □：ログインしていたらマイページへのリンクを出力
			//-----------------------------------------------------

				if (isset($_SESSION["my_id"])){
					echo "<li><a href=\"./index_s.php\">トップページ</a></li>";
					echo "<li><a href=\"./mypage_s.php\">マイ情報</a></li>";
					echo "<li><a href=\"./local_info_see_s.php\">閲覧</a></li>";
					echo "<li><a href=\"./recomend1_s.php\">観光スポット推薦</a></li>";
					echo "<li><a href=\"./logout_s.php\">ログアウト</a></li>";
				}else{
					echo "<li><a href=\"./login_s.php\">ログイン</a></li>";
				}
				?>
			</ul>
		</div>
	</div>
</body>
</html>
