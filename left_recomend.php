<!--左サイドメニュー-->
	<div class="subinfo">
		<div class="label">あなたの情報</div>
		<ul>
			<?php
			if(isset($_SESSION["my_no"])||isset($_SESSION["gender"])||isset($_SESSION["age"])){
				$my_no = $_SESSION["my_no"];
				$gender = $_SESSION["gender"];
				$age = $_SESSION["age"];

				echo "会員番号：";
				echo (int)$my_no;
				echo "<br>";
				if(isset($_SESSION['fb_access_token'])){
					echo "年　　齢：";
					if($age == NULL)
						echo "未記入<br>";
					else{
						echo $age;
						echo "歳 <br>";
					}
				}else{
					echo "年　　代：";
					if($age == NULL)
						echo "未記入<br>";
					else{
						echo $age;
						echo "代 <br>";
					}
				}
				echo "性　　別：";
				if($gender=="male")
					echo "男性";
				else if($gender=="female")
					echo "女性";
				else if($gender==NULL)
					echo "未記入";
				else
					echo $gender;
			}else{
				echo "ログインをお願いします";
			}
			?>
		</ul>
	</div>

