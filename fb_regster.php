<?php 
	if(isset($_COOKIE["userid"])){
		$usr_id =$_COOKIE["userid"];
		echo $usr_id;
		setcookie("userid", $user_id, time() - 1800);
	}else{
		echo "不正なアクセスです";
	}
 ?>