<?php
	require_once('com_require.php');
//	mysql_select_db('SET NAMES utf8',$sql);
	//mysql_query("set names sgis");
	// print_r($_FILES);
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// POSTされたデータを取得
		@$usr_id = htmlspecialchars($_POST['usr_id'], ENT_QUOTES);	// ID
		@$num = $_POST['num'];
		$info_title = htmlspecialchars($_POST['info_title'], ENT_QUOTES);
		$info_content = htmlspecialchars($_POST['info_content'], ENT_QUOTES);
		$lat = $_POST['show_x'];
		$lng = $_POST['show_y'];
		$good = null;
		$type = htmlspecialchars($_POST['type'], ENT_QUOTES);
		// 画像用変換
		$pic_name = $_FILES['pic']['name']; 				// ローカルファイル名
		$pic_tmp = $_FILES['pic']['tmp_name']; 				// テンポラリファイルの名前
		$pic_type = $_FILES['pic']['type']; 				// 画像タイプ
		$pic_size = $_FILES['pic']['size']; 				// 画像サイズ
		$chk_del = 0;										// 画像削除フラグ(変更時のみ)
		if (isset($_POST['chk_pic'])) {$chk_del = 1;}
		$upd_pic = '';										// 初期画像名(変更時のみ)
		if (isset($_POST['upd_pic'])) {$upd_pic = $_POST['upd_pic'];}
		if (strlen($info_title) == 0) {$error = "タイトルが未入力です";}
		if (strlen($info_content) == 0) {$error = "本文が未入力です";}
		//if (strlen($lat) == 0) {$error = "位置情報が未入力です";}
		// ファイル
		if (strlen($pic_name)>0) {
			if (is_uploaded_file($pic_tmp)) {
				if ($pic_size == 0) {$error = "画像が不正です。";}
				if ($pic_size>5000000) {$error = "画像のサイズが大きすぎます。({$pic_size}バイト)";;}
				if ($pic_type == "image/gif") {$kaku = "gif";}
				if ($pic_type == "image_png" || $pic_type == "image/x-png") {$kaku = "png";}
				if ($pic_type == "image/jpeg" || $pic_type == "image/pjpeg") {$kaku = "jpg";}
				if ($kaku == "") {$error ="画像種類に誤りがあります。";}
			}
		}
		if (strlen($error) == 0) {
		// 登録ボタンが押された時
			if(isset($_POST["submit_toko"])) {			
				// ログの最大値を取得
				$log_no = 0;
				$mysql->query("SELECT MAX(info_logno) AS maxno FROM info");
				if ($mysql->rows()>0) {
					$row = $mysql->fetch();
					$log_no = $row['maxno'];
				}
				$log_no++;
				if (strlen($pic_name)>0) {
					// 画像の移動
					$ymdhis = date("YmdHis");
					$pic_name = "{$my_no}-{$log_no}-{$ymdhis}.{$kaku}";
					move_uploaded_file($pic_tmp, "$pic_path/$pic_name");
				}
					//mysql_query('SET NAMES utf8',$sql);
					//mysql_set_charset('utf8');
					$sql = "INSERT INTO info VALUES(";
					$sql.= "$my_no,$log_no,'$info_title','$info_content','$pic_name',now(),'$lat','$lng','$type','$good','$good1')";
					$mysql->query($sql);
					$error = "登録が完了しました";
			}
		}
	}
?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"></meta>
<title>地域情報</title>
<script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--	<script src="http://serverapi.arcgisonline.com/jsapi/gmaps/?v=1.4" type="text/javascript" ></script> -->
<script type="text/javascript">
	var map;          // GoogleMapオブジェクトの変数宣言
	var markers = new google.maps.MVCArray; // マーカー保存配列 
</script>
<script	type="text/javascript" src="mapcode.js"></script>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>

