<?php
//======================================================================
//  ■： マイ情報の登録画面 friendinfo.php
//======================================================================
//----------------------------------------	
// ■ 共通 require_once
//----------------------------------------	
require_once("com_require.php");
//----------------------------------------	
// ■ 変数初期化
//----------------------------------------	
$usr_pw = "";
$usr_msg = "";
$age = "";
$sex = "";
$local = "";
$twi_id = "";
$a1="";
$a2="";
$a3="";
$a4="";
$a5="";
$a6="";
$a7="";
$a8="";
$a9="";
$a10="";
$a11="";
$email="";
//----------------------------------------	
// ■　POSTされたとき
//----------------------------------------	
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//--------------------------------
	// □ 登録ボタンが押されたとき
	//--------------------------------
	if (isset($_POST["submit_toroku"])){
		//--------------------------------
		// □ POSTされたデータを取得
		//--------------------------------
		$usr_id = htmlspecialchars($_POST["usr_id"], ENT_QUOTES);	//ID
		$usr_pw = htmlspecialchars($_POST["usr_pw"], ENT_QUOTES);	//パスワード
		$usr_msg = htmlspecialchars($_POST["usr_msg"], ENT_QUOTES);	//メッセージ
		$age = htmlspecialchars($_POST['age']);
		$sex = htmlspecialchars($_POST['sex']);
//		$local = htmlspecialchars($_POST['local']);
		$email = htmlspecialchars($_POST['email']);
		$twi_id = htmlspecialchars($_POST['twi_id']);
		$a1 = htmlspecialchars($_POST['a1']);
		$a2 = htmlspecialchars($_POST['a2']);
		$a3 = htmlspecialchars($_POST['a3']);
		$a4 = htmlspecialchars($_POST['a4']);
		$a5 = htmlspecialchars($_POST['a5']);
		$a6 = htmlspecialchars($_POST['a6']);
		$a7 = htmlspecialchars($_POST['a7']);
		$a8 = htmlspecialchars($_POST['a8']);
		$a9 = htmlspecialchars($_POST['a9']);
		$a10 = htmlspecialchars($_POST['a10']);
		$a11 = htmlspecialchars($_POST['a11']);
		//--------------------------------
		// □ 入力内容チェック
		//--------------------------------
		//パスワード
		if (!preg_match("/^[A-Za-z0-9]{1,10}$/", $usr_pw)){
			$error = "パスワードに誤りがあります<br>";
		}
		if (strlen($usr_pw)==0){$error = "パスワードが未入力です";}
		//ユーザID
		if (strlen($usr_id)>30){$error = "ユーザIDは30桁までです";}
		$mysql->query("SELECT * FROM friendinfo WHERE usrid='$usr_id' AND no<>$usr_no");
		$row = $mysql->fetch();
		if ($row){$error = "このユーザIDは既に使われています";}
		if (strlen($usr_id)==0){$error = "ユーザIDが未入力です";}
		if (strlen($error)==0){
			//--------------------------------------------
			// □ 友達情報テーブル(friendinfo)に登録
			//--------------------------------------------
			if (strlen($_SESSION["my_id"]) == 0){	//新規
			
				$sql = "INSERT INTO friendinfo VALUES($usr_no,'$usr_pw','$usr_msg',now(),'$usr_id','$age','$sex','$email','$twi_id','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11')";
			}else{	//更新
				$sql = "UPDATE friendinfo SET usrid='$usr_id',usrpw='$usr_pw',age='$age',sex='$sex',email='$email',twi_id='$twi_id',";
				$sql.= "msg='$usr_msg',a1='$a1',a2='$a2',a3='$a3',a4='$a4',a5='$a5',a6='$a6',a7='$a7',a8='$a8',a9='$a9',a10='$a10',a11='$a11',upddate=now() WHERE no=$usr_no";
			}
			$mysql->query($sql);
			$error = "登録が完了しました。";
			if (strlen($_SESSION["my_id"]) == 0){
				$error.= "<br>初めのログインに成功しました。<br>";
				$error.= "<a href=\"./mypage.php\">マイページを見るにはここをクリック！！</a>";
			}
			$_SESSION["my_id"] = $usr_id;
		}
	}
}
//=====================================================================
// ■　H T M L
//=====================================================================
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>マイ情報の登録</title>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
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
	//-----------------------------------------------------
	// □：登録中ではないときにテーブルを読んでデータ表示
	//-----------------------------------------------------
	if (!isset($_POST["submit_toroku"])){
		//-----------------------------------------------------
		// □：友達情報テーブル(friendinfo)からデータを読む
		//-----------------------------------------------------
		$mysql->query("SELECT * FROM friendinfo WHERE no=$usr_no");
		$row = $mysql->fetch();
		if ($row){
			$usr_id = $row["usrid"];
			$usr_pw = $row["usrpw"];
			$usr_msg = $row["msg"];
			$age = $row["age"];
			$sex = $row["sex"];
			$email = $row["email"];
			$twi_id = $row["twi_id"];	//twitterID
			$_SESSION["my_id"] =$usr_id;	//ユーザID
			$a1= $row["a1"];
			$a2= $row["a2"];
			$a3= $row["a3"];
			$a4= $row["a4"];
			$a5= $row["a5"];
			$a6= $row["a6"];
			$a7= $row["a7"];
			$a8= $row["a8"];
			$a9= $row["a9"];
			$a10= $row["a10"];
			$a11= $row["a11"];
		}
	}
	//----------------------------------------	
	// ■　ヘッダーの取り込み
	//----------------------------------------	
	require_once("header.php");
	?>
	<?php
	//----------------------------------------	
	// ■　エラーメッセージがあったら表示
	//----------------------------------------	
	if (strlen($error)>0){
		echo "<font size=\"2\" color=\"#da0b00\">{$error}</font><p>";
	}
	?>
	<div id="contents">
		<!-- #main 本文スペース -->
			<div class="contentswrap">
			<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<tr><div class="label" align="center">個人ステータスの登録</div></tr>
			<tr><td align="center" ><div class="label">マイ番号</div></td>
			<td><font size=5><?=$usr_no ?></font></td></tr>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">ユーザID<br>[ニックネームor実名]</div></td>
			<td><input type="text" name="usr_id" value="<?=$usr_id ?>" size="30"><br>
			<font size="2">30桁以内の任意の文字で入力してください</font></td></tr>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">パスワード</div></td>
			<td><input type="password" name="usr_pw" value="<?=$usr_pw ?>"><br>
			<font size="2">10桁以内の英数字で入力してください</font></td></tr>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">年代</div></td>
						<td>
							<input type="radio" name="age" value="10"<?php if ($age==10){ print " checked"; }?> >10
							<input type="radio" name="age" value="20"<?php if ($age==20){ print " checked"; }?> >20
							<input type="radio" name="age" value="30"<?php if ($age==30){ print " checked"; }?> >30
							<input type="radio" name="age" value="40"<?php if ($age==40){ print " checked"; }?> >40
							<input type="radio" name="age" value="50"<?php if ($age==50){ print " checked"; }?> >50
							<input type="radio" name="age" value="60"<?php if ($age==60){ print " checked"; }?> >60以上
						</td>
			</tr>
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">性別</div></td>
						<td>
							<input type="radio" name="sex" value="0"<?php if ($sex==0){ print " checked"; }?> >男
							<input type="radio" name="sex" value="1"<?php if ($sex==1){ print " checked"; }?> >女
						</td>
			</tr>
