<?php
	$row = array(0,1,2,3,4,5,6);
	$tmp = 0;
	if(strlen($row[1])!=0){
		for($i=1;i<6;$i++){
			if(strlen($row[$i])==0)
				break;
			//$tmp = $tmp + $row[i];
			echo $row[$i];
		}
	}
	echo $tmp;
?>