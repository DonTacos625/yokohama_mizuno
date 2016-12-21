<?php
//観光スポット推薦システム 推薦項目表示ページ recomand2.php
session_start();
require_once("PostgreSQL.php");
require_once("calcuation.php"); //計算プログラムの読み込み
$pgsql = new PostgreSQL;
$my_no = $_SESSION["my_no"];
?>
<?php
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST["route"])){
		//ここにルーティングを行なう10スポットのデータ受け渡し
	}
	if(isset($_POST["route_submit"])){
		//ルーティング機能。スポットの順番を入れ替える
	}
}else{
	if(!isset($_SESSION["my_no"])){
		$error="ログインページよりログインしてください";
	}else{
		$error="推薦に必要な項目の入力をお願いします";
	}
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylet.css">
	<title>推薦スポット</title>
	<link rel="stylesheet" href="https://js.arcgis.com/4.1/esri/css/main.css">
	<script src="https://js.arcgis.com/4.1/"></script>
	<script>
	//spot[i]["spot_lng"]: spot_lng
	//spot[i]["spot_lat"]: spot_lat
	//spot[i]["spot_category"]: spot_category
	//spot[i]["spot_pic"]: spot_pic
	//spot[i]["spot_content"]: spot_content
	//spot[i]["spot_name"]: spot_name
	//spot[i]["spot_url"]: spot_url

	var spot = <?php echo json_encode($result10place, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
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
		"esri/PopupTemplate",
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
				center: [139.636055, 35.450078],
				container: "viewDiv",
				map: map,
				zoom: 13
			});

		/**********************
		 * Create a point graphic
		 **********************/
		 for(var i=0;i<spot.length;i++){
		 // First create a point geometry (this is the location of the Titanic)
		 var point = new Point({
		 	longitude: parseFloat(spot[i]["spot_lng"]),
		 	latitude: parseFloat(spot[i]["spot_lat"])
		 });

		 if(spot[i]["spot_category"]==1){
		 	cat_name = "飲食";
		 	pointpic = "./marker/purple.png";
		 }else if(spot[i]["spot_category"]==2){
		 	cat_name = "ショッピング";
		 	pointpic = "./marker/yellow.png";
		 }else if(spot[i]["spot_category"]==3){
		 	cat_name = "テーマパーク・公園";
		 	pointpic = "./marker/red.png";
		 }else if(spot[i]["spot_category"]==4){
		 	cat_name = "名所・史跡";
		 	pointpic = "./marker/orange.png";
		 }else if(spot[i]["spot_category"]==5){
		 	cat_name = "芸術・博物館";
		 	pointpic = "./marker/ltblue.png";
		 }else{
		 	cat_name = "その他";
		 	pointpic = "./marker/blue.png";
		 }

		/* if(spot[i]["spot_url"]==""){
		 	spot_url = "なし";
		 }else{
		 	spot_url = urlhttp+spot[i]["spot_url"];
		 }
		 */
		 //	Create contents of popup
		 var lineAtt = {
		 	分類: cat_name,
		 	詳細: valurl+spot[i]["pk"]
		 };


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
		attributes: lineAtt,
			popupTemplate: { // autocasts as new PopupTemplate()
				title: spot[i]["spot_name"],
				content: [{
					type: "fields",
					fieldInfos: [{
						fieldName: "分類"
					},{
						fieldName: "詳細"
					}]
				}]
			}
		});

	// Add the graphics to the view's graphics layer
	view.graphics.addMany([pointGraphic]);
}
});

</script>
</head>
<body>
	<div id="page">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		if(strlen($error)!=0){
			if($error != "選択したグループは登録されていません"){
				echo $error;
			}else{
				echo $error;
				echo "<br><a href='./register_group.php' title='グループ登録'>こちら</a>よりグループの登録をしてください";
			}
			echo "</div></body></html>";
			exit;
		}
		?>
		<div id="contents">
			<div id="menuL">
				<?php
				require_once("left_recomend.php");
				?>
			</div>
			<div id ="main">
				<div class ="contentswrap2">
					<h3>あなたに推薦する観光スポットは</h3>
					<div id="viewDiv"></div>
					<br>
					<table id="table5932" border="1">
						<?php
						$detailurl ="https://study-yokohama-sightseeing.herokuapp.com/localinfo3.php?pk=";
						for($i=0;$i<10;$i=$i+2){
							echo "<tr>";
							$spot_pk = $result10place[$i]['pk'];
							echo "<td><a href=".$detailurl.$spot_pk." target='_blank'>".$result10place[$i]['spot_name']."</a></td>";
							if($result10place[$i+1]["spot_name"]!=NULL)
								$spot_pk = $result10place[$i+1]['pk'];
							echo "<td><a href=".$detailurl.$spot_pk." target='_blank'>".$result10place[$i+1]['spot_name']."</a></td>";
							echo "</tr>";
						}
						?>
					</table>
					<style type="text/css"><!-- #table5932{text-align:left;background:#ffffff;border:solid 2px #ff99d6;border-collapse:collapse}#table5932>tbody>tr>td{border:solid 0px #ff99d6;padding:4px;min-width:60px} --></style>
				</div>
			</div>
		</div>
	</div>
</body>
</html>