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
		<div class="label">シェア</div>
		<ul>
		<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fstudy-yokohama-sightseeing.herokuapp.com%2Findex.php&width=136&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId=783967058409220" width="136" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
		</ul>
	</div>
