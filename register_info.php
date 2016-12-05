<?php
session_start(); //セッションスタート
//======================================================================
//  ■： 会員詳細情報登録ページ register_info.php  完成
//======================================================================
require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;

if(isset($_SESSION["my_no"])){
	$my_no = $_SESSION["my_no"];
	$gender = $_SESSION["gender"];
	$age = $_SESSION["age"];
}else{
	$access_error = "不正なアクセスです";
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>会員詳細情報</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<script>
		if (window.location.hash == "#_=_") window.location.hash = "";
	</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
	<div id="page">
	<?php
	//-----------------------------------------------------
	// □：テーブルを読んでデータ表示
	//-----------------------------------------------------
	if (isset($_SESSION["my_no"])){
		//-----------------------------------------------------
		// □：友達情報テーブル(friendinfo)からデータを読む
		//-----------------------------------------------------
		$sql = "SELECT gender,age,a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo WHERE no=$1";
		$array = array($my_no);
		$pgsql->query($sql,$array);
		$row = $pgsql->fetch();
		if ($row){
			$age = $row["age"];
			$gender = $row["gender"];
			$a1= $row["a1"];
			$a2= $row["a2"];
			$a3= $row["a3"];
			$a4= $row["a4"];
			$a5= $row["a5"];
			$a6= $row["a6"];
			$a7= $row["a7"];
			$a8= $row["a8"];
		}
	}
	//----------------------------------------	
	// ■ヘッダーの取り込み
	//----------------------------------------	
	require_once("header.php");
	?>
			<?php
			require_once("linkplace.php"); //現在地表示用php
			echo pwd("register_info"); //現在値の表示
			?>
		<div id="contents">
			<!-- #main 本文スペース -->
			<div class="contentswrap">
				<?php
	//----------------------------------------	
	// ■ エラーメッセージがあったら表示
	//----------------------------------------	
				if(strlen($access_error)>0){
					echo $access_error;
					echo "</dvi></dvi></body></html>";
					exit;
				}
				if (strlen($error)>0){
					if($error != "登録が完了しました."){
						echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
					}else{
						echo "登録が完了しました";
						echo "</dvi></div></body></html>";
						exit;
					}
				}
				?>
				<form action="./register_infosubmit.php" method="POST">
				<?php
				if(!isset($_SESSION['fb_access_token'])){
					require_once("statue.php");
				}else{
					$gender = $_SESSION["gender"];
					$age = $_SESSION["age"];
					echo "<input type='hidden' name='gender' value='".$gender."'>";
					echo "<input type='hidden' name='age' value='".$age."'>";
				}?>
				<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
					<tr><div class="label2" align="center">嗜好情報の登録</div></tr>
					<tr>
						<td align="center">
							<div class="label4">項目</div>
						</td>
						<td>1:悪い <------>  5:良い</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">満足度</div>
						</td>
						<td>
							<input type="radio" name="a1" value="1"<?php if ($a1==1){ print " checked"; }?> >1
							<input type="radio" name="a1" value="2"<?php if ($a1==2){ print " checked"; }?> >2
							<input type="radio" name="a1" value="3"<?php if ($a1!=1&&$a1!=2&&$a1!=4&&$a1!=5){ print " checked"; }?> >3
							<input type="radio" name="a1" value="4"<?php if ($a1==4){ print " checked"; }?> >4
							<input type="radio" name="a1" value="5"<?php if ($a1==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">アクセスのしやすさ</div>
						</td>
						<td>
							<input type="radio" name="a2" value="1"<?php if ($a2==1){ print " checked"; }?> >1
							<input type="radio" name="a2" value="2"<?php if ($a2==2){ print " checked"; }?> >2
							<input type="radio" name="a2" value="3"<?php if ($a2!=2&&$a2!=1&&$a2!=4&&$a2!=5){ print " checked"; }?> >3
							<input type="radio" name="a2" value="4"<?php if ($a2==4){ print " checked"; }?> >4
							<input type="radio" name="a2" value="5"<?php if ($a2==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">人混みの少なさ</div>
						</td>
						<td>
							<input type="radio" name="a3" value="1"<?php if ($a3==1){ print " checked"; }?> >1
							<input type="radio" name="a3" value="2"<?php if ($a3==2){ print " checked"; }?> >2
							<input type="radio" name="a3" value="3"<?php if ($a3!=2&&$a3!=1&&$a3!=4&&$a3!=5){ print " checked"; }?> >3
							<input type="radio" name="a3" value="4"<?php if ($a3==4){ print " checked"; }?> >4
							<input type="radio" name="a3" value="5"<?php if ($a3==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">バリアフリー</div>
						</td>
						<td>
							<input type="radio" name="a4" value="1"<?php if ($a4==1){ print " checked"; }?> >1
							<input type="radio" name="a4" value="2"<?php if ($a4==2){ print " checked"; }?> >2
							<input type="radio" name="a4" value="3"<?php if ($a4!=2&&$a4!=1&&$a4!=4&&$a4!=5){ print " checked"; }?> >3
							<input type="radio" name="a4" value="4"<?php if ($a4==4){ print " checked"; }?> >4
							<input type="radio" name="a4" value="5"<?php if ($a4==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">コストパフォーマンス</div>
						</td>
						<td>
							<input type="radio" name="a5" value="1"<?php if ($a5==1){ print " checked"; }?> >1
							<input type="radio" name="a5" value="2"<?php if ($a5==2){ print " checked"; }?> >2
							<input type="radio" name="a5" value="3"<?php if ($a5!=2&&$a5!=1&&$a5!=4&&$a5!=5){ print " checked"; }?> >3
							<input type="radio" name="a5" value="4"<?php if ($a5==4){ print " checked"; }?> >4
							<input type="radio" name="a5" value="5"<?php if ($a5==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">雰囲気</div>
						</td>
						<td>
							<input type="radio" name="a6" value="1"<?php if ($a6==1){ print " checked"; }?> >1
							<input type="radio" name="a6" value="2"<?php if ($a6==2){ print " checked"; }?> >2
							<input type="radio" name="a6" value="3"<?php if ($a6!=2&&$a6!=1&&$a6!=4&&$a6!=5){ print " checked"; }?> >3
							<input type="radio" name="a6" value="4"<?php if ($a6==4){ print " checked"; }?> >4
							<input type="radio" name="a6" value="5"<?php if ($a6==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">快適度/サービスの良さ</div>
						</td>
						<td>
							<input type="radio" name="a7" value="1"<?php if ($a7==1){ print " checked"; }?> >1
							<input type="radio" name="a7" value="2"<?php if ($a7==2){ print " checked"; }?> >2
							<input type="radio" name="a7" value="3"<?php if ($a7!=2&&$a7!=1&&$a7!=4&&$a7!=5){ print " checked"; }?> >3
							<input type="radio" name="a7" value="4"<?php if ($a7==4){ print " checked"; }?> >4
							<input type="radio" name="a7" value="5"<?php if ($a7==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr>
						<td align="center">
							<div class="label2">おすすめ度</div>
						</td>
						<td>
							<input type="radio" name="a8" value="1"<?php if ($a8==1){ print " checked"; }?> >1
							<input type="radio" name="a8" value="2"<?php if ($a8==2){ print " checked"; }?> >2
							<input type="radio" name="a8" value="3"<?php if ($a8!=2&&$a8!=1&&$a8!=4&&$a8!=5){ print " checked"; }?> >3
							<input type="radio" name="a8" value="4"<?php if ($a8==4){ print " checked"; }?> >4
							<input type="radio" name="a8" value="5"<?php if ($a8==5){ print " checked"; }?> >5
						</td>
					</tr>
					<tr><td align="center" colspan="2">
						<input type="submit" name="submit_toroku" value="登録する" ></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
