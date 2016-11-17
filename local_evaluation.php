<?php
session_start();
require_once('PostgreSQL.php');
require_once('calcuation.php');
$pgsql = new PostgreSQL;

// pphpの配列をpostgresqlの配列に変換
function toPostgreSqlArray($data)
{   
	return '{' . implode(',', $data) . '}';
}   

// postgresの配列をphpの配列に変換
function toPhpArray($data)
{
	$data       = str_replace('{', '', $data);
	$data       = str_replace('}', '', $data);
	$array_data = explode(',', $data);

	return $array_data;
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$a1 = intval(htmlspecialchars($_POST['a1']));
	$a2 = intval(htmlspecialchars($_POST['a2']));
	$a3 = intval(htmlspecialchars($_POST['a3']));
	$a4 = intval(htmlspecialchars($_POST['a4']));
	$a5 = intval(htmlspecialchars($_POST['a5']));
	$a6 = intval(htmlspecialchars($_POST['a6']));
	$a7 = intval(htmlspecialchars($_POST['a7']));
	$a8 = intval(htmlspecialchars($_POST['a8']));
	$pk = intval(htmlspecialchars($_POST['pk']));
	$visited = intval(htmlspecialchars($_POST['spot_visited']));
	$my_no = $_SESSION["my_no"];

	echo $pk;
	echo $visited;
	if($a1<6&&$a2<6&&$a3<6&&$a4<6&&$a5<6&&$a6<6&&$a7<6&&$a8<6){
		$sql = "SELECT spot_a1,spot_a2,spot_a3,spot_a4,spot_a5,spot_a6,spot_a7,spot_a8 FROM localinfo WHERE pk = $1";
		$array = array($pk);
		$pgsql -> query($sql,$array);
		$row = $pgsql->fetch();

		if($row["spot_a1"]==0){
			$data[0][0]= $a1;
		}else{
			$data[0][0]= intval($row["spot_a1"]);
		}
		if($row["spot_a2"]==0){
			$data[0][1]= $a2;
		}else{
			$data[0][1]= intval($row["spot_a2"]);
		}
		if($row["spot_a3"]==0){
			$data[0][2]= $a3;
		}else{
			$data[0][2]= intval($row["spot_a3"]);
		}
		if($row["spot_a4"]==0){
			$data[0][3]= $a4;
		}else{
			$data[0][3]= intval($row["spot_a4"]);
		}
		if($row["spot_a5"]==0){
			$data[0][4]= $a5;
		}else{
			$data[0][4]= intval($row["spot_a5"]);
		}
		if($row["spot_a6"]==0){
			$data[0][5]= $a6;
		}else{
			$data[0][5]= intval($row["spot_a6"]);
		}
		if($row["spot_a7"]==0){
			$data[0][6]= $a7;
		}else{
			$data[0][6]= intval($row["spot_a7"]);
		}
		if($row["spot_a8"]==0){
			$data[0][7]= $a8;
		}else{
			$data[0][7]= intval($row["spot_a8"]);
		}

		$data[1][0] = $a1;
		$data[1][1] = $a2;
		$data[1][2] = $a3;
		$data[1][3] = $a4;
		$data[1][4] = $a5;
		$data[1][5] = $a6;
		$data[1][6] = $a7;
		$data[1][7] = $a8;

		$resultval = value_calcuation($data); //データの計算
		var_dump($resultbal);
		$visited = $spot_visited+1; //訪問者を一人増やす
		var_dump($visited);
		$evaled_people = array_push($evaled_people,$my_no);
		$evaled = toPostgreSqlArray($evaled_people);
		$sql = "UPDATE localinfo SET spot_a1=$1,spot_a2=$2,spot_a3=$3,spot_a4=$4,spot_a5=$5,spot_a6=$6,spot_a7=$7,spot_a8=$8,spot_visited=$9,spot_eval=$10 WHERE pk=$11";
		$array = array($resultval[0],$resultval[1],$resultval[2],$resultval[3],$resultval[4],$resultval[5],$resultval[6],$resultval[7],$visited,$evaled,$pk);
		$pgsql->query($sql,$array);
		$error = "登録が完了しました";
	}else{
		$error= "不正な文字が入力されています";
	}
}else{
	if(isset($_SESSION["my_no"])){
		$my_no = $_SESSION["my_no"];
		if($_GET['pk']!=NULL){
			$pk=json_decode(json_encode($_GET['pk'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),true);
			if(preg_match('/^([0-9])/', $pk)){
				$sql = "SELECT spot_visited,spot_category,spot_name,spot_eval,spot_pic FROM localinfo WHERE pk=$1";
				$array = array($pk);
				$pgsql -> query($sql,$array);
				$row = $pgsql->fetch();
				$row = json_decode(json_encode($row, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),true);
				$spot_name= $row["spot_name"];
				$spot_category= $row["spot_category"];
				$spot_eval=$row["spot_eval"];
				$spot_pic=$row["spot_pic"];
				$spot_visited = $row["spot_visited"];
				if($row){
					$eval = toPhpArray($spot_eval);
					$eval_count = count($eval);
					for($i=0;$i<$eval_count;$i++){
						if($eval[$i]==$my_no){
							$error = "評価済みです";
						}
					}
				}else{
					$error = "存在しない観光スポット番号が入力されています";
				}
			}else{
				$error = "不正なアクセスです";
			}
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
		?>
		<div id="contents">
			<?php
			require_once('left.php');
			?>
			<div id="main">
				<div class="contentswrap">
					<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
						<input type="hidden" name="spot_visited" value="<?php echo $spot_visited?>">
						<input type="hidden" name="pk" value="<?php echo $pk?>">
						<table border="0" cellspacing="3" cellpadding="3" width="600"  >
							<tr><td align="center" bgcolor="#fof8ff" colspan="2">
								<font size="4"><b>観光スポットの評価情報を投稿する</b></font></td></tr>
								<td align="center" bgcolor="#fof8ff">
									<font size="4"><b>スポット名</b></font></td>
									<td><?php echo  $spot_name?><?php echo $pk?></td>
									<tr><td align="center" bgcolor="#fof8ff"><font size="4"><b>カテゴリー</b></font></td>
										<td>
											<?php
											if($spot_category==1){
												echo "飲食";
											}else if($spot_category==2){
												echo "ショッピング";
											}else if($spot_category==3){
												echo "テーマパーク・公園";
											}else if($spot_category==4){
												echo "名所・史跡";
											}else if($spot_category==5){
												echo "芸術・博物館";
											}else{
												echo "その他";
											}
											?>
										</td>
									</tr>
									<tr><?echo $spot_pic?><?echo $spot_visited?></tr>
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
										<input type="radio" name="a2" value="1" checked> 1
										<input type="radio" name="a2" value="2"> 2
										<input type="radio" name="a2" value="3"> 3
										<input type="radio" name="a2" value="4"> 4
										<input type="radio" name="a2" value="5"> 5
									</td>
								</tr>
								<tr><td align="center" bgcolor="#fof8ff"><b>人ごみの少なさ</b></td>
									<td>
										<input type="radio" name="a3" value="1" checked> 1
										<input type="radio" name="a3" value="2"> 2
										<input type="radio" name="a3" value="3"> 3
										<input type="radio" name="a3" value="4"> 4
										<input type="radio" name="a3" value="5"> 5
									</td>
								</tr>
								<tr><td align="center" bgcolor="#fof8ff"><b>バリアフリー</b></td>
									<td>
										<input type="radio" name="a4" value="1" checked> 1
										<input type="radio" name="a4" value="2"> 2
										<input type="radio" name="a4" value="3"> 3
										<input type="radio" name="a4" value="4"> 4
										<input type="radio" name="a4" value="5"> 5
									</td>
								</tr>
								<tr><td align="center" bgcolor="#fof8ff"><b>コストパフォーマンス</b></td>
									<td>
										<input type="radio" name="a5" value="1" checked> 1
										<input type="radio" name="a5" value="2"> 2
										<input type="radio" name="a5" value="3"> 3
										<input type="radio" name="a5" value="4"> 4
										<input type="radio" name="a5" value="5"> 5
									</td>
								</tr>
								<tr><td align="center" bgcolor="#fof8ff"><b>雰囲気</b></td>
									<td>
										<input type="radio" name="a6" value="1" checked> 1
										<input type="radio" name="a6" value="2"> 2
										<input type="radio" name="a6" value="3"> 3
										<input type="radio" name="a6" value="4"> 4
										<input type="radio" name="a6" value="5"> 5
									</td>
								</tr>
								<tr><td align="center" bgcolor="#fof8ff"><b>快適度/サービスの良さ</b></td>
									<td>
										<input type="radio" name="a7" value="1" checked> 1
										<input type="radio" name="a7" value="2"> 2
										<input type="radio" name="a7" value="3"> 3
										<input type="radio" name="a7" value="4"> 4
										<input type="radio" name="a7" value="5"> 5
									</td>
								</tr>
								<tr><td align="center" bgcolor="#fof8ff"><b>おすすめ度</b></td>
									<td>
										<input type="radio" name="a8" value="1" checked> 1
										<input type="radio" name="a8" value="2"> 2
										<input type="radio" name="a8" value="3"> 3
										<input type="radio" name="a8" value="4"> 4
										<input type="radio" name="a8" value="5"> 5
									</td>
								</tr>
							</table>
							<table border="0" cellspacing="3" cellpadding="3" width="600"  >
								<tr><td align="center" colspan="2">
									<input type="reset" name="submit_reset" value="リセット">
									<input type="submit" name="submit_toko" value="投稿する" onClick="return confirm('この内容で投稿しますか？')">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>