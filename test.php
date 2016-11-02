<?php
// 推薦システム
// $checkboxの中身は配列
  $checkbox = $_REQUEST["chk"];
?>

<?php

require_once('PostgreSQL.php');
$pgsql = new PostgreSQL;
// table1 観光地のみの類似度が出る

$resultNum = 10;

function cosSim($data1 = null, $data2 = null,$minArray=null, $maxArray=null){
  // cosSim関数($data, $data, $minArray, $maxArray) 観光地と個人の嗜好の類似度を計算
  // $data配列[5]～[5+11]ベクトルに使用している要素  full[0-16]
  // $minArray素性の最少ベクトルの配列番号    $maxArray素性の最大ベクトルの配列番号
  $sum=null;
  $sim=null;
  $rd1=null;
  $rd2=null;
  $r1=0;
  $r2=0;
  $deff = $maxArray - $minArray;
  for($i=0; $i < $deff; $i++){
    $sum =  $sum + $data1[$minArray+$i]*$data2[$minArray+$i];
    $r1 = $r1+($data1[$minArray+$i]*$data1[$minArray+$i]);
    $r2 = $r2+($data2[$minArray+$i]*$data2[$minArray+$i]);
  }
  $rd1 = sqrt($r1);
  $rd2 = sqrt($r2);
  if(($rd1 * $rd2)==0){
    $sim=0;
  }else{
  $sim = $sum / ($rd1 * $rd2);
  }
  return $sim;
}//cosSim END

$nameA2  = "";
$latlng2 = "";
$infowin2 = "";
$typeA2 = "";
$caA2 = "";
function simList($data1 = null, $data2 = null){
//$data1[固定] ユーザー
//$data2 PLACE2 次元テーブル
//$data1のユーザーに近い場所リストをテーブルで表示

  //  echo "ユーザー情報表示<br />";
  //  foreach ($data1 as $key => $value){
  //    print $key.'=>'.$value.'<br />';
  //  }

$nameA = array();
$latlng = array();
$infowin = array();
$typeA = array();
$caA = array();
//  echo $data1[1];//ユーザー名表示
//  echo "<br />PlaceID =>作成した類似度 <br />";
  $simU_P=null;
  $sortedPlace=null;

  // $sortedPlace[$key]->類似度 を作成する
  // $sortedPlaceをユーザー情報との類似度でソートする
  foreach ($data2 as $key => $value){//value = data2[$i]
    $simU_P = cosSim($data1,$value,11,22);
    $sortedPlace[$key] = $simU_P;
//    print $key.'=>'.$simU_P.'<br />';
  }
//  echo "<br />PlaceID =>作成した類似度 （ソート後、降順） <br />";
  //ソートを実行
  arsort( $sortedPlace);

//  echo "<TABLE  border='1' >";
//  echo "<TR>";

  global $resultNum, $checkbox;
  $counter = 0;

  foreach ($sortedPlace as $key => $value){
    $temp = $data2[$key];
//    if($counter == $resultNum){
//      break;
//    }
    $counter += 1;
    $nameA[] = $temp[2];
    $typeA[] = $temp[8];
    $latlng[] = $temp[6]. "," .$temp[7];
    $infowin[] = $temp[0].','.$temp[1].'," '.$temp[2].'",'.$temp[6]. ','.$temp[7]. ',"' .$temp[8].'"';
//    echo $nameA[0];
//    echo $latlng;
    if($temp[8] == $checkbox[0] || $temp[8] == $checkbox[1] || $temp[8] == $checkbox[2] || $temp[8] == $checkbox[3] || $temp[8] == $checkbox[4] || $temp[8] == $checkbox[5] || $temp[8] == $checkbox[6] || $temp[8] == $checkbox[7]){
      $caA[] = $temp[0].','.$temp[1].'," '.$temp[2].'",'.$temp[6]. ','.$temp[7]. ',"' .$temp[8].'"';
    }
  }
  global $nameA2, $latlng2, $infowin2, $typeA2, $caA2;
  $nameA2 = '" ' . join($nameA,'"," ') . '"';
  $latlng2 = "[" .join($latlng,"],[") . "]";
  $infowin2 = "[" .join($infowin,"],[") . "]";
  $typeA2 = '"' . join($typeA,'","') . '"';
  $caA2 = "[" .join($caA,"],[") . "]";
}//simList ＥＮＤ


//$a = '"a","b","c","d","e"';
/*
//データベースに接続 //////////////////////////////////////
$con = pg_connect("mysql01.cc.uec.ac.jp", "ikeda","ikeda0801");
/////////////////////////////////////////////////////

//データベースを選択//////////////////////////////////////
mysql_select_db("ikeda", $con);
/////////////////////////////////////////////////////
*/
//SQL文をセット/////////////////////////////////////////
$quryset = pg_query("SELECT * FROM `locationinfo`;");
/////////////////////////////////////////////////////

