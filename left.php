<!--左サイドメニュー-->
<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_SESSION["my_no"])&&$_SESSION["anq"]==0){
		$sql="UPDATE friendinfo SET anq=$1 WHERE no=$2";
		$array = array(1,$_SESSION["my_no"]);
		$pgsql -> query($sql,$array);
		$_SESSION["anq"]=1;
		$anqURL=getenv("anqURL");
		if($_SESSION["anq"]==1){
			echo "<script type='text/javascript'>";
			echo "location.href='".$anqURL."'";
			echo "</script>";
		}
	}
}
?>
<script type="text/javascript">
	function check(){
		if(window.confirm('送信してよろしいですか？')){ // 確認ダイアログを表示
			return true; // 「OK」時は送信を実行
		}
		else{ // 「キャンセル」時の処理
			window.alert('キャンセルされました'); // 警告ダイアログを表示
			return false; // 送信を中止
		}
	}
</script>
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
			echo "<a href='./login.php' title='ログイン'>ログイン</a>又は<a href='./login.php' title='新規利用登録'>新規利用登録</a>をお願いします";
		}
		?>
	</ul>
	<?php
	if(isset($_SESSION["anq"])&&$_SESSION["anq"]==0){
		echo "<div class='label'>アンケート</div>";
		echo "<ul>";
		echo "<form action=".$_SERVER['PHP_SELF']." method='POST' accept-charset='utf-8' onSubmit='return check()'>";
		echo "<input type='submit' value='アンケートに答える'>";
		echo "</form>";
		echo "注意:<br>回答は<font color='red'><b>１度のみ</b></font>です。<br><b>推薦システムを1度以上利用してからご回答下さい</b>";
		echo "</ul>";
	}
	?>
	<div class="label">SNS</div>
	<ul>
		<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fstudy-yokohama-sightseeing.herokuapp.com%2Findex.php&width=136&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId=783967058409220" width="136" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
	</ul>
	<a class="twitter-timeline"  href="https://twitter.com/hashtag/%E3%81%BF%E3%81%AA%E3%81%A8%E3%81%BF%E3%82%89%E3%81%84" data-widget-id="805220608573198337">#みなとみらい のツイート</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
