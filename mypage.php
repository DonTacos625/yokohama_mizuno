<?php
	//======================================================================
	//  ■：テンプレート
	//======================================================================
	session_start(); //セッションスタート
	require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
	$pgsql = new PostgreSQL;
	if(isset($_SESSION["my_no"]))
		$my_no = $_SESSION["my_no"];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>マイページ</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
	</script>
</head>
<body>
	<div id="page">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		if(!isset($_SESSION["my_no"])){
			echo "ログインページよりログインしてください";
			echo "</div></body></html>";
			exit;
		}
		require_once("./linkplace.php");
		echo pwd("mypage");
		?>
	</div>
	<div id="page">
		<div id="contents">
			<?php
				require_once("left.php"); //左バーの取り込み
			?>
			<!-- ■右表示エリア-->
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap">
					<table align="center" border="0" cellspacing="3" cellpadding="3">
						<tr>
							<div class="label2" align="center">メニューを選んでください</div>
						</tr>
					<tr>
						<td>
							<form action="" onsubmit="with(this)for(i=0;i&lt;s.length;i++)if(s[i].checked)location.href=s[i].value;return!1">
							<b>
								<label><input type="radio" name="s" value="./fb_register.php">個人情報編集</label>
								<br><br>
								<label><input type="radio" name="s" value="./register_group.php">グループ編集</label>
								<?php if(!isset($_SESSION["fb"])){echo "<br><br><label><input type='radio' name='s' value='./changepw.php'>パスワード変更</label>";}?>
								<br><br>
								<input type="submit" value="送信" style="font-weight:bold">
							</b>
							</form>
					</td>
					</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
