<?php
//観光スポット推薦システム カテゴリー別観光スポット表示ページ localinfo2.php
session_start();
require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;
$my_no = $_SESSION["my_no"];
?>
<?php
$error="";
	//Postされた値
	if(isset($_SESSION["my_no"])){
		$c_check=json_decode(json_encode($_GET['c_check'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),true);
		if($_GET['c_check']!=NULL){
			if(preg_match('/^([1-6])/', $c_check)){
				$url = "./localinfo.json";
				$json = file_get_contents($url);
				$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
				$arr = json_decode($json,true);

				if ($arr == NULL) {
	   			echo "なにもないよ！";
				}else{
	     		$json_count = count($arr["items"]);
	     		$PlaceTable = array();
	     		$j=0;
	      	for($i=0;$i<$json_count;$i++){
	        	if($c_check==$arr["items"][$i]["spot_category"]){
	        		$PlaceTable[$j]["pk"] = $arr["items"][$i]["pk"];
		         	$PlaceTable[$j]["spot_name"] = $arr["items"][$i]["spot_name"];
		         	$j++;
		         }
		      }
		    }
			}else{
				$error = "不正なアクセスです";
			}
		}else{
		$error = "カテゴリーが選択されていません";
	}
}else{
	$error = "ログインをお願いします";
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title><?php
		if($c_check == 1)
			echo "飲食 スポット一覧";
		else if($c_check == 2)
			echo "ショッピング スポット一覧";
		else if($c_check == 3)
			echo "テーマパーク・公園 スポット一覧";
		else if($c_check == 4)
			echo "名所・史跡 スポット一覧";
		else if($c_check == 5)
			echo  "芸術・博物館スポット一覧";
		else
			echo "その他";
		?></title>
	<link rel="stylesheet" type="text/css" href="stylet.css">
	<?php require_once("analysis.php");?>
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
		if($c_check==1)
			$urlname="localinfo21";
		else if($c_check==2)
			$urlname="localinfo22";
		else if($c_check==3)
			$urlname="localinfo23";
		else if($c_check==4)
			$urlname="localinfo24";
		else if($c_check==5)
			$urlname="localinfo25";
		else
			$urlname="localinfo26";

		echo pwd($urlname);
		?>
	</div>
	<div id="page">
		<div id="contents">
			<div id="menuL">
			<?php
			require_once('left.php');
			?>
			</div>
		</div>
		<div class ="contentswrap">
		<div id ="main">
			<h3>
			<?php
				if($c_check==1)
					echo "飲食";
				else if($c_check==2)
					echo "ショッピング";
				else if($c_check==3)
					echo "テーマパーク・公園";
				else if($c_check==4)
					echo "名所・史跡";
				else if($c_check==5)
					echo "芸術・博物館";
				else
					echo "その他";
			?>　スポット一覧</h3>

				<table id="table5932" border="1">
					<?php
					$detailurl ="https://study-yokohama-sightseeing.herokuapp.com/localinfo3.php?pk=";
					$num = count($PlaceTable);
					for($i=0;$i<$num;$i=$i+3){
						echo "<tr>";
						$spot_pk = $PlaceTable[$i]['pk'];
						echo "<td><a href=".$detailurl.$spot_pk.">".$PlaceTable[$i]['spot_name']."</a></td>";
							if($PlaceTable[$i+1]["spot_name"]!=NULL)
								$spot_pk = $PlaceTable[$i+1]['pk'];
								echo "<td><a href=".$detailurl.$spot_pk.">".$PlaceTable[$i+1]['spot_name']."</a></td>";
							if($PlaceTable[$i+2]["spot_name"]!=NULL)
								$spot_pk = $PlaceTable[$i+2]['pk'];
								echo "<td><a href=".$detailurl.$spot_pk.">".$PlaceTable[$i+2]['spot_name']."</a></td>";
							echo "</tr>";
					}
				?>
				</table>
				<br>
						<style type="text/css"><!-- #table5932{text-align:left;background:#ffffff;border:solid 2px #ff99d6;border-collapse:collapse}#table5932>tbody>tr>td{border:solid 0px #ff99d6;padding:4px;min-width:60px} --></style>
						<br>
				</div>
			</div>
		</div>
	</div>
</body>
</html>