<?php 
	if(isset($_COOKIE["userid"])){
		$usr_id =$_COOKIE["userid"];
		echo $usr_id;
		setcookie("userid", $usr_id, time() - 1800); //Cookieの削除
		if(!isset($_COOKIE["userid"])){
			echo "正常";
		}
	}else{
		echo "不正なアクセスです";
	}
 ?>