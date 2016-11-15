<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="./stylet.css"></link>
</head>
<body>
	<div id="page">
		<div id="menuL">
			<div class="subinfo">
				<div class="label">あなたの情報</div>
				<ul>
				<?php
					if (isset($_SESSION["my_no"])&&isset($_SESSION["gender"])$$isset($_SESSION["age"])){
						$my_no = $_SESSION["my_no"];
						$gender = $_SESSION["gender"];
						$age = $_SESSION["age"];

						echo "会員番号：";
						echo (int)$my_no;
						echo "<br>";
						echo "年　　代：";
						echo (int)$row["age"];
						echo "代 <br>";
						echo "性　　別：";
						if($gender==1)
							echo "男性";
						else if($gender==2)
							echo "女性";
						else
							echo "未記入";
					}else{
						echo "ログインをお願いします";
					}
				?>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>