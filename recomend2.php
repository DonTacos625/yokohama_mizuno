<?php
	session_start(); //セッションの開始

require_once('PostgreSQL.php');
// table1 観光地のみの類似度が出る

if($_SERVER["REQUEST_METHOD"]=="POST"){


//foreach($_POST[categorycheck] as $value)



//SQL文をセット/////////////////////////////////////////
$sql = "SELECT spot_a1,spot_a2,spot_a3,spot_a4,spot_a5,spot_a6,spot_a7,spot_a8 FROM localinfo where spot_category in('$')";
/////////////////////////////////////////////////////

/* 						　*/
/* カラムのメタデータを取得する 　　*/
/* 						*/

$i = 0;
//echo "<TABLE  border='1' >";
echo "<TR>";

while ($i < mysql_num_fields($quryset)) {

	$meta = mysql_fetch_field($quryset, $i);
	if (!$meta) {
		echo "エラー！<br />\n";
	}
//	echo "<TD>$meta->name";
//	echo "</TD>";
	
	//echo "<pre>カラム名：$meta->name</pre>";
	$i++;

	}
echo "</TR>";
	
/* 						　*/
/* カラムの個々のデータを取得する */
/* 						　*/

//１ループで１行データが取り出され、データが無くなるとループを抜けます。

$PlaceTable=null;
$j=0;
while ($data = mysql_fetch_array($quryset)){
	$PlaceTable[$j] = $data;
	
//	echo cosSim($data,$PlaceTable[0],6,17);	
//    echo "<TR>";
    for($i=0; $i<17; $i++){
        //列１を出力//////////////
//        echo "<TD>" . $data[$i];
//        echo "</TD>";
        //////////////////////////
        
    }
    
//    echo "</TR>";
    

    $j++;
}
//echo "</TABLE>";

//SQL文をセット/////////////////////////////////////////
if($relation==1){
	$sql = "SELECT fa1,fa2,fa3,fa4,fa5,fa6,fa7,fa8 FROM valueinfo where no='$my_no'";
}else if($relation==2){
	$sql = "SELECT loa1,loa2,loa3,loa4,loa5,loa6,loa7,loa8 FROM valueinfo where no='$my_no'";
}else if($relation==3){
	$sql = "SELECT g1a1,g1a2,g1a3,g1a4,g1a5,g1a6,g1a7,g1a8 FROM valueinfo where no='$my_no'";
}else if($relation==4){
	$sql = "SELECT g2a1,g2a2,g2a3,g2a4,g2a5,g2a6,g2a7,g2a8 FROM valueinfo where no='$my_no'";
}else{
	$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no='$my_no'";
}

//列が存在しない時のif文を忘れずに

//sql文の送信とデータの取り出し。
$pgsql->query($sql);
$row = $pgsql->fetch();

$UserTable=null;
$j=0;
while ($data = mysql_fetch_array($quryset)){
	$UserTable[$j] = $data;

//	echo "<TR>";
	for($i=0; $i<20; $i++){
		//列１を出力//////////////
//		echo "<TD>" . $data[$i];
//		echo "</TD>";
		//////////////////////////

	}

//	echo "</TR>";

//	echo cosSim($UserTable[0],$UserTable[$j],6,17);
	$j++;
}

	for($i=0;$i<count($PlaceTable);$i++){ //評価値の抜き出し
		$temparray[$i][0] = $PlaceTable[$i]["spot_a1"];
		$temparray[$i][1] = $PlaceTable[$i]["spot_a2"];
		$temparray[$i][2] = $PlaceTable[$i]["spot_a3"];
		$temparray[$i][3] = $PlaceTable[$i]["spot_a4"];
		$temparray[$i][4] = $PlaceTable[$i]["spot_a5"];
		$temparray[$i][5] = $PlaceTable[$i]["spot_a6"];
		$temparray[$i][6] = $PlaceTable[$i]["spot_a7"];
		$temparray[$i][7] = $PlaceTable[$i]["spot_a8"];
	}

	$sortedvalue = simList($UserTable,$temparray);
	$resultplace = sort_for_point($sortedvalue,$PlaceTable,$point,20); //$point 重視する項目
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>スポット推薦</title>
</head>
<body>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
<script type="text/javascript">


//var temp = <?php echo $temp ?>;

var markerArray = [];
var markerNum = <?php echo $resultNum; ?>;
var currentInfoWindow = null;
var aa = <?php echo $UserTable[$a]; ?>;
//var caAA = [<?php echo $caA2; ?>];
function initialize() {
	var latlng = new google.maps.LatLng(35.450078, 139.636055);
	var myOptions = {
		zoom: 15,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var infoArray = [<?php echo $caA2; ?>];
	var typeArray = [<?php echo $typeA2;?>];
	var infowindow = new google.maps.InfoWindow({
		maxWidth: 300
	});
	var categoryIcons = {
		"名所・旧跡"       　: "http://maps.google.co.jp/mapfiles/ms/icons/orange-dot.png",
		"テーマパーク・公園" : "http://maps.google.co.jp/mapfiles/ms/icons/red-dot.png",
		"風景" 　　　　　　　: "http://maps.google.co.jp/mapfiles/ms/icons/green-dot.png",
		"美術館・博物館"   　: "http://maps.google.co.jp/mapfiles/ms/icons/ltblue-dot.png",
		"ショッピング"     　: "http://maps.google.co.jp/mapfiles/ms/icons/yellow-dot.png",
		"レストラン・カフェ" : "http://maps.google.co.jp/mapfiles/ms/icons/purple-dot.png",
		"その他飲食"         : "http://maps.google.co.jp/mapfiles/ms/icons/pink-dot.png",
		"その他"             : "http://maps.google.co.jp/mapfiles/ms/icons/blue-dot.png"
	};
	for(i=0;i<markerNum;i++){
		var markerOpts = {
        	position: new google.maps.LatLng(infoArray[i][3],infoArray[i][4]),
	        map: map,
		icon:categoryIcons[infoArray[i][5]],
	        visible: false,
		};
		markerArray[i] = new google.maps.Marker(markerOpts);
		var name = infoArray[i][2];
		var usr_no = infoArray[i][0];
		var log_no = infoArray[i][1];
		attachMessage(markerArray[i],name,usr_no,log_no);
	}
 
        function attachMessage(marker, msg) {
		var msg = "<a href = 'http://www.si.is.uec.ac.jp/ike/local_info_read2.php?usr_no="+ usr_no + "&log_no=" + log_no +"'>"+msg;
		google.maps.event.addListener(marker, 'click', function() {
			if(currentInfoWindow) {
				currentInfoWindow.close();
			}
			var info = new google.maps.InfoWindow({
			content: msg
			});
			info.open(marker.getMap(), marker);
			currentInfoWindow = info;
		});
	}

//	var nameArray = ["a","b","c","d","e"];
	var nameArray = [<?php echo $nameA2;?>];
	var checkboxlist = document.getElementById("checkboxlist");
	for(i=1;i<markerNum+1;i++){
		
		var input = document.createElement("input");
		input.type = "checkbox";
		input.id = "cb" + i;
		input.onclick = cb_changed;
		var id = document.createElement("id");
		id.innerHTML = infoArray[i-1][2]+"<br>";
		checkboxlist.appendChild(input);
		checkboxlist.appendChild(id);

	}
	var lat1 = <?php echo $lat; ?>;
	var lng1 = <?php echo $lng; ?>;
	var markerOpts1 = {
		position: new google.maps.LatLng(lat1,lng1),
		map: map,
		title: "現在地",
		visible: true,  // 最初は非表示
		icon:"http://www.si.is.uec.ac.jp/ike/person.png"
	};
	marker1 = new google.maps.Marker(markerOpts1);

}
/*
	function markerChange(id){
		var cb = document.getElementById(id);
		if (cb.checked == true) {
		// チェックボックスがチェックされていればマーカ表示
		markerArray[0].setVisible(true);
		} else {
		// チェックボックスがチェックされていなければ非表示
		marker1.setVisible(false);
		}
	}
*/
	function cb_changed() {
		// checkboxのElementを取得
		var tagArray = []
		for(i=1;i<markerNum+1;i++){
			var cb = document.getElementById("cb"+i);
			tagArray[i] = cb;
		}

		for(i=1;i<markerNum+1;i++){
		      if (tagArray[i].checked == true) {
		        // チェックボックスがチェックされていればマーカ表示
		        markerArray[i-1].setVisible(true);
		      } else {
		        // チェックボックスがチェックされていなければ非表示
		        markerArray[i-1].setVisible(false);
		      }
		}

	}

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44576041-1', 'uec.ac.jp');
  ga('send', 'pageview');

</script>
</head>

<body onload="initialize()">
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