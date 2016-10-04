<?php 
	if(isset($_COOKIE["userid"])){
		$usr_id =$_COOKIE["userid"];
		echo $usr_id;
		setcookie("userid", $userid, time() - 1800);
	}else{
		echo "不正なアクセスです";
	}
 ?>