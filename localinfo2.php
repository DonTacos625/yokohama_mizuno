<?php
//観光スポット推薦システム カテゴリー別観光スポット表示ページ localinfo2.php
session_start();
$my_no = $_SESSION["my_no"];
?>
<?php
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){

	//Postされた値
	$c_check = json_encode($_POST['cate'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

	//観光スポットデータのカテゴリーを便宜上埋める
	$c_checknum =count($c_check);

	if($c_checknum==NULL){
		$error = "カテゴリーが選択されていません";
	}else{
		$sql = "SELECT pk,spot_lng,spot_lat,spot_category,spot_name FROM localinfo WHERE spot_category in ($1) ORDER BY pk ASC"; //観光スポットデータ(localinfo)テーブルから通し番号(pk)昇順に一覧を出力
		$array = array($c_check);
		$pgsql->query($sql,$array);
		$PlaceTable = $pgsql->fetch_all(); //観光スポットデータをPlaceTable配列に格納
	}
}else{
	if(!isset($_SESSION["my_no"])){
		$error="ログインページよりログインしてください";
	}else{
		$error="カテゴリーの選択をお願いします";
	}
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<link rel="stylesheet" type="text/css" href="stylet.css">
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

	var spot = <?php echo json_encode($PlaceTable, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	var urlhttp = "http://";
	var pointpic = "";
	var cat_name = "";
	var spoturl = "";
	var valurl = "https://websitetest1234.herokuapp.com/localinfo3.php?pk=";

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
		 	longitude: spot[i]["spot_lng"],
		 	latitude: spot[i]["spot_lat"]
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

		 if(spot[i]["spot_url"]==""){
		 	spot_url = "なし";
		 }else{
		 	spot_url = urlhttp+spot[i]["spot_url"];
		 }

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
			echo $error;
			echo "</div></body></html>";
			exit;
		}
		require_once("./linkplace.php");
		echo pwd("localinfo2");
		?>
	</div>
	<div id="page">
		<div id="contents">
			<?php
			require_once('left.php');
			?>
		</div>
	</div>
	<div id="viewDiv"></div> <!--地図の表示-->
	<div id="page">
		<div id="contents">
			<div id ="main">
				<div class ="contentswrap">
					<br>
					<p>マーカーの凡例
						<table id="table5932" border="1">
							<tr>
								<td><img src="./marker/purple.png">飲食</td>
								<td><img src="./marker/yellow.png">ショッピング</td>
								<td><img src="./marker/red.png">テーマパーク・公園</td>
							</tr>
							<tr>
								<td><img src="./marker/orange.png">名所・史跡</td>
								<td><img src="./marker/ltblue.png">芸術・博物館</td>
								<td><img src="./marker/blue.png">その他</td>
							</tr>
						</table>
						<style type="text/css"><!-- #table5932{text-align:left;background:#ffffff;border:solid 2px #ff99d6;border-collapse:collapse}#table5932>tbody>tr>td{border:solid 0px #ff99d6;padding:4px;min-width:60px} --></style>
						<br>
					</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>