<?php 
	if(isset($_COOKIE["userid"])){
		$usr_id = $_COOKIE["userid"];
		echo $usr_id;
	}else{
		echo "不正なアクセスです";
	}
 ?>