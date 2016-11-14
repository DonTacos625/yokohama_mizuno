<?php
$id = htmlspecialchars($_POST["id"]);
$pw = htmlspecialchars($_POST["pw"]);
$pw2 = htmlspecialchars($_POST["pw2"]);
$pw3 = htmlspecialchars($_POST["pw3"]);
$filename="./list2.csv";
	//check brank
if(strcmp($id, "")==0||strcmp($pw, "")==0)
	exit("エラー:IDまたはPWが空白です.");

if(strcmp($pw2,$pw3)!=0)
	exit("新パスワードが合いません。");

$fp = fopen($filename,"r");
flock($fp,LOCK_EX);
$flag = 1;
while($line = fgetcsv($fp))
	if (strcmp($line[0], $id)==0&&strcmp($line[1], hash("sha256", $pw))==0) {
		$flag=0;
		break;
	}
	flock($fp,LOCK_UN);
	fclose($fp);
	if($flag==1)
		exit("IDかパスワードが間違っています。");
	else{
		//csvファイルを読み込む
		$array = file("$filename");
		list($id_temp,$pw_temp)=array(array(),array());
		foreach ($array as $row)
			list($id_temp[],$pw_temp[]) = explode(",",trim($row));
		$key = array_search($id, $id_temp);
		if ($key !== FALSE) {
			$pw_temp["$key"] = $pw3;
			$array["$key"] = implode(',',array($id_temp["$key"],hash("sha256", $pw_temp["$key"])))."\n";
		}
		file_put_contents("$filename",$array);
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8"><head>
	<title>管理人パスワード変更完了</title>
	<!-- style.cssの読み込み -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<center>
		<!--メニューバー 選択してるところを色変えたいな。-->
		<nav>
			<ul id="menu">
				<li><a href="contents.html">Dirary</a></li>
				<li><a href="BBS_login.php">BBS</a></li>
				<li><a href="index.html">Top</a></li>
				<li><a href="enq.html">Enquete</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>
		</nav>
		<!--メニューバー終了-->
		<div class="clear"><hr id="line"></div>
	</center>
	<header class="text">
		<div>
			<h1>管理人用パスワードの変更が完了しました.</h1>
		</div>
	</header>
	<div class="text">
		<div>
			ユーザー名:  <?php echo $id ?><br>
			password:  <?php echo $pw2 ?><br><br>
			<a href="./contact_login.php" target = "_self">return to login page</a>
		</div>
	</div>
</body>
</html>
