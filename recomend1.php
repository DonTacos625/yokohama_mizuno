<?php
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

								<SELECT name='groupvalue'>
									<OPTION value='1' selected>家族</OPTION>
									<OPTION value='2'>恋人</OPTION>
									<OPTION value='3'>友達グループ1</OPTION>
									<OPTION value='4'>友達グループ2</OPTION>
									<OPTION value='0'>一人</OPTION>
								</SELECT>
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