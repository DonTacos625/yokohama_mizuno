<?php
session_start(); //セッションスタート
//======================================================================
//  ■： 会員詳細情報登録ページ fb_register.php  完成
//======================================================================
require_once("PostgreSQL.php");

//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = ""; //性別
$access_error = ""; //アクセスエラー

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$my_no = $_SESSION["my_no"];
	$access_error = ""; //アクセスエラー

	// フォームからデータを受け取る
	//--------------------------------
	$gender = htmlspecialchars($_POST['gender']);
	$age = htmlspecialchars($_POST['age']);
	$a1 = intval(htmlspecialchars($_POST['a1']));
	$a2 = intval(htmlspecialchars($_POST['a2']));
	$a3 = intval(htmlspecialchars($_POST['a3']));
	$a4 = intval(htmlspecialchars($_POST['a4']));
	$a5 = intval(htmlspecialchars($_POST['a5']));
	$a6 = intval(htmlspecialchars($_POST['a6']));
	$a7 = intval(htmlspecialchars($_POST['a7']));
	$a8 = intval(htmlspecialchars($_POST['a8']));

	//性別,年齢の入力がなかったらエラー出力
	if(strlen($gender)==0 || strlen($age)==0){
		$error = "年齢又は性別が未入力です.";
	}else{
	//登録クエリを送信
		$sql = "UPDATE friendinfo SET gender=$1, age=$2, a1=$3, a2=$4, a3=$5, a4=$6, a5=$7, a6=$8, a7=$9, a8=$10 WHERE no=$11";
		$array = array($gender,$age,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$my_no);
		$pgsql->query($sql,$array);
		$error = "登録が完了しました.";

		//Sessionの登録
		$_SESSION["gender"] = json_encode((int)$gender);
		$_SESSION["age"] = json_encode((int)$age);
	}
}else{
	if(isset($_SESSION["my_no"])){
		$my_no = $_SESSION["my_no"];
		$gender = $_SESSION["gender"];
		$age = $_SESSION["age"];
	}else{
		$access_error = "不正なアクセスです";
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ユーザ詳細情報登録</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
	<?php
	//-----------------------------------------------------
	// □：登録中ではないときにテーブルを読んでデータ表示
	//-----------------------------------------------------
	if (!isset($_POST["submit_toroku"])&&isset($_SESSION["my_no"])){
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
	<div id="page">
		<div id="head">
			<?php
			require_once("linkplace.php"); //現在地表示用php
			echo pwd("fb_register"); //現在値の表示
			?>
		</div>
	</div>
	<div id="page">
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
				<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
					<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
						<tr><div class="label" align="center">個人ステータスの登録</div></tr>
						<tr>
							<td align="center" ><div class="label">会員番号</div></td>
							<td><font size=5><?=$my_no ?></font></td>
						</tr>
						<tr><td align="center" bgcolor="#ffe4e1"><div class="label">性別</div></td>
							<td>
								<input type="radio" name="gender" value="1"<?php if ($gender!=2){ print " checked"; }?> >男
								<input type="radio" name="gender" value="2"<?php if ($gender==2){ print " checked"; }?> >女
							</td>
						</tr>
						<tr>
							<td align="center" bgcolor="#ffe4e1">
								<div class="label">年代</div>
							</td>
							<td>
								<input type="radio" name="age" value="10"<?php if ($age==10){ print " checked"; }?> >10
								<input type="radio" name="age" value="20"<?php if ($age==20){ print " checked"; }?> >20
								<input type="radio" name="age" value="30"<?php if ($age!=10&&$age!=20&&$age!=40&&$age!=50&$age!=60){ print " checked"; }?> >30
								<input type="radio" name="age" value="40"<?php if ($age==40){ print " checked"; }?> >40
								<input type="radio" name="age" value="50"<?php if ($age==50){ print " checked"; }?> >50
								<input type="radio" name="age" value="60"<?php if ($age==60){ print " checked"; }?> >60以上
							</td>
						</tr>
					</table>
				</table>
				<br>
				<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
					<tr><div class="label2" align="center">嗜好情報の入力</div></tr>
					<tr>
						<td align="center" bgcolor="#ffe4e1">
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
						<td align="center" bgcolor="#ffe4e1">
							<div class="label2">アクセス</div>
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
						<td align="center" bgcolor="#ffe4e1">
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
						<td align="center" bgcolor="#ffe4e1">
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
						<td align="center" bgcolor="#ffe4e1">
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
						<td align="center" bgcolor="#ffe4e1">
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
						<td align="center" bgcolor="#ffe4e1">
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
						<td align="center" bgcolor="#ffe4e1">
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
						<input type="submit" name="submit_toroku" value="登録する"></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
