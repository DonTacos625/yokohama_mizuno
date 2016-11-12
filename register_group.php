<?php
session_start(); //セッションスタート
//======================================================================
//  ■： 会員関係情報登録　register_group.php
//======================================================================
require_once("PostgreSQL.php");

//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = "";
$access_error = ""; //アクセスエラー

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$pgsql->query("SELECT MAX(no) AS no FROM friendinfo");
	if ($pgsql->rows()>0) {
		$row = $pgsql->fetch();
		$no = $row['no'];
	}
	$my_no = $_SESSION["my_no"];

	$f1 = 0;	//家族1
	$f2 = 0;	//家族2
	$f3 = 0;	//家族3
	$lo = 0; //恋人
	$g11 = 0; //友達1-1
	$g12 = 0; //友達1-2
	$g13 = 0; //友達1-3
	$g14 = 0; //友達1-4
	$g15 = 0; //友達1-5
	$g16 = 0; //友達1-6
	$g17 = 0; //友達1-7
	$g18 = 0; //友達1-8
	$g21 = 0; //友達2-1
	$g22 = 0; //友達2-2
	$g23 = 0; //友達2-3
	$g24 = 0; //友達2-4
	$g25 = 0; //友達2-5
	$g26 = 0; //友達2-6
	$g27 = 0; //友達2-7
	$g28 = 0; //友達2-8


	/// フォームからデータを受け取る
	//--------------------------------
	$f1 = htmlspecialchars($_POST["f1"], ENT_QUOTES);	//家族1
	$f2 = htmlspecialchars($_POST["f2"], ENT_QUOTES);	//家族2
	$f3 = htmlspecialchars($_POST["f3"], ENT_QUOTES);	//家族3
	$lo = htmlspecialchars($_POST["lo"], ENT_QUOTES); //恋人
	$g11 = htmlspecialchars($_POST["g11"], ENT_QUOTES); //友達1-1
	$g12 = htmlspecialchars($_POST["g12"], ENT_QUOTES); //友達1-2
	$g13 = htmlspecialchars($_POST["g13"], ENT_QUOTES); //友達1-3
	$g14 = htmlspecialchars($_POST["g14"], ENT_QUOTES); //友達1-4
	$g15 = htmlspecialchars($_POST["g15"], ENT_QUOTES); //友達1-5
	$g16 = htmlspecialchars($_POST["g16"], ENT_QUOTES); //友達1-6
	$g17 = htmlspecialchars($_POST["g17"], ENT_QUOTES); //友達1-7
	$g18 = htmlspecialchars($_POST["g18"], ENT_QUOTES); //友達1-8
	$g21 = htmlspecialchars($_POST["g21"], ENT_QUOTES); //友達2-1
	$g22 = htmlspecialchars($_POST["g22"], ENT_QUOTES); //友達2-2
	$g23 = htmlspecialchars($_POST["g23"], ENT_QUOTES); //友達2-3
	$g24 = htmlspecialchars($_POST["g24"], ENT_QUOTES); //友達2-4
	$g25 = htmlspecialchars($_POST["g25"], ENT_QUOTES); //友達2-5
	$g26 = htmlspecialchars($_POST["g26"], ENT_QUOTES); //友達2-6
	$g27 = htmlspecialchars($_POST["g27"], ENT_QUOTES); //友達2-7
	$g28 = htmlspecialchars($_POST["g28"], ENT_QUOTES); //友達2-8


	echo $f1;

	//有効な数字が入力されたかを確認
	if($f1==null){
		$f1=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $f1)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$f1=intval($f1);
			if($f1>$no||$f1==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($f2==null){
		$f2=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $f2)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$f2=intval($f2);
			if($f2>$no||$f2==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($f3==null){
		$f3=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $f3)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$f3=intval($f3);
			if($f3>$no||$f3==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($lo==null){
		$lo=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $lo)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$lo=intval($lo);
			if($lo>$no||$lo==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g11==null){
		$g11=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g11)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g11=intval($g11);
			if($g11>$no||$g11==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g12==null){
		$g12=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g12)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g12=intval($g12);
			if($g12>$no||$g12==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g13==null){
		$g13=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g13)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g13=intval($g13);
			if($g11>$no||$g13==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g14==null){
		$g14=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g14)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g14=intval($g14);
			if($g14>$no||$g14==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g15==null){
		$g15=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g15)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g15=intval($g15);
			if($g15>$no||$g15==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g16==null){
		$g16=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g16)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g16=intval($g16);
			if($g16>$no||$g16==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g17==null){
		$g17=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g17)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g17=intval($g17);
			if($g17>$no||$g17==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g18==null){
		$g18=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g18)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g18=intval($g18);
			if($g18>$no||$g18==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g21==null){
		$g21=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g21)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g21=intval($g21);
			if($g21>$no||$g21==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g22==null){
		$g22=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g22)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g22=intval($g22);
			if($g22>$no||$g22==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g23==null){
		$g23=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g23)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g23=intval($g23);
			if($g23>$no||$g23==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g24==null){
		$g24=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g24)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g24=intval($g24);
			if($g24>$no||$g24==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g25==null){
		$g25=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g25)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g25=intval($g25);
			if($g25>$no||$g25==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g26==null){
		$g26=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g26)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g26=intval($g26);
			if($g26>$no||$g26==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g27==null){
		$g27=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g27)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g27=intval($g27);
			if($g27>$no||$g27==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}
	if($g28==null){
		$g28=0;
	}else{
		if(!preg_match('/^([0-9]{1,3})$/', $g28)){
			$error = "登録されていない番号が入力されています<br>";
		}else{
			$g28=intval($g28);
			if($g28>$no||$g28==$my_no){
				$error = "登録されていない番号又は自分の番号が入力されています<br>";
			}
		}
	}

	if(strlen($error)==0){
		//relationinfoテーブルに会員番号を入力するsql文 テーブルにmy番号がなければ新しくカラムをつくり、あれば更新する
		$sql = "INSERT INTO relationinfo VALUES ('$my_no','$f1','$f2','$f3','$lo','$g11','$g12','$g13','$g14','$g15','$g16','$g17','$g18','$g21','$g22','$g23','$g24','$g25','$g26','$g27','$g28') ON CONFLICT ON CONSTRAINT relationinfo_pkey DO UPDATE SET f1='$f1',f2='$f2',f3='$f3',lo='$lo',g11='$g11',g12='$g12',g13='$g13',g14='$g14',g15='$g15',g16='$g16',g17='$g17',g18='$g18',g21='$g21',g22='$g22',g23='$g23',g24='$g24',g25='$g25',g26='$g26',g27='$g27',g28='$g28'";
		$pgsql->query($sql); //sql送信
		$error = "登録が完了しました.";

		require_once("calcuation.php"); //計算プログラムの読み込み

		//初期化
		$rows = array();
		$databox = array();
		$countrows = 0;
		$family = array(8);

		//家族
		$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in('$my_no','$f1','$f2','$f3')";
		$pgsql->query($sql);
		$rows = $pgsql->fetch_all(); //該当行全て取り出し
		$countrows = count($rows); //行数の確認
		if($countrows>1){ //データの挿入
			for($i=0;$i<$countrows;$i++){
				$databox[$i][0]=floatval($rows[$i]["a1"]);
				$databox[$i][1]=floatval($rows[$i]["a2"]);
				$databox[$i][2]=floatval($rows[$i]["a3"]);
				$databox[$i][3]=floatval($rows[$i]["a4"]);
				$databox[$i][4]=floatval($rows[$i]["a5"]);
				$databox[$i][5]=floatval($rows[$i]["a6"]);
				$databox[$i][6]=floatval($rows[$i]["a7"]);
				$databox[$i][7]=floatval($rows[$i]["a8"]);
			}
			$family=value_calcuation($databox); //見解間距離均等法を用いて評価値を計算
		}else{
			$family=[0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0]; //入力がなければ0を挿入
		}

		//初期化
		$rows = array();
		$databox = array();
		$countrows = 0;
		$lover = array(8);

		//恋人
		$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in('$my_no','$lo')";
		$pgsql->query($sql);
		$rows = $pgsql->fetch_all();
		$countrows = count($rows);
		if($countrows>1){
			$databox = array();
			for($i=0;$i<$countrows;$i++){
				$databox[$i][0]=floatval($rows[$i]["a1"]);
				$databox[$i][1]=floatval($rows[$i]["a2"]);
				$databox[$i][2]=floatval($rows[$i]["a3"]);
				$databox[$i][3]=floatval($rows[$i]["a4"]);
				$databox[$i][4]=floatval($rows[$i]["a5"]);
				$databox[$i][5]=floatval($rows[$i]["a6"]);
				$databox[$i][6]=floatval($rows[$i]["a7"]);
				$databox[$i][7]=floatval($rows[$i]["a8"]);
			}
			$lover=value_calcuation($databox);
		}else{
			$lover=[0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0];
		}

		//初期化
		$rows = array();
		$databox = array();
		$countrows = 0;
		$group1 = array(8);

		//友達グループ1
		$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in('$my_no','$g11','$g12','$g13','$g14','$g15','$g16','$g17','$g18')";
		$pgsql->query($sql);
		$rows = $pgsql->fetch_all();
		$countrows = count($rows);
		if($countrows>1){
			$databox = array();
			for($i=0;$i<$countrows;$i++){
				$databox[$i][0]=floatval($rows[$i]["a1"]);
				$databox[$i][1]=floatval($rows[$i]["a2"]);
				$databox[$i][2]=floatval($rows[$i]["a3"]);
				$databox[$i][3]=floatval($rows[$i]["a4"]);
				$databox[$i][4]=floatval($rows[$i]["a5"]);
				$databox[$i][5]=floatval($rows[$i]["a6"]);
				$databox[$i][6]=floatval($rows[$i]["a7"]);
				$databox[$i][7]=floatval($rows[$i]["a8"]);
			}
			$group1=value_calcuation($databox);
		}else{
			$group1=[0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0];
		}

		//初期化
		$rows = array();
		$databox = array();
		$countrows = 0;
		$group2 = array(8);

		//友達グループ2
		$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in('$my_no','$g21','$g22','$g23','$g24','$g25','$g26','$g27','$g28')";
		$pgsql->query($sql);
		$rows = $pgsql->fetch_all();
		$countrows = count($rows);
		if($countrows>1){
			$databox = array();
			for($i=0;$i<$countrows;$i++){
				$databox[$i][0]=floatval($rows[$i]["a1"]);
				$databox[$i][1]=floatval($rows[$i]["a2"]);
				$databox[$i][2]=floatval($rows[$i]["a3"]);
				$databox[$i][3]=floatval($rows[$i]["a4"]);
				$databox[$i][4]=floatval($rows[$i]["a5"]);
				$databox[$i][5]=floatval($rows[$i]["a6"]);
				$databox[$i][6]=floatval($rows[$i]["a7"]);
				$databox[$i][7]=floatval($rows[$i]["a8"]);
			}
			$group2=value_calcuation($databox);
		}else{
			$group2=[0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0];
		}

		if(!empty($family)||!empty($lover)||!empty($group1)||!empty($group2)){ //評価値があればデータをDBに挿入
			$sql = "INSERT INTO valueinfo VALUES ('$my_no','$family[0]','$family[1]','$family[2]','$family[3]','$family[4]','$family[5]','$family[6]','$family[7]','$lover[0]','$lover[1]','$lover[2]','$lover[3]','$lover[4]','$lover[5]','$lover[6]','$lover[7]','$group1[0]','$group1[1]','$group1[2]','$group1[3]','$group1[4]','$group1[5]','$group1[6]','$group1[7]','$group2[0]','$group2[1]','$group2[2]','$group2[3]','$group2[4]','$group2[5]','$group2[6]','$group2[7]') ON CONFLICT ON CONSTRAINT valueinfo_pkey DO UPDATE SET fa1 ='$famiry[0]',fa2 ='$famiry[1]',fa3 ='$famiry[2]',fa4 ='$famiry[3]',fa5 ='$famiry[4]',fa6 ='$famiry[5]',fa7 ='$famiry[6]',fa8 ='$famiry[7]',loa1 ='$lover[0]',loa2 ='$lover[1]',loa3 ='$lover[2]',loa4 ='$lover[3]',loa5 ='$lover[4]',loa6 ='$lover[5]',loa7 ='$lover[6]',loa8 ='$lover[7]',g1a1 ='$group1[0]',g1a2 ='$group1[1]',g1a3 ='$group1[2]',g1a4 ='$group1[3]',g1a5 ='$group1[4]',g1a6 ='$group1[5]',g1a7 ='$group1[6]',g1a8 ='$group1[7]',g2a1 ='$group2[0]',g2a2 ='$group2[1]',g2a3 ='$group2[2]',g2a4 ='$group2[3]',g2a5 ='$group2[4]',g2a6 ='$group2[5]',g2a7 ='$group2[6]',g2a8 ='$group2[7]'";
			$pgsql->query($sql);
			$sql = "SELECT * FROM valueinfo";
			$pgsql->query($sql);
			$resultrow = $pgsql->fetch_all();
			var_dump($resultrow);
		}
	}
}else{
	if(isset($_SESSION["my_no"])){
		$my_no = $_SESSION["my_no"];
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
	if (!isset($_POST["submit_relation"])&&isset($_SESSION["my_no"])){
		//-----------------------------------------------------
		// □：友達情報テーブル(friendinfo)からデータを読む
		//-----------------------------------------------------
		$pgsql->query("SELECT * FROM relationinfo WHERE no='$my_no'");
		$row = $pgsql->fetch();
		if ($row){
			$f1 = $row["f1"];
			$f2 = $row["f2"];	//家族2
			$f3 = $row["f3"];	//家族3
			$lo = $row["lo"]; //恋人
			$g11 = $row["g11"]; //友達1-1
			$g12 = $row["g12"]; //友達1-2
			$g13 = $row["g13"]; //友達1-3
			$g14 = $row["g14"]; //友達1-4
			$g15 = $row["g15"]; //友達1-5
			$g16 = $row["g16"]; //友達1-6
			$g17 = $row["g17"]; //友達1-7
			$g18 = $row["g18"]; //友達1-8
			$g21 = $row["g21"]; //友達2-1
			$g22 = $row["g22"]; //友達2-2
			$g23 = $row["g23"]; //友達2-3
			$g24 = $row["g24"]; //友達2-4
			$g25 = $row["g25"]; //友達2-5
			$g26 = $row["g26"]; //友達2-6
			$g27 = $row["g27"]; //友達2-7
			$g28 = $row["g28"]; //友達2-8
		}
	}
	//----------------------------------------	
	// ■　ヘッダーの取り込み
	//----------------------------------------	
	//require_once("header.php");
	?>
	<?php
	//----------------------------------------	
	// ■ エラーメッセージがあったら表示
	//----------------------------------------	
	if(strlen($access_error)>0){
		echo $access_error;
		echo "</body></html>";
		exit;
	}
	if (strlen($error)>0){
		if($error != "登録が完了しました."){
			echo "<font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
		}else{
			echo "登録が完了しました";
			echo "<br><center><a href=\"./top.php\">トップページへ</a></center></body></html>";
			exit;
	}
}
?>
<div id="page">
	<div id="head">
		<a href="./index.php">Loginページへ戻る</a>
	</div>
</div>
<div id="page">
	<div id="contents">
		<!-- #main 本文スペース -->
		<div class="contentswrap">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="500px">
			<tr><div class="label" align="center"><font size="4">グループの登録</font><br><font color="red">会員ナンバーを半角数字</font>で入力してください</div>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">家族</div>
				</td>
				<td>
				<input type="text" name="f1" value="<?=$f1 ?>" size="3">
				<input type="text" name="f2" value="<?=$f2 ?>" size="3">
				<input type="text" name="f3" value="<?=$f3 ?>" size="3">
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">恋人</div>
				</td>
				<td>
				<input type="text" name="lo" value="<?=$lo ?>" size="3">
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">友達グループ1</div>
				</td>
				<td>
				<input type="text" name="g11" value="<?=$g11 ?>" size="3">
				<input type="text" name="g12" value="<?=$g12 ?>" size="3">
				<input type="text" name="g13" value="<?=$g13 ?>" size="3">
				<input type="text" name="g14" value="<?=$g14 ?>" size="3">
				<input type="text" name="g15" value="<?=$g15 ?>" size="3">
				<input type="text" name="g16" value="<?=$g16 ?>" size="3">
				<input type="text" name="g17" value="<?=$g17 ?>" size="3">
				<input type="text" name="g18" value="<?=$g18 ?>" size="3">
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffe4e1">
					<div class="label">友達グループ2</div>
				</td>
				<td>
				<input type="text" name="g21" value="<?=$g21 ?>" size="3">
				<input type="text" name="g22" value="<?=$g22 ?>" size="3">
				<input type="text" name="g23" value="<?=$g23 ?>" size="3">
				<input type="text" name="g24" value="<?=$g24 ?>" size="3">
				<input type="text" name="g25" value="<?=$g25 ?>" size="3">
				<input type="text" name="g26" value="<?=$g26 ?>" size="3">
				<input type="text" name="g27" value="<?=$g27 ?>" size="3">
				<input type="text" name="g28" value="<?=$g28 ?>" size="3">
				</td>
			</tr>
			<tr><td align="center" colspan="2">
					<input type="submit" name="submit_relation" value="登録する"></td></tr>
				</table>
		</form>
		</div>
	</div>
</div>
</body>
</html>