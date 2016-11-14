<?php
//======================================================================
// ■： 地域情報表示画面　local_info_read.php
//======================================================================
//----------------------------------------	
// ■　共通　require_once
//----------------------------------------	
//require_once("com_require.php");
//require_once("getJSON.php");
//----------------------------------------	
// ■　POSTされたとき
//----------------------------------------	
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ POSTされたデータを取得
	//--------------------------------
	$usr_no =$_POST["usr_no"];
	$log_no =$_POST["log_no"];
	$contentres = htmlspecialchars($_POST["info_contentres"], ENT_QUOTES);	//コメント
	//--------------------------------
	// □ コメントボタンが押されたとき
	//--------------------------------
	if (isset($_POST["submit_res"])){
		//--------------------------------
		// □ 入力内容チェック
		//--------------------------------
		//コメント
		if (strlen($contentres)==0){$error ="コメントが未入力です";}
		if (strlen($error)==0){
			//--------------------------------------------------
			// □ コメントテーブル(infores)を読む
			//--------------------------------------------------
			//レス番号の最大値を取得
			$res_no = 0;
			$mysql->query("SELECT MAX(info_resno) AS maxno FROM infores");
			if ($mysql->rows()>0){
				$row = $mysql->fetch();
				$res_no = $row["maxno"];
			}
			$res_no++;
			//--------------------------------------------------
			// □ コメントテーブル(infores)に新規追加
			//--------------------------------------------------
			$sql = "INSERT INTO infores VALUES(";
			$sql.= "$usr_no,$log_no,$res_no,$my_no,'$contentres',0,now())";
			$mysql->query($sql);
			$error = "コメントを追加しました。";
		}
	}
	//--------------------------------
	// □ 変更ボタンが押されたとき
	//--------------------------------
	if (isset($_POST["submit_upd"])){
		header("Location: http://$host/local_info_read2.php?info_log_no=$log_no");
		exit;
	}
	//-----------------------------------------
	// □ 削除ボタンが押されたとき
	//-----------------------------------------
	if (isset($_POST["submit_del"])){
		//--------------------------------------------------
		// □　画像削除
		//--------------------------------------------------
		$sql = "SELECT pic FROM info WHERE no=$my_no AND info_logno=$log_no";
		$mysql->query($sql);
		if ($mysql->rows()>0){
			$row = $mysql->fetch();
			$pic = $row["pic"];
		}
		if (strlen($pic)>0 && file_exists("$pic_path/$pic")){
			unlink("$pic_path/$pic");	//削除
		}
		//元のログを削除
		$sql = "DELETE FROM info WHERE no=$my_no AND info_logno=$log_no";
		$mysql->query($sql);
		//コメントも削除
		$sql = "DELETE FROM infores WHERE no=$my_no AND info_logno=$log_no";
		$mysql->query($sql);
		//マイページにジャンプ
		header("Location: http://$host/mypage.php");	
		exit;
	}
	//-----------------------------------------
	// □ コメントの削除ボタンが押されたとき
	//-----------------------------------------
	if (isset($_POST["submit_resdel"])){
		$res_no = key($_POST["submit_resdel"]);
		$sql = "DELETE FROM infores WHERE no=$usr_no AND info_logno=$log_no AND info_resno=$res_no";
		$mysql->query($sql);
		$error = "コメントを1件削除しました";
	}
}
//=====================================================================
// ■　H T M L
//=====================================================================
?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>投稿情報の閲覧</title>
<script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="jquery-1.8.3.js"></script>
<script	type="text/javascript" src="mapcode5.js"></script>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44576041-1', 'uec.ac.jp');
  ga('send', 'pageview');

