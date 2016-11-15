<?php
	function pwd($url,$value){
		$mypage ="mypage";
		$mypagetag = '<a href="'.$mypage.'.php">マイページ</a>';
		$fbregister ="fb_register";
		$fbregistertag = '<a href="'.$fbregister.'.php">会員詳細情報登録</a>';
		$localinfosee ="local_info_see";
		$localinfoseetag = '<a href="'.$localinfosee.'.php">閲覧</a>';
		$recomend1 ="recomend1";
		$recomend1tag = '<a href="'.$recomend1.'.php">推薦項目入力</a>';
		$recomend2 ="recomend2";
		$recomend2tag = '<a href="'.$recomend2.'.php">推薦スポット表示</a>';
		$br = '<br>';
		$arrow = ' > ';

		if($url = $fbregister){
			echo $mypagetag.$arrow.$fbregistertag;
		}
	}

?>