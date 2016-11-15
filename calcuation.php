<?php
/*
	計算用関数 calcuation.php
		value_calcuation関数
			見解間距離均等法を用いた集団意思決定分析法
		cosSim関数
			類似度算出
		simList関数
			ソート用関数
		sort_for_point関数
			上位n位の任意のカラムによるソート
 */

/*
	value_calcuation関数
		見解間距離均等法を用いた集団意思決定分析法
*/

/*データ一覧
	$datax[0] = [0.571,0.286,0.143];
	$datax[1] = [0.137,0.239,0.624];
	$datax[2] = [0.163,0.540,0.297];
*/
	function value_calcuation($datax){
		for($i=0;$i<count($datax[0]);$i++){
			for($j=0;$j<count($datax);$j++){
				$x[$i][$j]=(double)$datax[$j][$i];
			}
		}
		$n = (double) count($x[0]); //人数
		$m = (double) count($x); //項目数

	//項目ごとにおける個人と他者の見解間距離を求める
		for($k=0;$k<$m;$k++){
			for($l=0;$l<count($x[$k]);$l++){
				$ori = $x[$k][$l];

			$tmp = 0.0; //初期化
			for($j=0;$j<count($x[$k]);$j++){
				$t = $ori-$x[$k][$j];
				$tmp += pow($t,2); //二乗して足し合わせ
			}

			$tmp = sqrt($tmp); //平方根

			$sum = 0.0; //初期化
			for($j=0;$j<count($x[$k]);$j++){
				$sum += $x[$k][$j];
			}

			$sum = $sum/$n;

			$d[$k][$l] = $tmp + $sum;
		}
	}

	/*ラグランジュ未定乗数法を用いるための行列を作る ここから*/
	$k=0;
	$l=0;
	for($i=0;$i<$n;$i++){
		for($j=$k;$j<$n;$j++){
			$t = 0.0;
			for($p=0;$p<$m;$p++){
				$t += ($d[$p][$i]*$d[$p][$j]);
			}
			if($i==$j){
				$tmp = ($n-1)*$t;
				$data[$i][$j] = $tmp;
			}else{
				$data[$i][$j] = -$t;
				$data[$j][$i] = -$t;
			}
		}
		$k++;
	}
//n行とn列はn行n列以外1,n行n列は0
	for($i=0;$i<=$n;$i++){
		if($i!=$n){
			$data[$i][$n]=1.0;
			$data[$n][$i]=1.0;
		}else{
			$data[$i][$n]=0.0;
		}
	}
	/*ここまで*/

	/*逆行列を作る ここから*/
//単位行列を作る
	for($i=0;$i<$n+1;$i++){
		for($j=0;$j<$n+1;$j++){
			if($i==$j){
				$inv_data[$i][$j]=1.0;
			}else{
				$inv_data[$i][$j]=0.0;
			}
		}
	}

// ピボット選択を行ったGauss-Jordan法
	for($k=0;$k<$n+1;$k++){
  //ピボット選択 k行k列目の要素の絶対値が最大に
		$max = $k;
		for( $j=$k+1; $j<$n+1; $j++){
			if( abs($data[$j][$k]) > abs($data[$max][$k]) ){
				$max = $j;
			}
		}
  // 行の入れ替え
		if( $max != $k ){
			for( $i=0; $i<$n+1; $i++){
      // 入力行列側
				$tmp = $data[$max][$i];
				$data[$max][$i] = $data[$k][$i];
				$data[$k][$i] = $tmp;
      // 単位行列側
				$tmp = $inv_data[$max][$i];
				$inv_data[$max][$i] = $inv_data[$k][$i];
				$inv_data[$k][$i] = $tmp;
			}
		}

  // k行k列目の要素が1になるように
		$tmp = $data[$k][$k];
		for($i=0;$i<$n+1;$i++){
			$data[$k][$i] /= $tmp;
			$inv_data[$k][$i] /= $tmp;
		}
  // k行目のk列目以外の要素が0になるように
		for( $j=0;$j<$n+1;$j++ ){
			if( $j != $k ){
				$tmp = $data[$j][$k] / $data[$k][$k];
				for($i=0;$i<$n+1;$i++){
					$data[$j][$i] = $data[$j][$i] - $data[$k][$i] * $tmp;
					$inv_data[$j][$i] = $inv_data[$j][$i] - $inv_data[$k][$i] * $tmp;
				}
			}
		}
	}
	/*ここまで*/
	//ラグランジュ未定乗数法
	for($i=0;$i<$n;$i++){
		$r[$i] = $inv_data[$i][$n];
	}

	//最終評価
	for($i=0;$i<$m;$i++){
		for($j=0;$j<$n;$j++){
			$result[$i] += $x[$i][$j]*$r[$j];
		}
	}

	//集団意思
	return($result);
}

function cosSim($data1, $data2){
	$sum=null;
	$sim=null;
	$rd1=null;
	$rd2=null;
	$r1=0;
	$r2=0;
	$deff = 8;
	for($i=0; $i < $deff; $i++){
		$sum =  $sum + $data1[$i]*$data2[$i];
		$r1 = $r1+($data1[$i]*$data1[$i]);
		$r2 = $r2+($data2[$i]*$data2[$i]);
	}
	$rd1 = sqrt($r1);
	$rd2 = sqrt($r2);
	if(($rd1 * $rd2)==0){
		$sim=0;
	}else{
	$sim = $sum / ($rd1 * $rd2);
	}
	return $sim;
}//cosSim END

function simList($data1, $data2){
//$data1[固定] ユーザー
//$data2      ローカル情報評価値データ ２次元配列

	$simU_P=array();
	$sortedPlace=null;

	for($j=0;$j<count($data2);$j++){
		$simU_P[$j]=cosSim($data1,$data2[$j]); //類似度算出
	}
	//降順にソートする
	arsort($simU_P);

	return $simU_P;

}//simList ＥＮＤ

function sort_for_point($data1,$data2,$value,$num){
	//$data1 ソートされた類似度 一次元
	//$data2      ローカル情報データ 2次元テーブル
	//$value 重視する項目
	//$num 何番目までを抜き出すか

	$top = array_slice($data1,0,$num,true); //上位$num番目までを抽出

	$topnum = array_keys($top); //上位$num番目までのキー値つまり$data2の何番目にあるか

	for($i=0;$i<count($topnum);$i++){ //上位$num位までの観光スポットデータの抜き出し
		$tmp = $topnum[$i];
		$spotdata[$i] = $data2[$tmp];
	}

	if($value!=NULL)//何も重視しない以外
		array_multisort(array_column($spotdata, $value),SORT_NUMERIC, SORT_DESC,$spotdata);
		//重視する項目でソート

	return $spotdata;
}

?>