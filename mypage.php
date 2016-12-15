<?php
//======================================================================
//  ■：マイページ mypage.php
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
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
	</script>
</head>
<body>
	<?php include_once("analyticstracking.php") ?>
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
			<div id="menuL">
				<?php
			require_once("left.php"); //左バーの取り込み
			?>
		</div>
		<!-- ■右表示エリア-->
		<div id="main">
			<!-- #main 本文スペース -->
			<div class="contentswrap">
				<div class="label2" align="center">マイページメニュー 一覧</div>
				<ul>
					<li><a href="https://study-yokohama-sightseeing.herokuapp.com/register_info.php">会員詳細情報編集</a></li>
					<li><a href="https://study-yokohama-sightseeing.herokuapp.com/register_group.php">グループ登録・編集</a></li>
					<?php if(!isset($_SESSION["fb_access_token"])&&!isset($_SESSION["sns"])){
						echo "<li><a href='https://study-yokohama-sightseeing.herokuapp.com/changepw.php'>パスワード変更</a></li>";
					}?>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>
