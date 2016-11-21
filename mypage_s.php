<?php
//======================================================================
//  ■：マイページ画面 mypage.php
//======================================================================
//----------------------------------------	
// ■　共通　require_once
//----------------------------------------	
require_once("com_require.php");
//=====================================================================
// ■　H T M L
//=====================================================================
?>

<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<!-- <link rel="stylesheet" type="text/css" href="stylet_s.css"></link> -->
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title><?=$my_id ?> マイページ[ホーム]</title>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&hl=ja"></script>
<script type="text/javascript">
// <![CDATA[
$(function(){
  // JSONファイル読み込み開始
  $.ajax({
    url:"map2.json",
    cache:false,
    dataType:"json",
    success:function(json){
      var data=jsonRequest(json);
      initialize(data);
    }
  });
});

// JSONファイル読み込み完了
function jsonRequest(json){
  var data=[];
  if(json.Marker){
    var n=json.Marker.length;
    for(var i=0;i<n;i++){
      data.push(json.Marker[i]);
    }
  }
  return data;
}

var categoryIcons = {
  "名所・旧跡"       　: "http://maps.google.co.jp/mapfiles/ms/icons/orange-dot.png",
  "テーマパーク・公園" : "http://maps.google.co.jp/mapfiles/ms/icons/red-dot.png",
  "風景" 　　　　　　　: "http://maps.google.co.jp/mapfiles/ms/icons/green-dot.png",
  "美術館・博物館"   　: "http://maps.google.co.jp/mapfiles/ms/icons/ltblue-dot.png",
  "ショッピング"     　: "http://maps.google.co.jp/mapfiles/ms/icons/yellow-dot.png",
  "レストラン・カフェ" : "http://maps.google.co.jp/mapfiles/ms/icons/purple-dot.png",
  "その他飲食"         : "http://maps.google.co.jp/mapfiles/ms/icons/pink-dot.png",
  "その他"             : "http://maps.google.co.jp/mapfiles/ms/icons/blue-dot.png",
}

// マップを生成して、複数のマーカーを追加
var currentInfoWindow = null;

function initialize(data) {
	// Mapクラスを生成
	// MapOptionsオブジェクトの設定して、Mapクラスの引数に指定します。
	var op = {
		zoom: 15,
		center: new google.maps.LatLng(35.457917,139.632314),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), op);

	//infowindowはひとつだけ。
	//var infowindow = new google.maps.InfoWindow();

	var i=data.length;
	
	while(i-- >0){
		var dat=data[i];
		var obj={
			position:new google.maps.LatLng(dat.lat,dat.lng),
			map:map,
			icon:categoryIcons[dat.type]
		};
		var marker = new google.maps.Marker(obj);
		attachMessage(marker, dat.info_title,dat.pic,dat.no,dat.info_logno);
	}
}
function attachMessage(marker, msg,pic,usr_no,log_no) {
	var gazou = "<img src= \"./image/" + pic +"\" width=\"150\" height=\"150\" alt=\"画像はありません\">";
	google.maps.event.addListener(marker, 'click', function() {
		if(currentInfoWindow) {
			currentInfoWindow.close();
		}
		var info = new google.maps.InfoWindow({
		content:  "<a href='http://www.si.is.uec.ac.jp/ike/local_info_read2_s.php?usr_no="+ usr_no + "&log_no=" + log_no +"'>"+msg+"</a><br />"+
		gazou   ,
		});
		info.open(marker.getMap(), marker);
		currentInfoWindow = info;
	});
}

</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35307381-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
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
<body>
<div id="page">
		<?php
			//----------------------------------------	
			// ■　ヘッダーの取り込み
			//----------------------------------------	
			require_once("header_s.php");
			//----------------------------------------	
			// ■　エラーメッセージがあったら表示
			//----------------------------------------	
		?>
	<div id="contents"> 
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
		<?php
		//----------------------------------------	
		// ■　左バーの取り込み
		//----------------------------------------	
//		require_once("left.php");
		//----------------------------------------	
		// ■　右表示エリア
		//----------------------------------------	
		?>
		 <div id="main">
			<!-- #main 本文スペース -->
			 <div class="contentswrap"> 
				<div class="title1">	
					横浜みなとみらい観光支援システム</div>
					<p class="subh">
					
					目的
					サイトマップ


					Webサイトの目的</br>
					研究用途で構築し，目的は観光回遊行動を支援のための観光情報の共有と推薦になります。</br></br>
					使い方</br>
					様々な観光スポットの情報・評価を皆様には掲載していただき，観光スポットの推薦をすることがメインになります。
					また，「知らなかった」「行きたい」ボタンの機能により，どのような情報に注目されているを判断するために利用します。
					特に掲載する情報を持ってないというユーザは主にこの二つのボタンをクリックしていただければと思っています。</br></br>
					
					設定がわからない方は作成者（池田宰）までご連絡ください。</br>
					下の図はサンプル情報になります。
					</p>
				
				<div id="map_canvas" style="width:100%; height:400"></div>
					<p><img src="./mkhan2.jpg" width="80%" height="100"  hspace="5" vspace="5" align="left" alt="トップロゴ"><br/></p>
			</div> 
		</div>
	</div>
</div>
</body>
</html>