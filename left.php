<!--左サイドメニュー-->
<div id="menuL">
	<div class="subinfo">
		<div class="label">あなたの情報</div>
		<ul>
			<?php
			if (isset($_SESSION["my_no"])||isset($_SESSION["gender"])||isset($_SESSION["age"])){
				$my_no = $_SESSION["my_no"];
				$gender = $_SESSION["gender"];
				$age = $_SESSION["age"];

				echo "会員番号：";
				echo (int)$my_no;
				echo "<br>";
				echo "年　　代：";
				if($age == NULL)
					echo "未記入<br>";
				else{
					echo $age;
					echo "代 <br>";
				}
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
