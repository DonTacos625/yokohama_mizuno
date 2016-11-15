<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="./stylet.css"></link>
</head>
<body>
<div id="page">
	<div id="menuL">
		<div class="subinfo">
			<div class="label">あなたの情報</div>
			<?php
			//-----------------------------------------------------
			// □：友達情報テーブル(friendinfo)からデータを読む
			//-----------------------------------------------------
			if (isset($_SESSION["my_no"])){
				$sql = "SELECT gender,age FROM friendinfo WHERE no=$1";
				$array = array($_SESSION["my_no"]);
				$pgsql->query($sql,$array);
				$row = $pgsql->fetch();
			}else{
				echo "ログインをしてください.";
				echo "</dvi></dvi></dvi></body></hmtl>";
				exit;
			}
			?>
		</div>
		<div class="subinfo">
			<div class="label">ユーザー情報</div>
			<ul>会員番号：<?php echo json_encode($my_no)?>
			<br>　年代　：<?php echo json_encode($row["age"]); ?>代
			<br>　性別　：<?php if ($row["gender"]==1){ echo "男性"; }else if($sex==2){ echo "女性"; }else{echo "未記入";}?>
		</div>
		<!--
		<div class="subinfo">
			<div class="label">最新<?=LIST_NEW_COUNT ?>件日記</div>
			<?php
			//-----------------------------------------------------
			// □：クッキングログテーブル(cookinglog)からデータを読む
			//-----------------------------------------------------
			$sql = "SELECT cookinglog.*,friendinfo.usrid as usrid FROM cookinglog";
			$sql.= " LEFT JOIN friendinfo ON cookinglog.no=friendinfo.no";
			$sql.= " ORDER BY logno DESC LIMIT 0," .LIST_NEW_COUNT;
			$mysql->query($sql);
			while($row = $mysql->fetch()){
				$tm_no = $row["no"];
				$tm_id = $row["usrid"];
				$logno = $row["logno"];
				if ($tm_no<>$my_no){
					$tm_id.="さん";
				}
				$tm_title = mb_substr($row["title"],0,14) ."...";
				$tm_date = $row["upddate"];
				echo "<ul><a href=\"./cookingread.php?usr_no=$tm_no&log_no=$logno\">$tm_id:$tm_title</a></ul>";
			}
			?>
		</div>
		-->
<!--		<div class="label">最新10件モバイル投稿情報</div>
			<?php
			//-----------------------------------------------------
			// □：infoテーブル(info)からデータを読む
			//-----------------------------------------------------
			$sql = "SELECT * FROM twitter WHERE TIME";
			$sql.= " ORDER BY TIME DESC LIMIT 0," .LIST_NEW_COUNT;
			$mysql->query($sql);
			while($row = $mysql->fetch()){
				$tm_no = $row["NAME"];
				$logno = $row["TIME"];
				$tm_title = mb_substr($row["COMMENT"],0,14) ."...";
				echo "<ul><a href=\"./local_info_read_twi.php?time=$logno\">$tm_no:$tm_title</a></ul>";
			}
			echo "<div align=\"right\"><a href=\"allinfo_twi2.php\">モバイル投稿情報一覧</a></div>";
			echo "<div align=\"right\"><a href=\"allinfo_twi2_rank.php\">モバイル投稿ランキングへ</a></div>";
			?>
-->			
		<div class="subinfo">
			<div class="label">最新<?=LIST_NEW_COUNT ?>件投稿情報</div>
			<?php
			//-----------------------------------------------------
			// □：infoテーブル(info)からデータを読む
			//-----------------------------------------------------
			$sql = "SELECT info.*,friendinfo.usrid as usrid FROM info";
			$sql.= " LEFT JOIN friendinfo ON info.no=friendinfo.no";
			$sql.= " ORDER BY info_logno DESC LIMIT 0," .LIST_NEW_COUNT;
			$mysql->query($sql);
			while($row = $mysql->fetch()){
				$tm_no = $row["no"];
				$tm_id = $row["usrid"];
				$logno = $row["info_logno"];
				if ($tm_no<>$my_no){
					$tm_id.="さん";
				}
				$tm_title = mb_substr($row["info_title"],0,14) ."...";
				$tm_date = $row["upddate"];
				echo "<ul><a href=\"./local_info_read2.php?usr_no=$tm_no&log_no=$logno\">$tm_id:$tm_title</a></ul>";
			}
			echo "<div align=\"right\"><a href=\"allinfo.php\">投稿情報一覧</a></div>";
			echo "<div align=\"right\"><a href=\"allinfo_rank.php\">投稿情報ランキングへ</a></div>";
			?>
		</div>

		<div class="subinfo">
<!--			<div class="label">お友達リンク</div>-->
			<?php
			//-----------------------------------------------------
			// □：友達情報テーブル(friendinfo)からデータを読む
			//-----------------------------------------------------
			$sql = "SELECT * FROM friendinfo WHERE no<>$my_no";
			$mysql->query($sql);
			while($row = $mysql->fetch()){
				$tomo_no = $row["no"];
				$tomo_id = $row["usrid"];
				if ($tomo_no<>$my_no){
					$tomo_id.="さん";
				}
//				echo "<ul><a href=\"./mypage.php?usr_no=$tomo_no\">$tomo_id</a></ul>";
			}
			?>
		</div>
	</div>
</div>
</body>
</html>
