<?php
//観光スポット推薦システム 推薦項目ページ
session_start();
require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;
$my_no = $_SESSION["my_no"];
?>
<?php
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){

	//Postされた値
	$relation = intval(htmlspecialchars($_POST["groupvalue"]));
	$c_check = $_POST["categorycheck"];
	$point = intval(htmlspecialchars($_POST["pointvalue"]));
	var_dump($relation);
	var_dump($_POST["categorycheck"]);
	var_dump($point);

	//観光スポットデータのカテゴリーを便宜上埋める
	$c_checknum =count($c_check);

	var_dump($c_check);
	if($c_checknum==NULL){
		$error = "カテゴリーが選択されていません";
	}else{
		for($i=0;$i<$c_checknum;$i++){
			$categorycheck[$i] = intval(htmlspecialchars($c_check[$i]));
		}
		if($c_checkknum<6){
			for($i=$c_checknum;$i<6;$i++){
				$categorycheck[$i]=0;
			}
		}
		var_dump($categorycheck);

		$sql = "SELECT spot_lng,spot_lat,spot_category,spot_pic,spot_content,spot_name,spot_url,spot_a1,spot_a2,spot_a3,spot_a4,spot_a5,spot_a6,spot_a7,spot_a8 FROM localinfo WHERE spot_category in ($1,$2,$3,$4,$5,$6) ORDER BY pk ASC"; //観光スポットデータ(localinfo)テーブルから通し番号(pk)昇順に一覧を出力
		$array = array($categorycheck[0],$categorycheck[1],$categorycheck[2],$categorycheck[3],$categorycheck[4],$categorycheck[5]);
		$pgsql->query($sql,$array);
		$PlaceTable = $pgsql->fetch_all(); //観光スポットデータをPlaceTable配列に格納

		for($i=0;$i<count($PlaceTable);$i++){ //評価値の抜き出し
			$temparray[$i][0] = floatval($PlaceTable[$i]["spot_a1"]);
			$temparray[$i][1] = floatval($PlaceTable[$i]["spot_a2"]);
			$temparray[$i][2] = floatval($PlaceTable[$i]["spot_a3"]);
			$temparray[$i][3] = floatval($PlaceTable[$i]["spot_a4"]);
			$temparray[$i][4] = floatval($PlaceTable[$i]["spot_a5"]);
			$temparray[$i][5] = floatval($PlaceTable[$i]["spot_a6"]);
			$temparray[$i][6] = floatval($PlaceTable[$i]["spot_a7"]);
			$temparray[$i][7] = floatval($PlaceTable[$i]["spot_a8"]);
		}

		//グループの関係性の評価値(valueinfo)から抜き出し
		$array = array($my_no);
		if($relation==1){
			$sql = "SELECT fa1,fa2,fa3,fa4,fa5,fa6,fa7,fa8 FROM valueinfo where no=$1";
		}else if($relation==2){
			$sql = "SELECT loa1,loa2,loa3,loa4,loa5,loa6,loa7,loa8 FROM valueinfo where no=$1";
		}else if($relation==3){
			$sql = "SELECT g1a1,g1a2,g1a3,g1a4,g1a5,g1a6,g1a7,g1a8 FROM valueinfo where no=$1";
		}else if($relation==4){
			$sql = "SELECT g2a1,g2a2,g2a3,g2a4,g2a5,g2a6,g2a7,g2a8 FROM valueinfo where no=$1";
		}else{
			$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no=$1";
		}

		//sql文の送信とデータの取り出し
		$pgsql->query($sql,$array);
		$row = $pgsql->fetch();

		for($i=0;$i<8;$i++){ //キャスト
			$UserTable[$i]=floatval($row[$i]);
		}

		$sortedvalue = simList($UserTable,$temparray);

		if($point==1)
			$pointval = "spot_a1";
		else if($point==2)
			$pointval = "spot_a2";
		else if($point==3)
			$pointval = "spot_a3";
		else if($point==4)
			$pointval = "spot_a4";
		else if($point==5)
			$pointval = "spot_a5";
		else if($point==6)
			$pointval = "spot_a6";
		else if($point==7)
			$pointval = "spot_a7";
		else if($point==8)
			$pointval = "spot_a8";
		else
			$pointval = NULL;

		$resultplace = sort_for_point($sortedvalue,$PlaceTable,$pointval,20); //$point 重視する項目
		$result10place = array_slice($resultplace,0,10);
		var_dump($result10place);
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
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<link rel="stylesheet" type="text/css" href="stylet.css">
	<title>推薦スポット</title>
	<link rel="stylesheet" href="https://js.arcgis.com/4.1/esri/css/main.css">
	<script src="https://js.arcgis.com/4.1/"></script>
  <!--
  <style>
    html,
    body,
    #viewDiv {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
    }
  </style>

  <script>
  //row[0][i]: lng
  //row[1][i]: lat
  //pic[i]:写真の番号
  var spot = new Array(10);
  for(var i = 0;i<spot.length;i++){
    spot[i] = new Array(15);
  }

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
        zoom: 15
      });

      /**********************
       * Create a point graphic
       **********************/
       for(var i=0;i<10;i++){
      // First create a point geometry (this is the location of the Titanic)
      var point = new Point({
        longitude: row[0][i],
        latitude: row[1][i]
      });
      //Create contents of popup
      var lineAtt = {
        Name: s_name[i],
        url: "http://www.yahoo.co.jp/",
        //Length: "3,456 km",
        詳細: "詳細挿入"
      };

  // Create a symbol for drawing the point
    var Symbol = new PictureMarkerSymbol({
      url: spot[i],
      width: "30px",
      height: "30px"
    });

      // Create a graphic and add the geometry and symbol to it
      var pointGraphic = new Graphic({
        geometry: point,
        symbol: Symbol,
        attributes: lineAtt,
        popupTemplate: { // autocasts as new PopupTemplate()
          title: "スポット詳細情報",
          content: [{
            type: "fields",
            fieldInfos: [{
              fieldName: "Name"
            }, {
              fieldName: "url"
            }, {
              fieldName: "詳細"
            }]
          }]
        }
      });

      // Add the graphics to the view's graphics layer
      view.graphics.addMany([pointGraphic]);
    }
  });
</script>-->
</head>
<body>
	<div id="page">
	<div id="header">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		if($error!=NULL){
			echo $error;
			echo "</dvi></div></body></html>";
			exit;
		}
		require_once("./linkplace.php");
		echo pwd("recomend2");
		?>
	</div>
	</div>
	<div id="page">
		<div id="contents">
			<?php
			//require_once('left.php');
			?>
			<div id ="main">
				<div class ="contentswrap">
					<!-- チェックボックスに応じてMarkerが表示/非表示 -->
					<div class="title1">
						<h3>あなたに推薦する観光スポットは</h3>
					</div>
					<ul id="checkboxlist"></ul>
					<div id="map_canvas" style="width:600px; height:400px"></div>
					<br/>
					<p><img src="./mkhan.jpg" width="600" height="150"  hspace="5" vspace="5" align="left" alt="トップロゴ"><br/></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>