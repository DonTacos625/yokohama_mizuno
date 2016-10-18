<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ユーザ詳細情報登録</title>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
<?php
	//----------------------------------------	
	// ■ エラーメッセージがあったら表示
	//----------------------------------------	
	if (strlen($error)>0){
		if($error != "登録が完了しました"){
			echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
		}else{
			echo "<font size=\"6\" color=\"#da0b00\">"
			echo "<br><center><a href=\"./top.php\">HOMEへ</a></center>";
			echo "</body>";
			echo "</html>";
			exit;
		}
	}
?>
<div id="page">
	<div id="head">
		<a href="./login.php">Loginページへ戻る</a>
	</div>
</div>
<div id="page">
	<div id="contents">
		<!-- #main 本文スペース -->
		<div class="contentswrap">
		<form action="./register.php" method="POST">
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label" align="center">個人ステータスの登録</div></tr>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">性別</div></td>
				<td>
					<input type="radio" name="sex" value="1"<?php if ($sex==1){ print " checked"; }?> >男
					<input type="radio" name="sex" value="2"<?php if ($sex==2){ print " checked"; }?> >女
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">年代</div>
				</td>
						<td>
							<input type="radio" name="age" value="10"<?php if ($age==10){ print " checked"; }?> >10
							<input type="radio" name="age" value="20"<?php if ($age==20){ print " checked"; }?> >20
							<input type="radio" name="age" value="30"<?php if ($age==30){ print " checked"; }?> >30
							<input type="radio" name="age" value="40"<?php if ($age==40){ print " checked"; }?> >40
							<input type="radio" name="age" value="50"<?php if ($age==50){ print " checked"; }?> >50
							<input type="radio" name="age" value="60"<?php if ($age==60){ print " checked"; }?> >60以上
						</td>
			</tr>
			</table>
			</table>
			<br>
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label2" align="center">嗜好情報の入力</div></tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報1</div>
				</td>
					<td>
						<input type="radio" name="a1" value="1"<?php if ($a1==1){ print " checked"; }?> >1
						<input type="radio" name="a1" value="2"<?php if ($a1==2){ print " checked"; }?> >2
						<input type="radio" name="a1" value="3"<?php if ($a1==3){ print " checked"; }?> >3
						<input type="radio" name="a1" value="4"<?php if ($a1==4){ print " checked"; }?> >4
						<input type="radio" name="a1" value="5"<?php if ($a1==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報2</div>
				</td>
					<td>
						<input type="radio" name="a2" value="1"<?php if ($a2==1){ print " checked"; }?> >1
						<input type="radio" name="a2" value="2"<?php if ($a2==2){ print " checked"; }?> >2
						<input type="radio" name="a2" value="3"<?php if ($a2==3){ print " checked"; }?> >3
						<input type="radio" name="a2" value="4"<?php if ($a2==4){ print " checked"; }?> >4
						<input type="radio" name="a2" value="5"<?php if ($a2==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報3</div>
				</td>
					<td>
						<input type="radio" name="a3" value="1"<?php if ($a3==1){ print " checked"; }?> >1
						<input type="radio" name="a3" value="2"<?php if ($a3==2){ print " checked"; }?> >2
						<input type="radio" name="a3" value="3"<?php if ($a3==3){ print " checked"; }?> >3
						<input type="radio" name="a3" value="4"<?php if ($a3==4){ print " checked"; }?> >4
						<input type="radio" name="a3" value="5"<?php if ($a3==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報4</div>
				</td>
					<td>
						<input type="radio" name="a4" value="1"<?php if ($a4==1){ print " checked"; }?> >1
						<input type="radio" name="a4" value="2"<?php if ($a4==2){ print " checked"; }?> >2
						<input type="radio" name="a4" value="3"<?php if ($a4==3){ print " checked"; }?> >3
						<input type="radio" name="a4" value="4"<?php if ($a4==4){ print " checked"; }?> >4
						<input type="radio" name="a4" value="5"<?php if ($a4==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報5</div>
				</td>
					<td>
						<input type="radio" name="a5" value="1"<?php if ($a5==1){ print " checked"; }?> >1
						<input type="radio" name="a5" value="2"<?php if ($a5==2){ print " checked"; }?> >2
						<input type="radio" name="a5" value="3"<?php if ($a5==3){ print " checked"; }?> >3
						<input type="radio" name="a5" value="4"<?php if ($a5==4){ print " checked"; }?> >4
						<input type="radio" name="a5" value="5"<?php if ($a5==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報6</div>
				</td>
					<td>
						<input type="radio" name="a6" value="1"<?php if ($a6==1){ print " checked"; }?> >1
						<input type="radio" name="a6" value="2"<?php if ($a6==2){ print " checked"; }?> >2
						<input type="radio" name="a6" value="3"<?php if ($a6==3){ print " checked"; }?> >3
						<input type="radio" name="a6" value="4"<?php if ($a6==4){ print " checked"; }?> >4
						<input type="radio" name="a6" value="5"<?php if ($a6==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報7</div>
				</td>
					<td>
						<input type="radio" name="a7" value="1"<?php if ($a7==1){ print " checked"; }?> >1
						<input type="radio" name="a7" value="2"<?php if ($a7==2){ print " checked"; }?> >2
						<input type="radio" name="a7" value="3"<?php if ($a7==3){ print " checked"; }?> >3
						<input type="radio" name="a7" value="4"<?php if ($a7==4){ print " checked"; }?> >4
						<input type="radio" name="a7" value="5"<?php if ($a7==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報8</div>
				</td>
					<td>
						<input type="radio" name="a8" value="1"<?php if ($a8==1){ print " checked"; }?> >1
						<input type="radio" name="a8" value="2"<?php if ($a8==2){ print " checked"; }?> >2
						<input type="radio" name="a8" value="3"<?php if ($a8==3){ print " checked"; }?> >3
						<input type="radio" name="a8" value="4"<?php if ($a8==4){ print " checked"; }?> >4
						<input type="radio" name="a8" value="5"<?php if ($a8==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報9</div>
				</td>
					<td>
						<input type="radio" name="a9" value="1"<?php if ($a9==1){ print " checked"; }?> >1
						<input type="radio" name="a9" value="2"<?php if ($a9==2){ print " checked"; }?> >2
						<input type="radio" name="a9" value="3"<?php if ($a9==3){ print " checked"; }?> >3
						<input type="radio" name="a9" value="4"<?php if ($a9==4){ print " checked"; }?> >4
						<input type="radio" name="a9" value="5"<?php if ($a9==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報10</div>
				</td>
					<td>
						<input type="radio" name="a10" value="1"<?php if ($a10==1){ print " checked"; }?> >1
						<input type="radio" name="a10" value="2"<?php if ($a10==2){ print " checked"; }?> >2
						<input type="radio" name="a10" value="3"<?php if ($a10==3){ print " checked"; }?> >3
						<input type="radio" name="a10" value="4"<?php if ($a10==4){ print " checked"; }?> >4
						<input type="radio" name="a10" value="5"<?php if ($a10==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
				<div class="label2">嗜好情報11</div>
				</td>
					<td>
						<input type="radio" name="a11" value="1"<?php if ($a11==1){ print " checked"; }?> >1
						<input type="radio" name="a11" value="2"<?php if ($a11==2){ print " checked"; }?> >2
						<input type="radio" name="a11" value="3"<?php if ($a11==3){ print " checked"; }?> >3
						<input type="radio" name="a11" value="4"<?php if ($a11==4){ print " checked"; }?> >4
						<input type="radio" name="a11" value="5"<?php if ($a11==5){ print " checked"; }?> >5
					</td>
			</tr>
			<tr><td align="center" colspan="1">
			<input type="submit" name="Submit" value="登録する"></td></tr>
			</table>
		</form>
		</div>
	</div>
</div>
</body>
</html>
