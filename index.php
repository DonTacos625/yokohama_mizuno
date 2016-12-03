<?php
	//======================================================================
	//  ■：トップページ画面 index.php
	//======================================================================
session_start(); //セッションスタート
require_once("PostgreSQL.php"); //sql接続用PHPの読み込み
$pgsql = new PostgreSQL;
if(isset($_SESSION["my_no"]))
	$my_no = $_SESSION["my_no"];
//echo "工事中です";
//exit;
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>横浜みなとみらい観光推薦システム</title>
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script>
		if (window.location.hash == "#_=_") window.location.hash = "";
	</script>
	<?php //require_once("analysis.php");?>
</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '783967058409220',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
	<div id="page">
		<div id = "header">
			<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
			require_once("header.php");
			?>
		</div>
	</div>
	<div id="page">
		<div id="contents">
			<div id="menuL">
			<?php
				//----------------------------------------
				// ■左バーの取り込み
				//----------------------------------------
			require_once("left.php");
			?>
			</div>
			<!-- ■右表示エリア-->
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap">
					<div class="title">
					<div id="sitename">横浜みなとみらい観光推薦システム</div>
						<h5>本運用中</h5>
						Webサイトの目的</br>
						<p>
						家族や友達、恋人、ご夫婦など、<b>グループ</b>での観光回遊行動を支援するための観光情報の共有と推薦になります。
						</p>
						使い方</br>
						<p>
						皆さまに横浜の観光スポットを推薦することがメインとなります。<br>
						実際に訪れたことのある観光スポットについてはレビューをお願いします。<br>
						</p>
						<p>設定方法がわからない場合は下記メールアドレスにご連絡ください。<br>
						作成者 水谷<br>
						y.mizutani[アットマーク]uec.ac.jp<br>
						※[アットマーク]を@へ置換してください。
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>