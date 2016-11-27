<?php
	//======================================================================
	//  ■：マイページ mypage.php
	//======================================================================
	session_start(); //セッションスタート
	require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
	$pgsql = new PostgreSQL;

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
		$menu = htmlspecialchars($_POST["menu"], ENT_QUOTES);	//menu番号

		if($menu==1){
			header('Location: https://study-yokohama-sightseeing.herokuapp.com/fb_register.php');
			exit;
		}
		if($menu==2){
			header('Location: https://study-yokohama-sightseeing.herokuapp.com/register_group.php');
			exit;
		}
		if($menu==3){
			header('Location: https://study-yokohama-sightseeing.herokuapp.com/changepw.php');
			exit;
		}
		if($menu==4){
			if(isset($_SESSION["my_no"])&&$_SESSION["anq"]==0){
				$sql="UPDATE friendinfo SET anq=$1 WHERE no=$2";
				$array = array(1,$_SESSION["my_no"]);
				$pgsql -> query($sql,$array);
				$_SESSION["anq"]=1;
				if($_SESSION["anq"]==1){
					header('Location: https://study-yokohama-sightseeing.herokuapp.com/changepw.php');
					exit;
				}
			}
		}
	}else{
		if(isset($_SESSION["my_no"]))
			$my_no = $_SESSION["my_no"];
	}


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
	<!--google解析-->
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87819413-1', 'auto');
  ga('send', 'pageview');

</script>
<!--ここまで-->
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
					<form method="post" action="<?=$_SERVER["PHP_SELF"]?>">
						<tr>
							<div class="label2" align="center">メニューを選んでください</div>
						</tr>
						<tr>
							<b>
								<label><input type="radio" name="menu" value="1" checked>個人情報編集</label>
								<br><br>
								<label><input type="radio" name="menu" value="2">グループ編集</label>

								if(!isset($_SESSION["fb"]))
									echo "<br><br><label><input type='radio' name='menu' value='3'>パスワード変更</label>";
								<!--<?phpif($_SESSION["anq"]==0)
									echo "<br><br><label><input type='radio' name='menu' value='4'>アンケートに答える(推薦システムを1度以上利用してからお答えください)</label>";
								?>-->
								<br><br>
								<input type="submit" value="送信">
							</b>
						</tr>
					</form>
					</table>
					アンケート機能は調整中です。
				</div>
			</div>
		</div>
	</div>
</body>
</html>
