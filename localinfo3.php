<?php
session_start();
require_once('PostgreSQL.php');
require_once('calcuation.php');
$pgsql = new PostgreSQL;

// phpの配列をpostgresqlの配列に変換
function toPostgreSqlArray($data)
{
	return '{' . implode(',', $data) . '}';
}

// postgresの配列をphpの配列に変換
function toPhpArray($data)
{
	$data       = str_replace('{', '', $data);
	$data       = str_replace('}', '', $data);
	$array_data = explode(',', $data);

	return $array_data;
}

if(isset($_SESSION["my_no"])){
	$my_no = $_SESSION["my_no"];
	if($_GET['pk']!=NULL){
		$pk=json_decode(json_encode($_GET['pk'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),true);
		if(preg_match('/^([0-9])/', $pk)){
			$sql = "SELECT spot_name,spot_category,spot_pic,spot_visited,spot_url,spot_content,spot_eval FROM localinfo WHERE pk=$1";
			$array = array($pk);
			$pgsql -> query($sql,$array);
			$row = $pgsql->fetch_all();
			if($row){
				$spot_name= $row[0]["spot_name"];
				$spot_category = $row[0]["spot_category"];
				$spot_pic = $row[0]["spot_pic"];
				$spot_visited = $row[0]["spot_visited"];
				$spot_url = $row[0]["spot_url"];
				$spot_content = $row[0]["spot_content"];
				$eval = toPhpArray($row[0]["spot_eval"]);
				$eval_count = count($eval);
				for($i=0;$i<$eval_count;$i++){
					if($eval[$i]==$my_no){
						$evalued = "評価済みです";
					}
				}
			}else{
				$error = "存在しない観光スポット番号が入力されています";
			}
		}else{
			$error = "不正なアクセスです";
		}
	}else{
		$error = "観光スポットが指定されていません";
	}
}else{
	$error = "ログインをお願いします";
}
?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"></meta>
	<title><?php echo $spot_name?> 詳細情報</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="myThumbnail.js"></script>
</head>

<body>
	<div id="page">
		<?php
		require_once('header.php');
		if(strlen($error)!=0){
			echo $error;
			echo "</div></body></html>";
			exit;
		}
		require_once('linkplace.php');
		echo pwd_spot($spot_category,$spot_name);
		?>
		<div id="contents">
			<?php
			require_once('left.php');
			?>
			<div id="main">
				<div class="contentswrap">
					<table border="0" cellspacing="3" cellpadding="3" width="600">
						<tr><td align="center" bgcolor="#fof8ff" colspan="2">
								<font size="4"><b>観光スポットの詳細情報</b></font></td></tr>
						<tr>
							<td align='center' colspan='2'>
							<?php
							if($spot_pic!=NULL){/*
								// オリジナル画像のファイルパスを指定
								$original_file = "https://study-yokohama-sightseeing.herokuapp.com/".$spot_pic;
								echo $original_file;
								// getimagesize関数 オリジナル画像の横幅・高さを取得
								$original = getimagesize($original_file);
								var_dump($original);
								$original_width = $original[0];
								$original_height = $original[1];
								//list($original_width, $original_height) = getimagesize($original_file);

								// サムネイルの横幅を指定
								$thumb_width = 200;

								// サムネイルの高さを算出 round関数で四捨五入
								$thumb_height = round( $original_height * $thumb_width / $original_width );

								// オリジナルファイルの画像リソース
								$original_image = imagecreatefromjpeg($original_file);
								echo "ok";
								// サムネイルの画像リソース
								$thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);
								echo "ok2";
								// サムネイル画像の作成
								imagecopyresampled($thumb_image, $original_image, 0, 0, 0, 0,
								                 $thumb_width, $thumb_height,
								                 $original_width, $original_height);
								echo "ok3";
								// サムネイル画像の出力
								imagejpeg($thumb_image);*/
							}
							?>
							</td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" size="10"><font size="4"><b>スポット名</b></font></td>
							<td><?php echo  $spot_name?></td>
						</tr>
						<tr><td align="center" bgcolor="#fof8ff" size="10"><font size="4"><b>カテゴリー</b></font></td>
							<td>
								<?php
								if($spot_category==1){
									echo "飲食";
								}else if($spot_category==2){
									echo "ショッピング";
								}else if($spot_category==3){
									echo "テーマパーク・公園";
								}else if($spot_category==4){
									echo "名所・史跡";
								}else if($spot_category==5){
									echo "芸術・博物館";
								}else{
									echo "その他";
								}
								?>
							</td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" size="10"><font size="4"><b>紹介文</b></font></td>
							<td><?php echo "$spot_content"?></td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" size="10"><font size="4"><b>参考URL</b></font></td>
							<td>
								<?php
									if($spot_url!=NULL){
										$url = "http://".$spot_url;
										echo "<a href='".$url."'>リンク</a>";
									}else{
										echo "なし";
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" size="10"><font size="4"><b>評価</b></font></td>
							<td>
								<?php
									if($evalued == NULL){
										$valurl = "https://study-yokohama-sightseeing.herokuapp.com/local_evaluation.php?pk=".$pk;
										echo "<a href='".$valurl."'>評価をする</a>";
									}else{
										echo $evalued;
									}
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".thumbnails img").MyThumbnail({ 
		thumbWidth:100, 
		thumbHeight:100,
		bShowPointerCursor:true 
	}); 
});
</script>
</body>
</html>