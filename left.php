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
				<?php
			//-----------------------------------------------------
			// □：友達情報テーブル(friendinfo)からデータを読む
			//-----------------------------------------------------
				if (isset($_SESSION["my_no"])){
					$sql = "SELECT gender,age FROM friendinfo WHERE no=$1";
					$array = array($_SESSION["my_no"]);
					$pgsql->query($sql,$array);
					$row = $pgsql->fetch();
				}else{
					echo "ログインをしてください.";
				}
				?>
			</div>
			<div class="subinfo">
				<div class="label">あなたの情報</div>
				<ul>
				<?php
					if (isset($_SESSION["my_no"])){
						echo "会員番号：";
						echo json_encode($my_no);
						echo "<br>";
						echo "　年代　：";
						echo json_encode($row["age"]);
						echo "代 <br>";
						echo "　性別　：";
						if($row["gender"]==1)
							echo "男性";
						else if($row["gender"]==2)
							echo "女性";
						else
							echo "未記入";
					}
				?>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>