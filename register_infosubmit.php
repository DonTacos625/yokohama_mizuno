<?php
session_start(); //セッションスタート
//======================================================================
//  ■： 会員詳細情報登録送信ページ register_infosubmit.php
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
//エラーメッセージ
$error = ""; //性別
$access_error = ""; //アクセスエラー

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if(isset($_POST["submit_toroku"])){
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
			$_SESSION["gender"] = $gender;
			$_SESSION["age"] = $age;
		}
	}
}else{
	$access_error = "不正なアクセスです";
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>会員詳細情報登録</title>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<?php
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
						echo "登録が完了しました。<br>";
						echo "この情報は<a href='./mypage.php' title='マイページ'>マイページ</a>の「会員詳細情報編集」よりいつでも変更可能です。";
						echo "</dvi></div></body></html>";
						exit;
					}
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>