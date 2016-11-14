<?php
//観光スポット推薦システム 推薦項目ページ
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>スポット推薦</title>
</head>
<body>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
<script type="text/javascript">
</script>
<script>
 /* (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44576041-1', 'uec.ac.jp');
  ga('send', 'pageview');
*/
</script>
</head>
<div id="page">
	<?php
		require_once('header.php');
		if (strlen($error)>0) {
			// エラーメッセージがあったら表示
			echo "<center><font size=\"4\">{$error}</font></center><p>";
			if ($error == "登録が完了しました" || $error == "変更が完了しました") {
				echo "<br><center><a href=\"./mypage.php\">マイページへ</a></center>\n";
				echo "</body>\n";
				echo "</html>";
				exit;
			}
		}
	?>
	<div id="contents">
		<?php
		require_once('left.php');
		?>
		<div id ="main">
			<div class ="contentswrap">
				<ul><h4>カテゴリーをお選びください。</h4></ul>
				<ul><form name="form1" method="post" action="./recomend2.php"><b>
					<input type="checkbox" name="chk[]" value="1"> 飲食<br><br>
					<input type="checkbox" name="chk[]" value="2"> 店舗<br><br>
					<input type="checkbox" name="chk[]" value="3"> 娯楽<br><br>
					<input type="checkbox" name="chk[]" value="4"> イベント<br><br>
					<input type="checkbox" name="chk[]" value="5"> 景色<br><br>
					<input type="checkbox" name="chk[]" value="6"> 芸術<br><br>
					<input type="checkbox" name="chk[]" value="7"> レクリエーション<br><br>
					<input type="hidden" name ="lat" id="lat">
					<input type="hidden" name ="lng" id="lng"><br>
					<input type="submit" name="Submit" value=" 送信 ">
				</b></form></ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>