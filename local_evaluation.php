<?php
	session_start();
	require_once('PostgreSQL.php');
	$pgsql = new PostgreSQL;
//	mysql_select_db('SET NAMES utf8',$sql);
	//mysql_query("set names sgis");
	// print_r($_FILES);
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$sql = "SELECT eval_user FROM localinfo WHERE pk=$1";
		$array = array()
		$pgsql->query_null($sql);




	}else{
		if(isset($_SESSION["my_no"])){
			$my_no = $_SESSION["my_no"];
			if($_GET['pk']!=NULL){
				$pk = $_GET['pk'];
			}else{
				$error = "観光スポットが指定されていません";
			}
		}else{
			$error = "ログインをお願いします";
		}
	}
?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"></meta>
<title>地域情報</title>
<link rel="stylesheet" type="text/css" href="stylet.css"></link>
</head>

<body>
<div id="page">
	<?php
		require_once('header.php');
		if(strlen($error)!=0){
			echo $error;
			echo "</div></body></html>";
			exit;
		}
		if(isset($_SESSION["my_no"])&&!empty($pk)){
			$sql = "SELECT spot_visited,spot_category,spot_name FROM localinfo WHERE pk=$1";
			$array = array($pk);
		}



	?>
	<div id="contents">
		<?php
		require_once('left.php');
		?>
		<div id="main">
			<div class="contentswrap">
				<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden"  name="aaaa" value= >
				<table border="0" cellspacing="3" cellpadding="3" width="600"  >
				<tr><td align="center" bgcolor="#fof8ff" colspan="2">
				<font size="4"><b>観光スポットの評価情報を投稿する</b></font></td></tr>
				<td align="center" bgcolor="#fof8ff">
				<font size="4"><b>スポット名</b></font></td>
				<td><?php echo json_encode($name)  ?></td>
				<tr><td align="center" bgcolor="#fof8ff"><font size="4"><b>カテゴリー</b></font></td>
				<td>
					<?php echo json_encode($category)?>
				</td>
				</tr>
				<tr><?echo $pic?></tr>
			<tr><td align="center" bgcolor="#fof8ff"><font size="4"><b>評価</b></font></td>
			<td>1:低/少  <------>  5:高/多</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>満足度</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>アクセス</b></td>
						<<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>人ごみの少なさ</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>バリアフリー</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>コストパフォーマンス</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>雰囲気</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>快適度/サービスの良さ</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
			<tr><td align="center" bgcolor="#fof8ff"><b>おすすめ度</b></td>
						<td>
							<input type="radio" name="a1" value="1" checked> 1
							<input type="radio" name="a1" value="2"> 2
							<input type="radio" name="a1" value="3"> 3
							<input type="radio" name="a1" value="4"> 4
							<input type="radio" name="a1" value="5"> 5
						</td>
			</tr>
				</table>
				<table border="0" cellspacing="3" cellpadding="3" width="600"  >
				<tr><td align="center" colspan="2">
				<input type="reset" name="submit_reset" value="リセット">
				<input type="submit" name="submit_toko" value="投稿する" onClick="return confirm('この内容で投稿しますか？')">
			</td></tr></table></form></div></div></div></div></body></html>