<body onload="initialize();">
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
		<div id="main">
			<div class="contentswrap">
				<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<table border="0" cellspacing="3" cellpadding="3" width="600"  >
				<tr><td align="center" bgcolor="#fof8ff" colspan="2">
				<font size="4"><b>観光スポットの評価情報を投稿する</b></font></td></tr>
				<td align="center" bgcolor="#fof8ff">
				<font size="4"><b>スポット名</b></font></td>
				<td><input type="text" name="info_title" size="40"></td>
				<tr><td align="center" bgcolor="#fof8ff"><font size="4"><b>カテゴリー</b></font></td>
				<td>
				&nbsp;<select name="type">
				<option value="名所・旧跡"<?if ($type=="1"){echo " selected";}?>>名所・旧跡</option>
				<option value="風景"<?if ($type=="2"){echo " selected";}?>>風景</option>
				<option value="テーマパーク・公園"<?if ($type=="3"){echo " selected";}?>>テーマパーク・公園</option>
                                <option value="美術館・博物館"<?if ($type=="4"){echo " selected";}?>>美術館・博物館</option>
				<option value="ショッピング"<?if ($type=="5"){echo " selected";}?>>ショッピング</option>
                                <option value="レストラン・カフェ"<?if ($type=="6"){echo " selected";}?>>レストラン・カフェ</option>
				<option value="その他飲食"<?if ($type=="7"){echo " selected";}?>>その他飲食</option>
				<option value="その他"<?if ($type=="8"){echo " selected";}?>>その他</option>
				</td></tr>
				<tr><td align="center" bgcolor="#fof8ff"><font size="4"><b>写真</b></font></td>
				<td><input type="file" name="pic" value="yamada"></td></tr>
				<tr><td align="center" bgcolor="#fof8ff"><font size="4"><b>本文</b></font></td>
				<td><textarea name="info_content" cols="40" rows="20"></textarea></td></tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>満足度</b></td>
						<td>
							<input type="radio" name="a1" value="1"<?php if ($a1==1){ print " checked"; }?> > 1
							<input type="radio" name="a1" value="2"<?php if ($a1==2){ print " checked"; }?> > 2
							<input type="radio" name="a1" value="3"<?php if ($a1==3){ print " checked"; }?> > 3
							<input type="radio" name="a1" value="4"<?php if ($a1==4){ print " checked"; }?> > 4
							<input type="radio" name="a1" value="5"<?php if ($a1==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>アクセス</b></td>
						<td>
							<input type="radio" name="a2" value="1"<?php if ($a2==1){ print " checked"; }?> > 1
							<input type="radio" name="a2" value="2"<?php if ($a2==2){ print " checked"; }?> > 2
							<input type="radio" name="a2" value="3"<?php if ($a2==3){ print " checked"; }?> > 3
							<input type="radio" name="a2" value="4"<?php if ($a2==4){ print " checked"; }?> > 4
							<input type="radio" name="a2" value="5"<?php if ($a2==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>人ごみの少なさ</b></td>
						<td>
							<input type="radio" name="a3" value="1"<?php if ($a3==1){ print " checked"; }?> > 1
							<input type="radio" name="a3" value="2"<?php if ($a3==2){ print " checked"; }?> > 2
							<input type="radio" name="a3" value="3"<?php if ($a3==3){ print " checked"; }?> > 3
							<input type="radio" name="a3" value="4"<?php if ($a3==4){ print " checked"; }?> > 4
							<input type="radio" name="a3" value="5"<?php if ($a3==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>見ごたえ</b></td>
						<td>
							<input type="radio" name="a4" value="1"<?php if ($a4==1){ print " checked"; }?> > 1
							<input type="radio" name="a4" value="2"<?php if ($a4==2){ print " checked"; }?> > 2
							<input type="radio" name="a4" value="3"<?php if ($a4==3){ print " checked"; }?> > 3
							<input type="radio" name="a4" value="4"<?php if ($a4==4){ print " checked"; }?> > 4
							<input type="radio" name="a4" value="5"<?php if ($a4==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>バリアフリー</b></td>
						<td>
							<input type="radio" name="a5" value="1"<?php if ($a5==1){ print " checked"; }?> > 1
							<input type="radio" name="a5" value="2"<?php if ($a5==2){ print " checked"; }?> > 2
							<input type="radio" name="a5" value="3"<?php if ($a5==3){ print " checked"; }?> > 3
							<input type="radio" name="a5" value="4"<?php if ($a5==4){ print " checked"; }?> > 4
							<input type="radio" name="a5" value="5"<?php if ($a5==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>コスト</b></td>
						<td>
							<input type="radio" name="a6" value="1"<?php if ($a6==1){ print " checked"; }?> > 1
							<input type="radio" name="a6" value="2"<?php if ($a6==2){ print " checked"; }?> > 2
							<input type="radio" name="a6" value="3"<?php if ($a6==3){ print " checked"; }?> > 3
							<input type="radio" name="a6" value="4"<?php if ($a6==4){ print " checked"; }?> > 4
							<input type="radio" name="a6" value="5"<?php if ($a6==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>アトラクション</b></td>
						<td>
							<input type="radio" name="a7" value="1"<?php if ($a7==1){ print " checked"; }?> > 1
							<input type="radio" name="a7" value="2"<?php if ($a7==2){ print " checked"; }?> > 2
							<input type="radio" name="a7" value="3"<?php if ($a7==3){ print " checked"; }?> > 3
							<input type="radio" name="a7" value="4"<?php if ($a7==4){ print " checked"; }?> > 4
							<input type="radio" name="a7" value="5"<?php if ($a7==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>施設の快適度</b></td>
						<td>
							<input type="radio" name="a8" value="1"<?php if ($a8==1){ print " checked"; }?> > 1
							<input type="radio" name="a8" value="2"<?php if ($a8==2){ print " checked"; }?> > 2
							<input type="radio" name="a8" value="3"<?php if ($a8==3){ print " checked"; }?> > 3
							<input type="radio" name="a8" value="4"<?php if ($a8==4){ print " checked"; }?> > 4
							<input type="radio" name="a8" value="5"<?php if ($a8==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>展示内容</b></td>
						<td>
							<input type="radio" name="a9" value="1"<?php if ($a9==1){ print " checked"; }?> > 1
							<input type="radio" name="a9" value="2"<?php if ($a9==2){ print " checked"; }?> > 2
							<input type="radio" name="a9" value="3"<?php if ($a9==3){ print " checked"; }?> > 3
							<input type="radio" name="a9" value="4"<?php if ($a9==4){ print " checked"; }?> > 4
							<input type="radio" name="a9" value="5"<?php if ($a9==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>催し物の規模</b></td>
						<td>
							<input type="radio" name="a10" value="1"<?php if ($a10==1){ print " checked"; }?> > 1
							<input type="radio" name="a10" value="2"<?php if ($a10==2){ print " checked"; }?> > 2
							<input type="radio" name="a10" value="3"<?php if ($a10==3){ print " checked"; }?> > 3
							<input type="radio" name="a10" value="4"<?php if ($a10==4){ print " checked"; }?> > 4
							<input type="radio" name="a10" value="5"<?php if ($a10==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>雰囲気</b></td>
						<td>
							<input type="radio" name="a11" value="1"<?php if ($a11==1){ print " checked"; }?> > 1
							<input type="radio" name="a11" value="2"<?php if ($a11==2){ print " checked"; }?> > 2
							<input type="radio" name="a11" value="3"<?php if ($a11==3){ print " checked"; }?> > 3
							<input type="radio" name="a11" value="4"<?php if ($a11==4){ print " checked"; }?> > 4
							<input type="radio" name="a11" value="5"<?php if ($a11==5){ print " checked"; }?> > 5
						</td>
			</tr>


				<tr><td align="center" bgcolor="#fof8ff" colspan="2">
				<font size="4"><b>場所をクリックしてください</b></font></td></tr>
				</table>
				<div id="map" style="width: 600px; height:400px;"></div>
				<table border="0" cellspacing="3" cellpadding="3" width="600"  >
				<tr><td align="center" colspan="2">
				<input type="reset" name="submit_reset" value="リセット">
				<input type="submit" name="submit_toko" value="投稿する" onClick="return confirm('この内容で投稿しますか？')">
				<input type="hidden" id="show_x" name="show_x">
				<input type="hidden" id="show_y" name="show_y">
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>