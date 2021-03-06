<?php
session_start(); //セッションスタート
//======================================================================
//  ■： 会員関係情報登録　register_group.php　完成
//======================================================================
require_once("PostgreSQL.php");

//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = "";
$error1 = "";
$error2 = "";
$error3 = "";
$access_error = ""; //アクセスエラー

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if(isset($_POST["submit_relation"])){
		$pgsql->query_null("SELECT MAX(no) AS no FROM friendinfo");
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

		//echo gettype($f1); //string
		//echo gettype($my_no); //string


		//有効な数字が入力されたかを確認
		if($f1!=NULL){
			if(!preg_match('/^([0-9])/', $f1))
				$error = "半角数字以外が入力されています<br>";
			else if($f1==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($f1>$no||!preg_match('/^([0-9]{1,4})$/', $f1))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$f1=intval($f1);
		}
		if($f2!=NULL){
			if(!preg_match('/^([0-9])/', $f2))
				$error = "半角数字以外が入力されています<br>";
			else if($f2==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($f2>$no||!preg_match('/^([0-9]{1,4})$/', $f2))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$f2=intval($f2);
		}
		if($f3!=NULL){
			if(!preg_match('/^([0-9])/', $f3))
				$error = "半角数字以外が入力されています<br>";
			else if($f3==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($f3>$no||!preg_match('/^([0-9]{1,4})$/', $f3))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$f3=intval($f3);
		}
		if($lo!=NULL){
			if(!preg_match('/^([0-9])/', $lo))
				$error = "半角数字以外が入力されています<br>";
			else if($lo==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($lo>$no||!preg_match('/^([0-9]{1,4})$/', $lo))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$lo=intval($lo);
		}
		if($g11!=NULL){
			if(!preg_match('/^([0-9])/', $g11))
				$error = "半角数字以外が入力されています<br>";
			else if($g11==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g11>$no||!preg_match('/^([0-9]{1,4})$/', $g11))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g11=intval($g11);
		}
		if($g12!=NULL){
			if(!preg_match('/^([0-9])/', $g12))
				$error = "半角数字以外が入力されています<br>";
			else if($g12==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g12>$no||!preg_match('/^([0-9]{1,4})$/', $g12))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g12=intval($g12);
		}
		if($g13!=NULL){
			if(!preg_match('/^([0-9])/', $g13))
				$error = "半角数字以外が入力されています<br>";
			else if($g13==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g13>$no||!preg_match('/^([0-9]{1,4})$/', $g13))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g13=intval($g13);
		}
		if($g14!=NULL){
			if(!preg_match('/^([0-9])/', $g14))
				$error = "半角数字以外が入力されています<br>";
			else if($g14==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g14>$no||!preg_match('/^([0-9]{1,4})$/', $g14))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g14=intval($g14);
		}
		if($g15!=NULL){
			if(!preg_match('/^([0-9])/', $g15))
				$error = "半角数字以外が入力されています<br>";
			else if($g15==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g15>$no||!preg_match('/^([0-9]{1,4})$/', $g15))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g15=intval($g15);
		}
		if($g15!=NULL){
			if(!preg_match('/^([0-9])/', $g15))
				$error = "半角数字以外が入力されています<br>";
			else if($g15==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g15>$no||!preg_match('/^([0-9]{1,4})$/', $g15))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g15=intval($g15);
		}
		if($g16!=NULL){
			if(!preg_match('/^([0-9])/', $g16))
				$error = "半角数字以外が入力されています<br>";
			else if($g16==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g16>$no||!preg_match('/^([0-9]{1,4})$/', $g16))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g16=intval($g16);
		}
		if($g17!=NULL){
			if(!preg_match('/^([0-9])/', $g17))
				$error = "半角数字以外が入力されています<br>";
			else if($g17==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g17>$no||!preg_match('/^([0-9]{1,4})$/', $g17))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g17=intval($g17);
		}
		if($g18!=NULL){
			if(!preg_match('/^([0-9])/', $g18))
				$error = "半角数字以外が入力されています<br>";
			else if($g18==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g18>$no||!preg_match('/^([0-9]{1,4})$/', $g18))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g18=intval($g18);
		}
		if($g21!=NULL){
			if(!preg_match('/^([0-9])/', $g21))
				$error = "半角数字以外が入力されています<br>";
			else if($g21==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g21>$no||!preg_match('/^([0-9]{1,4})$/', $g21))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g21=intval($g21);
		}
		if($g22!=NULL){
			if(!preg_match('/^([0-9])/', $g22))
				$error = "半角数字以外が入力されています<br>";
			else if($g22==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g22>$no||!preg_match('/^([0-9]{1,4})$/', $g22))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g22=intval($g22);
		}
		if($g23!=NULL){
			if(!preg_match('/^([0-9])/', $g23))
				$error = "半角数字以外が入力されています<br>";
			else if($g23==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g23>$no||!preg_match('/^([0-9]{1,4})$/', $g23))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g23=intval($g23);
		}
		if($g24!=NULL){
			if(!preg_match('/^([0-9])/', $g24))
				$error = "半角数字以外が入力されています<br>";
			else if($g24==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g24>$no||!preg_match('/^([0-9]{1,4})$/', $g24))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g24=intval($g24);
		}
		if($g25!=NULL){
			if(!preg_match('/^([0-9])/', $g25))
				$error = "半角数字以外が入力されています<br>";
			else if($g25==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g25>$no||!preg_match('/^([0-9]{1,4})$/', $g25))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g25=intval($g25);
		}
		if($g26!=NULL){
			if(!preg_match('/^([0-9])/', $g26))
				$error = "半角数字以外が入力されています<br>";
			else if($g26==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g26>$no||!preg_match('/^([0-9]{1,4})$/', $g26))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g26=intval($g26);
		}
		if($g27!=NULL){
			if(!preg_match('/^([0-9])/', $g27))
				$error = "半角数字以外が入力されています<br>";
			else if($g27==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g27>$no||!preg_match('/^([0-9]{1,4})$/', $g27))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g27=intval($g27);
		}
		if($g28!=NULL){
			if(!preg_match('/^([0-9])/', $g28))
				$error = "半角数字以外が入力されています<br>";
			else if($g28==$my_no)
				$error1 = "自分の番号が入力されています<br>";
			else if($g28>$no||!preg_match('/^([0-9]{1,4})$/', $g28))
				$error2 = "登録されていない番号が入力されています<br>";
			else
				$g28=intval($g28);
		}

		if($f1!=NULL){
			if($f2!=NULL&&$f1==$f2)
				$error3 = "同じ番号が入力されています<br>";
			if($f3!=NULL&&$f1==$f3)
				$error3 = "同じ番号が入力されています<br>";
		}
		if($f2!=NULL&&$f3!=NULL&&$f2==$f3)
			$error3 = "同じ番号が入力されています<br>";

		if($g11!=NULL){
			if($g12!=NULL&&$g11==$g12)
				$error3 = "同じ番号が入力されています<br>";
			if($g13!=NULL&&$g11==$g13)
				$error3 = "同じ番号が入力されています<br>";
			if($g14!=NULL&&$g11==$g14)
				$error3 = "同じ番号が入力されています<br>";
			if($g15!=NULL&&$g11==$g15)
				$error3 = "同じ番号が入力されています<br>";
			if($g16!=NULL&&$g11==$g16)
				$error3 = "同じ番号が入力されています<br>";
			if($g17!=NULL&&$g11==$g17)
				$error3 = "同じ番号が入力されています<br>";
			if($g18!=NULL&&$g11==$g18)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g12!=NULL){
			if($g13!=NULL&&$g12==$g13)
				$error3 = "同じ番号が入力されています<br>";
			if($g14!=NULL&&$g12==$g14)
				$error3 = "同じ番号が入力されています<br>";
			if($g15!=NULL&&$g12==$g15)
				$error3 = "同じ番号が入力されています<br>";
			if($g16!=NULL&&$g12==$g16)
				$error3 = "同じ番号が入力されています<br>";
			if($g17!=NULL&&$g12==$g17)
				$error3 = "同じ番号が入力されています<br>";
			if($g18!=NULL&&$g12==$g18)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g13!=NULL){
			if($g14!=NULL&&$g13==$g14)
				$error3 = "同じ番号が入力されています<br>";
			if($g15!=NULL&&$g13==$g15)
				$error3 = "同じ番号が入力されています<br>";
			if($g16!=NULL&&$g13==$g16)
				$error3 = "同じ番号が入力されています<br>";
			if($g17!=NULL&&$g13==$g17)
				$error3 = "同じ番号が入力されています<br>";
			if($g18!=NULL&&$g13==$g18)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g14!=NULL){
			if($g15!=NULL&&$g14==$g15)
				$error3 = "同じ番号が入力されています<br>";
			if($g16!=NULL&&$g14==$g16)
				$error3 = "同じ番号が入力されています<br>";
			if($g17!=NULL&&$g14==$g17)
				$error3 = "同じ番号が入力されています<br>";
			if($g18!=NULL&&$g14==$g18)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g15!=NULL){
			if($g16!=NULL&&$g15==$g16)
				$error3 = "同じ番号が入力されています<br>";
			if($g17!=NULL&&$g15==$g17)
				$error3 = "同じ番号が入力されています<br>";
			if($g18!=NULL&&$g15==$g18)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g16!=NULL){
			if($g17!=NULL&&$g16==$g17)
				$error3 = "同じ番号が入力されています<br>";
			if($g18!=NULL&&$g16==$g18)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g17!=NULL&&$g18!=NULL&&$g17==$g18)
			$error3 = "同じ番号が入力されています<br>";

		if($f1!=NULL){
			if($f2!=NULL&&$f1==$f2)
				$error3 = "同じ番号が入力されています<br>";
			if($f3!=NULL&&$f1==$f3)
				$error3 = "同じ番号が入力されています<br>";
		}
		if($f2!=NULL&&$f3!=NULL&&$f2==$f3)
			$error3 = "同じ番号が入力されています<br>";

		if($g21!=NULL){
			if($g22!=NULL&&$g21==$g22)
				$error3 = "同じ番号が入力されています<br>";
			if($g23!=NULL&&$g21==$g23)
				$error3 = "同じ番号が入力されています<br>";
			if($g24!=NULL&&$g21==$g24)
				$error3 = "同じ番号が入力されています<br>";
			if($g25!=NULL&&$g21==$g25)
				$error3 = "同じ番号が入力されています<br>";
			if($g26!=NULL&&$g21==$g26)
				$error3 = "同じ番号が入力されています<br>";
			if($g27!=NULL&&$g21==$g27)
				$error3 = "同じ番号が入力されています<br>";
			if($g28!=NULL&&$g21==$g28)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g22!=NULL){
			if($g23!=NULL&&$g22==$g23)
				$error3 = "同じ番号が入力されています<br>";
			if($g24!=NULL&&$g22==$g24)
				$error3 = "同じ番号が入力されています<br>";
			if($g25!=NULL&&$g22==$g25)
				$error3 = "同じ番号が入力されています<br>";
			if($g26!=NULL&&$g22==$g26)
				$error3 = "同じ番号が入力されています<br>";
			if($g27!=NULL&&$g22==$g27)
				$error3 = "同じ番号が入力されています<br>";
			if($g28!=NULL&&$g22==$g28)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g23!=NULL){
			if($g24!=NULL&&$g23==$g24)
				$error3 = "同じ番号が入力されています<br>";
			if($g25!=NULL&&$g23==$g25)
				$error3 = "同じ番号が入力されています<br>";
			if($g26!=NULL&&$g23==$g26)
				$error3 = "同じ番号が入力されています<br>";
			if($g27!=NULL&&$g23==$g27)
				$error3 = "同じ番号が入力されています<br>";
			if($g28!=NULL&&$g23==$g28)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g24!=NULL){
			if($g25!=NULL&&$g24==$g25)
				$error3 = "同じ番号が入力されています<br>";
			if($g26!=NULL&&$g24==$g26)
				$error3 = "同じ番号が入力されています<br>";
			if($g27!=NULL&&$g24==$g27)
				$error3 = "同じ番号が入力されています<br>";
			if($g28!=NULL&&$g24==$g28)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g25!=NULL){
			if($g26!=NULL&&$g25==$g26)
				$error3 = "同じ番号が入力されています<br>";
			if($g27!=NULL&&$g25==$g27)
				$error3 = "同じ番号が入力されています<br>";
			if($g28!=NULL&&$g25==$g28)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g26!=NULL){
			if($g27!=NULL&&$g26==$g27)
				$error3 = "同じ番号が入力されています<br>";
			if($g28!=NULL&&$g26==$g28)
				$error3 = "同じ番号が入力されています<br>";
		}

		if($g27!=NULL&&$g28!=NULL&&$g27==$g28)
			$error3 = "同じ番号が入力されています<br>";

		if(strlen($error)==0&&strlen($error1)==0&&strlen($error2)==0&&strlen($error3)==0){
			if($f1==NULL)
				$f1=0;
			if($f2==NULL)
				$f2=0;
			if($f3==NULL)
				$f3=0;
			if($lo==NULL)
				$lo=0;
			if($g11==NULL)
				$g11=0;
			if($g12==NULL)
				$g12=0;
			if($g13==NULL)
				$g13=0;
			if($g14==NULL)
				$g14=0;
			if($g15==NULL)
				$g15=0;
			if($g16==NULL)
				$g16=0;
			if($g17==NULL)
				$g17=0;
			if($g18==NULL)
				$g18=0;
			if($g21==NULL)
				$g21=0;
			if($g22==NULL)
				$g22=0;
			if($g23==NULL)
				$g23=0;
			if($g24==NULL)
				$g24=0;
			if($g25==NULL)
				$g25=0;
			if($g26==NULL)
				$g26=0;
			if($g27==NULL)
				$g27=0;
			if($g28==NULL)
				$g28=0;

			//relationinfoテーブルに会員番号を入力するsql文 テーブルにmy番号がなければ新しくカラムをつくり、あれば更新する
			$sql = "INSERT INTO relationinfo VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21) ON CONFLICT ON CONSTRAINT relationinfo_pkey DO UPDATE SET f1=$2,f2=$3,f3=$4,lo=$5,g11=$6,g12=$7,g13=$8,g14=$9,g15=$10,g16=$11,g17=$12,g18=$13,g21=$14,g22=$15,g23=$16,g24=$17,g25=$18,g26=$19,g27=$20,g28=$21";
			$array = array($my_no,$f1,$f2,$f3,$lo,$g11,$g12,$g13,$g14,$g15,$g16,$g17,$g18,$g21,$g22,$g23,$g24,$g25,$g26,$g27,$g28);
			$pgsql->query($sql,$array); //sql送信
			$error = "登録が完了しました.";
			$error1 = "登録が完了しました.";
			$error2 = "登録が完了しました.";
			$error3 = "登録が完了しました.";

			require_once("calcuation.php"); //計算プログラムの読み込み

			//初期化
			$rows = array();
			$databox = array();
			$countrows = 0;
			$family = array();
			$array = array();

			//家族
			$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in($1,$2,$3,$4)";
			$array = array($my_no,$f1,$f2,$f3);
			$pgsql->query($sql,$array);
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
			}

			//初期化
			$rows = array();
			$databox = array();
			$countrows = 0;
			$lover = array();
			$array = array();

			//恋人
			$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in($1,$2)";
			$array = array($my_no,$lo);
			$pgsql->query($sql,$array);
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
			}

			//初期化
			$rows = array();
			$databox = array();
			$countrows = 0;
			$group1 = array();
			$array = array();

			//友達グループ1
			$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in($1,$2,$3,$4,$5,$6,$7,$8,$9)";
			$array = array($my_no,$g11,$g12,$g13,$g14,$g15,$g16,$g17,$g18);
			$pgsql->query($sql,$array);
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
			}

			//初期化
			$rows = array();
			$databox = array();
			$countrows = 0;
			$group2 = array();
			$array = array();

			//友達グループ2
			$sql = "SELECT a1,a2,a3,a4,a5,a6,a7,a8 FROM friendinfo where no in($1,$2,$3,$4,$5,$6,$7,$8,$9)";
			$array = array($my_no,$g21,$g22,$g23,$g24,$g25,$g26,$g27,$g28);
			$pgsql->query($sql,$array);
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
			}

			$array = array();

			if(!empty($family)||!empty($lover)||!empty($group1)||!empty($group2)){ //評価値があればデータをDBに挿入
				$sql = "INSERT INTO valueinfo VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21,$22,$23,$24,$25,$26,$27,$28,$29,$30,$31,$32,$33) ON CONFLICT ON CONSTRAINT valueinfo_pkey DO UPDATE SET fa1 =$2,fa2 =$3,fa3 =$4,fa4 =$5,fa5 =$6,fa6 =$7,fa7 =$8,fa8 =$9,loa1 =$10,loa2 =$11,loa3 =$12,loa4 =$13,loa5 =$14,loa6 =$15,loa7 =$16,loa8 =$17,g1a1 =$18,g1a2 =$19,g1a3 =$20,g1a4 =$21,g1a5 =$22,g1a6 =$23,g1a7 =$24,g1a8 =$25,g2a1 =$26,g2a2 =$27,g2a3 =$28,g2a4 =$29,g2a5 =$30,g2a6 =$31,g2a7 =$32,g2a8 =$33";
				$array = array($my_no,$family[0],$family[1],$family[2],$family[3],$family[4],$family[5],$family[6],$family[7],$lover[0],$lover[1],$lover[2],$lover[3],$lover[4],$lover[5],$lover[6],$lover[7],$group1[0],$group1[1],$group1[2],$group1[3],$group1[4],$group1[5],$group1[6],$group1[7],$group2[0],$group2[1],$group2[2],$group2[3],$group2[4],$group2[5],$group2[6],$group2[7]);
				$pgsql->query($sql,$array);
			}
		}
	}
}else{
	if(isset($_SESSION["my_no"])){
		$my_no = $_SESSION["my_no"]; //セッションがセットされていれば会員番号を挿入
	}else{
		$access_error = "ログインをお願いします"; //アクセスエラー
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ユーザ詳細情報登録</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<script type="text/javascript">
		function tbox1(){
			document.group.f1.value="7";
			document.group.f2.value="1";
			document.group.f3.value="5";
			document.group.lo.value="1";
			document.group.g11.value="2";
			document.group.g12.value="3";
			document.group.g13.value="4";
			document.group.g14.value="16";
			document.group.g15.value="43";
		}
	</script>
</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<div id="head">
			<?php

			if (!isset($_POST["submit_relation"])&&isset($_SESSION["my_no"])){
			 //登録中ではないときにテーブルを読んでデータ表示
				$array = array();
				$array = array($my_no);
				$pgsql->query("SELECT f1,f2,f3,lo,g11,g12,g13,g14,g15,g16,g17,g18,g21,g22,g23,g24,g25,g26,g27,g28 FROM relationinfo WHERE no=$1",$array); //関係性テーブルより読み込み
				$row = $pgsql->fetch();
				if ($row){
					if($row["f1"]!=0)
						$f1 = $row["f1"];
					if($row["f2"]!=0)
						$f2 = $row["f2"];	//家族2
					if($row["f3"]!=0)
						$f3 = $row["f3"];	//家族3
					if($row["lo"]!=0)
						$lo = $row["lo"]; //恋人
					if($row["g11"]!=0)
						$g11 = $row["g11"]; //友達1-1
					if($row["g12"]!=0)
						$g12 = $row["g12"]; //友達1-2
					if($row["g13"]!=0)
						$g13 = $row["g13"]; //友達1-3
					if($row["g14"]!=0)
						$g14 = $row["g14"]; //友達1-4
					if($row["g15"]!=0)
						$g15 = $row["g15"]; //友達1-5
					if($row["g16"]!=0)
						$g16 = $row["g16"]; //友達1-6
					if($row["g17"]!=0)
						$g17 = $row["g17"]; //友達1-7
					if($row["g18"]!=0)
						$g18 = $row["g18"]; //友達1-8
					if($row["g21"]!=0)
						$g21 = $row["g21"]; //友達2-1
					if($row["g22"]!=0)
						$g22 = $row["g22"]; //友達2-2
					if($row["g23"]!=0)
						$g23 = $row["g23"]; //友達2-3
					if($row["g24"]!=0)
						$g24 = $row["g24"]; //友達2-4
					if($row["g25"]!=0)
						$g25 = $row["g25"]; //友達2-5
					if($row["g26"]!=0)
						$g26 = $row["g26"]; //友達2-6
					if($row["g27"]!=0)
						$g27 = $row["g27"]; //友達2-7
					if($row["g28"]!=0)
						$g28 = $row["g28"]; //友達2-8
				}
			}
			require_once("header.php"); //ヘッダーの読み込み
			if(strlen($access_error)>0){
				echo $access_error;
				echo "</div></div></body></html>";
				exit;
			}
			require_once("linkplace.php"); //現在地表示用php
			echo pwd("register_group"); //現在値の表示
			echo "<br>";

			if (strlen($error)>0||strlen($error1)>0||strlen($error2)>0||strlen($error3)>0){ //エラーメッセージの出力
				if($error != "登録が完了しました."||$error1 != "登録が完了しました."||$error2 != "登録が完了しました."||$error3 != "登録が完了しました."){
					echo "<font size='6' color=\"#da0b00\">{$error}</font><p>";
					echo "<font size='6' color=\"#da0b00\">{$error1}</font><p>";
					echo "<font size='6' color=\"#da0b00\">{$error2}</font><p>";
					echo "<font size='6' color=\"#da0b00\">{$error3}</font><p>";
				}else{
					echo "登録が完了しました";
					echo "</div></div></body></html>";
					exit();
				}
			}
			?>
		</div>
	</div>
	<div id="page">
		<div id="contents">
			<div id="menuL">
				<?php require_once("left.php"); //左バーの取り込み ?>
			</div>
			<div id="main">
				<!-- #main 本文スペース -->
				<div class="contentswrap">
					<form name="group" action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
						<table align="center" border="0" cellspacing="3" cellpadding="3"  width="500px">
							<tr><div class="label2" align="center"><font size="4">グループの登録</font></div></tr>
							<tr><font color="red">自分の番号以外</font>の会員番号を<font color="red"><b>半角数字</b></font>で入力してください<br>機能を<font color="blue"><b>お試し</b></font>で使ってみたい方は<input type="button" value="自動入力" onclick="tbox1()">を押し、「登録する」を押してください。</tr>
							<tr>
								<td align="center">
									<div class="label2">家族</div>
								</td>
								<td>
									<input type="text" name="f1" value="<?=$f1 ?>" size="3">
									<input type="text" name="f2" value="<?=$f2 ?>" size="3">
									<input type="text" name="f3" value="<?=$f3 ?>" size="3">
								</td>
							</tr>
							<tr>
								<td align="center">
									<div class="label2">恋人/夫婦</div>
								</td>
								<td>
									<input type="text" name="lo" value="<?=$lo ?>" size="3">
								</td>
							</tr>
							<tr>
								<td align="center">
									<div class="label2">友達グループ1</div>
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
								<td align="center">
									<div class="label2">友達グループ2</div>
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
							<tr>
								<td align="center" colspan="2"><input type="button" value="自動入力" onclick="tbox1()">　　<input type="submit" name="submit_relation" value="登録する"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
