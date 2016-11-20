<?php
session_start();
require_once('PostgreSQL.php');
require_once('calcuation.php');
$pgsql = new PostgreSQL;

// phpの配列をpostgresqlの配列に変換
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

if(isset($_SESSION["my_no"])){
	$my_no = $_SESSION["my_no"];
	if($_GET['pk']!=NULL){
		$pk=json_decode(json_encode($_GET['pk'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),true);
		if(preg_match('/^([0-9])/', $pk)){
			$sql = "SELECT spot_name,spot_category,spot_pic,spot_visited,spot_url,spot_content,spot_eval FROM localinfo WHERE pk=$1";
			$array = array($pk);
			$pgsql -> query($sql,$array);
			$row = $pgsql->fetch_all();
			if($row){
				$spot_name= $row[0]["spot_name"];
				$spot_category = $row[0]["spot_category"];
				$spot_pic = $row[0]["spot_pic"];
				$spot_visited = $row[0]["spot_visited"];
				$spot_url = $row[0]["spot_url"];
				$spot_content = $row[0]["spot_content"];
				$eval = toPhpArray($row[0]["spot_eval"]);
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
					<table border="0" cellspacing="3" cellpadding="3" width="600">
						<tr><td align="center" bgcolor="#fof8ff" colspan="2">
								<font size="4"><b>観光スポットの詳細情報</b></font></td></tr>
						<tr>
							<?php
							if($spot_pic!=NULL)
								echo "<img src='".$spot_pic."' alt='観光スポット写真'>";
							else
								echo "No image";
							?>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff" size="10"><font size="4"><b>スポット名</b></font></td>
							<td><?php echo  $spot_name?></td>
						</tr>
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
						<tr>
							<td align="center" bgcolor="#fof8ff"><font size="4"><b>紹介文</b></font></td>
							<td><?php echo "$spot_content"?></td>
						</tr>
						<tr>
							<td align="center" bgcolor="#fof8ff"><font size="4"><b>参考URL</b></font></td>
							<td>
								<?php
								echo $spot_url;
								$url = "http://".$spot_url;
								echo "<a href='".$url."'>リンク</a>"
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>