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
						$sql = "SELECT spot_lng,spot_lat,spot_name,spot_category,spot_pic,spot_visited,spot_url,spot_content,spot_eval FROM localinfo WHERE pk=$1";
						$array = array($pk);
			$pgsql -> query($sql,$array);
			$row = $pgsql->fetch_all();
			if($row){
				$spot_lng = (float)$row[0]["spot_lng"];
				$spot_lat = (float)$row[0]["spot_lat"];
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
						$evalued = "レビュー済み";
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
	<link rel="stylesheet" href="https://js.arcgis.com/4.1/esri/css/main.css">
	<script src="https://js.arcgis.com/4.1/"></script>
	<script>
		var spot_lng = <? echo $spot_lng?>;
		var spot_lat = <? echo $spot_lat?>;
		var spot_category =<? echo $spot_category?>;
		var urlhttp = "http://";
		var pointpic = "";
		var cat_name = "";
		var spoturl = "";
		var valurl = "https://study-yokohama-sightseeing.herokuapp.com/localinfo3.php?pk=";
		require([
			"esri/Map",
			"esri/views/MapView",
			"esri/Graphic",
			"esri/geometry/Point",
			"esri/symbols/PictureMarkerSymbol",
			"dojo/domReady!"
			], function(
				Map, MapView,
				Graphic, Point,
				PictureMarkerSymbol,
				PopupTemplate
				) {

				var map = new Map({
					basemap: "streets"
				});

				var view = new MapView({
					center: [spot_lng, spot_lat],
					container: "viewDiv2",
					map: map,
					zoom: 15
				});

		/**********************
		 * Create a point graphic
		 **********************/
		 // First create a point geometry (this is the location of the Titanic)
		 var point = new Point({
		 	longitude: spot_lng,
		 	latitude: spot_lat
		 });

		 if(spot_category==1){
		 	cat_name = "飲食";
		 	pointpic = "./marker/purple.png";
		 }else if(spot_category==2){
		 	cat_name = "ショッピング";
		 	pointpic = "./marker/yellow.png";
		 }else if(spot_category==3){
		 	cat_name = "テーマパーク・公園";
		 	pointpic = "./marker/red.png";
		 }else if(spot_category==4){
		 	cat_name = "名所・史跡";
		 	pointpic = "./marker/orange.png";
		 }else if(spot_category==5){
		 	cat_name = "芸術・博物館";
		 	pointpic = "./marker/ltblue.png";
		 }else{
		 	cat_name = "その他";
		 	pointpic = "./marker/blue.png";
		 }

	 // Create a symbol for drawing the point
	 var Symbol = new PictureMarkerSymbol({
	 	url: pointpic,
	 	width: "30px",
	 	height: "30px"
	 });

	// Create a graphic and add the geometry and symbol to it
	var pointGraphic = new Graphic({
		geometry: point,
		symbol: Symbol,
	});

	// Add the graphics to the view's graphics layer
	view.graphics.addMany([pointGraphic]);
});

</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
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
			<div id="menuL">
				<?php
				require_once('left.php');
				?>
			</div>
			<div id="main">
				<div class="contentswrap">
					<table border="0" cellspacing="3" cellpadding="3" width="600">
						<tr><td align="center" bgcolor="#fof8ff" colspan="2"><font size="4"><b>観光スポットの詳細情報</b></font></td></tr>
						<tr>
							<td align='center' width="300"><div id="viewDiv2"></div></td>
							<td align='center' width="300">
								<?php
								if($spot_pic!=NULL){
									echo "<img src='thumbnail.php?url=".$spot_pic."&width=300' alt='".$spot_name."'>";
								}else{
									echo "<img src='./uploaded_pic/no_image.jpg' alt='写真なし'>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" width="100"><font size="4"><b>スポット名</b></font></td>
							<td><?php echo  $spot_name?></td>
						</tr>
						<tr><td align="center" bgcolor="#fof8ff" width="100"><font size="4"><b>カテゴリー</b></font></td>
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
							<td align="center" bgcolor="#fof8ff" width="100"><font size="4"><b>紹介文</b></font></td>
							<td><?php echo "$spot_content"?></td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" width="100"><font size="4"><b>参考URL</b></font></td>
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
							<td align="center" bgcolor="#fof8ff" width="100"><font size="4"><b>レビュー</b></font></td>
							<td>
								<?php
								if($evalued == NULL){
									$valurl = "https://study-yokohama-sightseeing.herokuapp.com/local_evaluation.php?pk=".$pk;
									echo "<a href='".$valurl."'>レビューをする</a>";
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
</body>
</html>