/*            */
/* カラムのメタデータを取得する 　　*/
/*            */

$i = 0;
//echo "<TABLE  border='1' >";
echo "<TR>";

while ($i < pg_num_fields($quryset)) {
  //field情報の取得
  $meta = pg_fetch_field($quryset, $i);
  if (!$meta) {
    echo "エラー！<br />\n";
  }
//  echo "<TD>$meta->name";
//  echo "</TD>";
  
  //echo "<pre>カラム名：$meta->name</pre>";
  $i++;

  }
echo "</TR>";
  
/*            　*/
/* カラムの個々のデータを取得する */
/*            　*/

//１ループで１行データが取り出され、データが無くなるとループを抜けます。

$PlaceTable=null;
$j=0;
while ($data = pg_fetch_array($quryset)){
  $PlaceTable[$j] = $data;
  $j++;
}
//echo "</TABLE>";

/*
//データベースを選択//////////////////////////////////////
mysql_select_db("ikeda", $con);
/////////////////////////////////////////////////////
*/
//SQL文をセット/////////////////////////////////////////
$quryset = pg_query("SELECT * FROM `friendinfo` order by no;");
/////////////////////////////////////////////////////
/* カラムのメタデータを取得する */
$i = 0;
//echo "<TABLE  border='1' >";
//echo "<TR>";

while ($i < pg_num_fields($quryset)) {

  $meta = pg_fetch_field($quryset, $i);
  if (!$meta) {
    echo "エラー！<br />\n";
  }
//  echo "<TD>$meta->name";
//  echo "</TD>";

  //echo "<pre>カラム名：$meta->name</pre>";
  $i++;

}
//echo "</TR>";

/* カラムの個々のデータを取得する */
//１ループで１行データが取り出され、データが無くなるとループを抜けます。

$UserTable=null;
$j=0;
while ($data = pg_fetch_array($quryset)){
  $UserTable[$j] = $data;
  $j++;
}
//asort($UserTable);

//echo "</TABLE>";


/* ソート　*/
// $UserTable[]
// $PlaceTable[]

//echo '<br />';
//echo "Place-User 類似度<br />\n";

//print_r( $UserTable[0] );
//print_r( $UserTable[1] );

//echo cosSim($PlaceTable[0],$UserTable[1]);
$max = count($UserTable);
$a = $usr_no - 1;
//print_r($UserTable[$a]);
simList($UserTable[$a],$PlaceTable);

?>
<?php
  $lat = $_REQUEST["lat"];
  $lng = $_REQUEST["lng"];
?>

<!DOCTYPE html>
<html>
<head>
<!--ピクチャレイヤを重ねる-->
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
  <title>Get started with graphics - 4.1</title>

  <link rel="stylesheet" href="https://js.arcgis.com/4.1/esri/css/main.css">
  <script src="https://js.arcgis.com/4.1/"></script>

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
  var row = new Array(2);
  for(var i = 0;i<row.length;i++){
    row[i] = new Array(10);
  }
  var pic = new Array(10);
  for(var i=0;i<2;i++){
    row[0][i] = <?php echo row["lng"];?>;
    row[1][i] = <?php echo row["lat"];?>;
    pic[i] = <?php echo row["pic"]?>;
  }
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
      PictureMarkerSymbol
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
      for(var i=0;i<2;i++){
      // First create a point geometry (this is the location of the Titanic)
      var point = new Point({
        longitude: row[0][i],
        latitude: row[1][i]
      });

  // Create a symbol for drawing the point
    if(pic[i]==1){
      var Symbol = new PictureMarkerSymbol({
        url: "https://webapps-cdn.esri.com/Apps/MegaMenu/img/logo.jpg",
        width: "30px",
        height: "30px"
		  });
    }else{
      var Symbol = new PictureMarkerSymbol({
        url: "http://4.bp.blogspot.com/-N6MkN70baI0/V7kyE0lYlUI/AAAAAAAA9Ks/Kowo0Av3j6QAVT1M62fPUrd738agCY8GwCLcB/s800/message_congratulations.png",
        width: "30px",
        height: "30px"
		  });
    }

      // Create a graphic and add the geometry and symbol to it
      var pointGraphic = new Graphic({
        geometry: point,
        symbol: Symbol
      });

      // Add the graphics to the view's graphics layer
      view.graphics.addMany([pointGraphic]);
      }
    });
  </script>
</head>

<body>
  <div id="viewDiv"></div>
</body>

</html>