</script>
</head>
<body>
<div id="page">
	<?php
	
	//----------------------------------------	
	// ■　ヘッダーの取り込み
	//----------------------------------------	
	require_once("header.php");
	
	//----------------------------------------	
	// ■　エラーメッセージがあったら表示
	//----------------------------------------	
	if (strlen($error)>0){
		echo "<font size=\"2\" color=\"#da0b00\">{$error}</font><p>";
	}
	?>
	<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
	<div id="contents">
		<?php
		//----------------------------------------	
		// ■　左バーの取り込み
		//----------------------------------------	
		require_once("left.php");
		//----------------------------------------	
		// ■　右表示エリア
		//----------------------------------------	
		?>
		<div id="main">
			<div class="contentswrap">
				<?php
				//require_once("getJSON.php");
				//--------------------------------------------------------------
				// □：地域情報テーブル(cookinglog)からデータを読む
				//--------------------------------------------------------------
				$sql = "SELECT * FROM info WHERE no=$usr_no AND info_logno=$log_no";
				$mysql->query($sql);
				if ($mysql->rows()>0){
					$row = $mysql->fetch();
					$title = $row["info_title"];
					$upddate = $row["upddate"];
					$content = $row["info_content"];
					list($y,$m,$d) = explode("-", $upddate);
					echo "<font color=\"#6b8e23\"><b>{$y}年{$m}月{$d}日</b></font>&nbsp;&nbsp;&nbsp;";
					if ($my_no==$usr_no){
						echo "<input type=\"submit\" name=\"submit_upd[$log_no]\" value=\"変更\">\n";
						echo "<input type=\"submit\" name=\"submit_del[$log_no]\" value=\"削除\"><p>\n";
					}
					echo "タイトル：<b>$title</b><br>";
					if (strlen($row["pic"])>0){
						$pic = "http://$host/image/" .$row["pic"];
						echo "<a href=\"local_info_read2.php?usr_no=$usr_no&log_no=$log_no\">";
						echo "<img src=\"$pic\" border=\"0\">\n";
						echo "</a><br><br>\n";
					}
					echo "【地域情報】<br>\n";
					get_url($content);
					echo "<font color=\"#2b8e57\">$content</font><br>\n";
				}
				?>
				<div id="map_canvas" style="width:630px; height:550px"></div>
				<form><b><br>＜カテゴリ＞<br>
				<input type="checkbox" id="レストラン・カフェbox" onclick=boxclick(this,"レストラン・カフェ") /> レストラン・カフェ
				<input type="checkbox" id="その他飲食box" onclick=boxclick(this,"その他飲食") /> その他飲食
				<input type="checkbox" id="名所・旧跡box" onclick=boxclick(this,"名所・旧跡") /> 名所・旧跡
				<input type="checkbox" id="ショッピングbox" onclick=boxclick(this,"ショッピング") /> ショッピング
				<br>
				<input type="checkbox" id="テーマパーク・公園box" onclick=boxclick(this,"テーマパーク・公園") /> テーマパーク・公園
				<input type="checkbox" id="美術館・博物館box" onclick=boxclick(this,"美術館・博物館") /> 美術館・博物館
				<input type="checkbox" id="風景box" onclick=boxclick(this,"風景") /> 風景
				<input type="checkbox" id="その他box" onclick=boxclick(this,"その他") /> その他
				</b></form>
				<?php
				//--------------------------------------------------------------
				// □：地域情報コメントテーブル(infores)からデータを読む
				//--------------------------------------------------------------
				$sql = "SELECT infores.*,friendinfo.usrid AS tomoid FROM infores";
				$sql.= " LEFT JOIN friendinfo ON infores.info_tomono =friendinfo.no";
				$sql.= " WHERE infores.no=$usr_no AND infores.info_logno=$log_no";
				$sql.= " ORDER BY infores.info_resno";
				$mysql->query($sql);
				while($row = $mysql->fetch()){
					$res_no = $row["info_resno"];
					$tomo_no = $row["info_tomono"];
					$tomo_id = $row["tomoid"];
					if ($tomo_no<>$my_no){
						$tomo_id.="さん";
					} 
					$upddate = $row["upddate"];
					$contentres = $row["info_contentres"];
					echo "<br>" .str_repeat("_",80) ."<br>";
					list($y,$m,$d) = explode("-", $upddate);
					echo "<font color=\"#6b8e23\"><b>{$y}年{$m}月{$d}日</b></font>&nbsp;&nbsp;&nbsp;";
					echo "<b>{$tomo_id}</b>&nbsp;&nbsp;";
					if ($my_no==$usr_no || $my_no==$tomo_no){
						echo "<input type=\"submit\" name=\"submit_resdel[$res_no]\" value=\"削除\">";
					}
					echo "<br>\n";
					get_url($info_contentres);
					echo $contentres;
				}
				//--------------------------------------------------------------
				// □：お料理日記コメントテーブル(cookingres)を既読に更新
				//--------------------------------------------------------------
				$sql = "UPDATE infores SET readflg=1 WHERE no=$my_no AND info_logno=$log_no";
				$mysql->query($sql);
				//--------------------------------------------------------------
				// □：お料理日記コメントテーブル(cookingres)を既読に更新
				//--------------------------------------------------------------
				$sql = "UPDATE infores SET readflg=1 WHERE no=$my_no AND info_logno=$log_no";
				$mysql->query($sql);
				?>
				<br><br>
				<input type="hidden" name="usr_no" value="<?=$usr_no ?>">
				<input type="hidden" name="log_no" value="<?=$log_no ?>">
			</div>
				
				<p><img src="./mkhan2.jpg" width="600" height="150"  hspace="5" vspace="5" align="left" alt="トップロゴ"><br/></p>
		</div>
	</div>
	</form>
</div>
</body>
</html>