<!--			<tr><td align="center"><div class="label">地域</div></td>
						<td>
							<input type="radio" name="local" value="0"<?php if ($local==0){ print " checked"; }?> >地域内
							<input type="radio" name="local" value="1"<?php if ($local==1){ print " checked"; }?> >地域外
						</td>
			</tr>-->
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">メールアドレス</div></td>
			<td><input type="text" name="email" value="<?=$email ?>" size="30"><br>
			<font size="2">PCのメールアドレスを登録してください</font></td></tr>
<!--			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">twitterアカウント</div></td>
			<td><input type="text" name="twi_id" value="<?=$twi_id ?>" size="30"><br>
			<font size="2">＠は不要です</font></td></tr>-->
			<tr><td align="center" bgcolor="#ffe4e1"><div class="label">メッセージ</div></td>
			<td><textarea name="usr_msg" cols="40" rows="10"><?=$usr_msg?></textarea></td></tr>
			
			<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
			<br>
			<tr><div class="label2" align="center">個人の嗜好情報の登録 （1：低　5：高）</div></tr>
			
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">満足度</div></td>
						<td>
							<input type="radio" name="a1" value="1"<?php if ($a1==1){ print " checked"; }?> > 1
							<input type="radio" name="a1" value="2"<?php if ($a1==2){ print " checked"; }?> > 2
							<input type="radio" name="a1" value="3"<?php if ($a1==3){ print " checked"; }?> > 3
							<input type="radio" name="a1" value="4"<?php if ($a1==4){ print " checked"; }?> > 4
							<input type="radio" name="a1" value="5"<?php if ($a1==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">アクセス</div></td>
						<td>
							<input type="radio" name="a2" value="1"<?php if ($a2==1){ print " checked"; }?> > 1
							<input type="radio" name="a2" value="2"<?php if ($a2==2){ print " checked"; }?> > 2
							<input type="radio" name="a2" value="3"<?php if ($a2==3){ print " checked"; }?> > 3
							<input type="radio" name="a2" value="4"<?php if ($a2==4){ print " checked"; }?> > 4
							<input type="radio" name="a2" value="5"<?php if ($a2==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">人ごみの少なさ</div></td>
						<td>
							<input type="radio" name="a3" value="1"<?php if ($a3==1){ print " checked"; }?> > 1
							<input type="radio" name="a3" value="2"<?php if ($a3==2){ print " checked"; }?> > 2
							<input type="radio" name="a3" value="3"<?php if ($a3==3){ print " checked"; }?> > 3
							<input type="radio" name="a3" value="4"<?php if ($a3==4){ print " checked"; }?> > 4
							<input type="radio" name="a3" value="5"<?php if ($a3==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">見ごたえ</div></td>
						<td>
							<input type="radio" name="a4" value="1"<?php if ($a4==1){ print " checked"; }?> > 1
							<input type="radio" name="a4" value="2"<?php if ($a4==2){ print " checked"; }?> > 2
							<input type="radio" name="a4" value="3"<?php if ($a4==3){ print " checked"; }?> > 3
							<input type="radio" name="a4" value="4"<?php if ($a4==4){ print " checked"; }?> > 4
							<input type="radio" name="a4" value="5"<?php if ($a4==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">バリアフリー</div></td>
						<td>
							<input type="radio" name="a5" value="1"<?php if ($a5==1){ print " checked"; }?> > 1
							<input type="radio" name="a5" value="2"<?php if ($a5==2){ print " checked"; }?> > 2
							<input type="radio" name="a5" value="3"<?php if ($a5==3){ print " checked"; }?> > 3
							<input type="radio" name="a5" value="4"<?php if ($a5==4){ print " checked"; }?> > 4
							<input type="radio" name="a5" value="5"<?php if ($a5==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">コスト</div></td>
						<td>
							<input type="radio" name="a6" value="1"<?php if ($a6==1){ print " checked"; }?> > 1
							<input type="radio" name="a6" value="2"<?php if ($a6==2){ print " checked"; }?> > 2
							<input type="radio" name="a6" value="3"<?php if ($a6==3){ print " checked"; }?> > 3
							<input type="radio" name="a6" value="4"<?php if ($a6==4){ print " checked"; }?> > 4
							<input type="radio" name="a6" value="5"<?php if ($a6==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">アトラクション</div></td>
						<td>
							<input type="radio" name="a7" value="1"<?php if ($a7==1){ print " checked"; }?> > 1
							<input type="radio" name="a7" value="2"<?php if ($a7==2){ print " checked"; }?> > 2
							<input type="radio" name="a7" value="3"<?php if ($a7==3){ print " checked"; }?> > 3
							<input type="radio" name="a7" value="4"<?php if ($a7==4){ print " checked"; }?> > 4
							<input type="radio" name="a7" value="5"<?php if ($a7==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">施設の快適度</div></td>
						<td>
							<input type="radio" name="a8" value="1"<?php if ($a8==1){ print " checked"; }?> > 1
							<input type="radio" name="a8" value="2"<?php if ($a8==2){ print " checked"; }?> > 2
							<input type="radio" name="a8" value="3"<?php if ($a8==3){ print " checked"; }?> > 3
							<input type="radio" name="a8" value="4"<?php if ($a8==4){ print " checked"; }?> > 4
							<input type="radio" name="a8" value="5"<?php if ($a8==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">展示内容</div></td>
						<td>
							<input type="radio" name="a9" value="1"<?php if ($a9==1){ print " checked"; }?> > 1
							<input type="radio" name="a9" value="2"<?php if ($a9==2){ print " checked"; }?> > 2
							<input type="radio" name="a9" value="3"<?php if ($a9==3){ print " checked"; }?> > 3
							<input type="radio" name="a9" value="4"<?php if ($a9==4){ print " checked"; }?> > 4
							<input type="radio" name="a9" value="5"<?php if ($a9==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">催し物の規模</div></td>
						<td>
							<input type="radio" name="a10" value="1"<?php if ($a10==1){ print " checked"; }?> > 1
							<input type="radio" name="a10" value="2"<?php if ($a10==2){ print " checked"; }?> > 2
							<input type="radio" name="a10" value="3"<?php if ($a10==3){ print " checked"; }?> > 3
							<input type="radio" name="a10" value="4"<?php if ($a10==4){ print " checked"; }?> > 4
							<input type="radio" name="a10" value="5"<?php if ($a10==5){ print " checked"; }?> > 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#cee7ff"><div class="label2">雰囲気</div></td>
						<td>
							<input type="radio" name="a11" value="1"<?php if ($a11==1){ print " checked"; }?> > 1
							<input type="radio" name="a11" value="2"<?php if ($a11==2){ print " checked"; }?> > 2
							<input type="radio" name="a11" value="3"<?php if ($a11==3){ print " checked"; }?> > 3
							<input type="radio" name="a11" value="4"<?php if ($a11==4){ print " checked"; }?> > 4
							<input type="radio" name="a11" value="5"<?php if ($a11==5){ print " checked"; }?> > 5
						</td>
			</tr>

			<tr><td align="center" colspan="2">
			<input type="submit" name="submit_reset" value="リセット">
			<input type="submit" name="submit_toroku" value="登録する"></td></tr>
			</table>
			</div>
	</form>
	</div>
</div>
</body>
</html>