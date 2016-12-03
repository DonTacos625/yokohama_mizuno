﻿<?php
//観光スポット推薦システム 推薦項目ページ
session_start();
require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;
$my_no = $_SESSION["my_no"];
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>スポット推薦</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<?php //require_once("analysis.php");?>
</head>
<body>
	<div id="page">
		<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("header.php");
		if(!isset($_SESSION["my_no"])){
			echo "ログインページよりログインしてください";
			echo "</div></body></html>";
			exit;
		}
		require_once("./linkplace.php");
		echo pwd("recomend1");
		?>
	</div>
	<div id="page">
		<div id="contents">
			<div id="menuL">
			<?php
				//----------------------------------------
				// ■左バーの取り込み
				//----------------------------------------
			require_once("left.php");
			?>
			</div>
			<div id ="main">
				<div class ="contentswrap">
					<form name="form1" method="post" action="./recomend2.php">
						<ul><h4>観光するグループをお選びください。</h4></ul>
						<ul>
							<p>
								<?php
								echo "<SELECT name='groupvalue'>";
								echo "<OPTION value='0' selected>一人</OPTION>";
								if (isset($_SESSION["my_no"])){
									$sql = "SELECT f1,f2,f3,lo,g11,g12,g13,g14,g15,g16,g17,g18,g21,g22,g23,g24,g25,g26,g27,g28 FROM relationinfo WHERE no=$1";
									$array = array($my_no);
									$pgsql->query($sql,$array);
									$row = $pgsql->fetch();
									if($row){
										if($row['f1']!=0||$row['f2']!=0||$row['f3']!=0)
											echo  "<OPTION value='1'>家族</OPTION>";
										if($row['lo']!=0)
											echo "<OPTION value='2'>恋人</OPTION>";
										if($row['g11']!=0||$row['g12']!=0||$row['g13']!=0||$row['g14']!=0||$row['g15']!=0||$row['g16']!=0||$row['g17']!=0||$row['g18']!=0)
											echo "<OPTION value='3'>友達グループ1</OPTION>";
										if($row['g21']!=0||$row['g22']!=0||$row['g23']!=0||$row['g24']!=0||$row['g25']!=0||$row['g26']!=0||$row['g27']!=0||$row['g28']!=0)
											echo "<OPTION value='4'>友達グループ2</OPTION>";
									}
								}
								echo "</SELECT>";
								?>
							</p>
						</ul>
						<ul><h4>観光スポットのカテゴリーをお選びください。(複数選択可)</h4></ul>
						<ul>
							<p>
								<input type="checkbox" name="categorycheck[]" value="1"> 飲食<br>
								<input type="checkbox" name="categorycheck[]" value="2"> ショッピング<br>
								<input type="checkbox" name="categorycheck[]" value="3"> テーマパーク・公園<br>
								<input type="checkbox" name="categorycheck[]" value="4"> 名所・史跡<br>
								<input type="checkbox" name="categorycheck[]" value="5"> 芸術・博物館<br>
								<input type="checkbox" name="categorycheck[]" value="6"> その他<br>
							</p>
						</ul>
						<ul><h4>重視する項目をお選びください。</h4></ul>
						<ul>
							<p>
								<SELECT name="pointvalue">
									<OPTION value="0" selected>何も重視しない</OPTION>
									<OPTION value="1">満足度</OPTION>
									<OPTION value="2">アクセスのしやすさ</OPTION>
									<OPTION value="3">人混みの少なさ</OPTION>
									<OPTION value="4">バリアフリー</OPTION>
									<OPTION value="5">コストパフォーマンス</OPTION>
									<OPTION value="6">雰囲気</OPTION>
									<OPTION value="7">快適度</OPTION>
									<OPTION value="8">おすすめ度</OPTION>
								</SELECT>
							</p>
							<p>
								<input type="submit" name="Submit" value=" 送信 ">
							</p>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>