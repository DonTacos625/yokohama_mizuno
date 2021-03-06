<?php
session_start();
//======================================================================
//  ■： 会員登録ページ パスワード変更
//======================================================================
require_once("PostgreSQL.php");
//require_once("com_require2.php");
$pgsql = new PostgreSQL;

//エラーメッセージ
$error = ""; //ID関係
$error1 = ""; //PW関係

// POSTメソッドで送信された場合は書き込み処理を実行する
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if(isset($_POST["change"])){
		$my_no = $_SESSION["my_no"];

		// フォームからデータを受け取る
		//--------------------------------
		$oldpw = htmlspecialchars($_POST["oldpw"], ENT_QUOTES); //旧パスワード
		$newpw = htmlspecialchars($_POST["newpw"], ENT_QUOTES);	//新パスワード
		$newpw2 = htmlspecialchars($_POST["newpw2"], ENT_QUOTES);	//新パスワード確認

		//--------------------------------
		// □ 入力内容チェック
		//--------------------------------

		//パスワード
		if(strlen($oldpw)==0)
			$error = "旧パスワードが未入力です<br>";
		else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $oldpw))
			$error ="旧パスワードに誤りがあります<br>";
		else if(strlen($newpw)==0)
			$error1 = "新パスワードが未入力です<br>";
		else if (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $newpw))
			$error1 = " 新パスワードに誤りがあります<br>";
		else if($newpw != $newpw2)
			$error2 = "新パスワードと確認用パスワードが一致しません<br>";
		else{
			$sql = "SELECT no,pw FROM friendinfo WHERE no=$1";
			$array = array($my_no);
			$pgsql->query($sql,$array);
			$row = $pgsql->fetch();
			if($row["pw"]==hash("sha256",$oldpw)){
				$newpw =hash("sha256",$newpw);
				$sql = "UPDATE friendinfo SET pw=$1 WHERE no=$2";
				$array = array($newpw,$my_no);
				$pgsql->query($sql,$array);
				$error = "登録完了";
			}else{
				$error = "旧パスワードに誤りがあります<br>";
			}
		}
	}
}else{
	if(isset($_SESSION["my_no"])&&!isset($_SESSION["fb_access_token"])&&!isset($_SESSION["sns"])){
		$my_no = $_SESSION["my_no"];
	}else{
		$access_error = "不正なアクセスです";
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>パスワード変更</title>
	<!-- style.cssの読み込み -->
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<div id="head">
			<?php
	//----------------------------------------	
	// ■ヘッダーの取り込み
	//----------------------------------------	
			require_once("header.php");
			?>
			<?php
			require_once("linkplace.php"); //現在地表示用php
			echo pwd("changepw"); //現在値の表示
	//----------------------------------------	
	// ■ エラーメッセージがあったら表示
	//----------------------------------------	
			if(strlen($access_error)>0){
				echo "<br>";
				echo $access_error;
				echo "</dvi></dvi></div></body></html>";
				exit;
			}
			if(strlen($error)>0||strlen($error1)>0||strlen($error2)>0&&$error!="登録完了"){
				echo "<br><font size=\"6\" color=\"#da0b00\">{$error}</font><p>";
				echo "<br><font size=\"6\" color=\"#da0b00\">{$error1}</font><p>";
				echo "<br><font size=\"6\" color=\"#da0b00\">{$error2}</font><p>";
			}
			if($error=="登録完了"){
				echo "<br><font size=\"6\" color=\"#da0b00\">変更が完了しました</font><p>";
				echo "</dvi></dvi></div></body></html>";
				exit;
			}
			?>
		</div>
		<div id="contents">
			<div class="contentswrap">
				<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
					<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
						<tr><div class="label2" align="center">パスワード変更</div></tr>
						<tr>
							<td align="center"><div class="label2">旧パスワード</div></td>
							<td>
								<input type="password" name="oldpw" value="<?=$oldpw ?>"><br>
							</td>
						</tr>
						<tr>
							<td align="center"><div class="label2">新パスワード</div></td>
							<td>
								<input type="password" name="newpw" value="<?=$newpw ?>"><br>
								<font size="2">6文字以上かつ半角英[小文字/大文字],数字を混在させたもの</font>
							</td>
						</tr>
						<tr>
							<td align="center"><div class="label2">新パスワード(確認用)</div></td>
							<td>
								<input type="password" name="newpw2" value="<?=$newpw2 ?>"><br>
								<font size="2">再度新パスワードの入力をお願いします</font>
							</td>
						</tr>
						<tr><td align="center" colspan="2"><input type="submit" name="change" value="変更する"></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>