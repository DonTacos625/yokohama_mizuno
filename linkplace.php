<?php
	function pwd($url){
		$toppagetag = "<a href='./index.php'>トップページ</a>";

		$mypage ="mypage";
		$mypagename = "マイページ";
		$mypagetag = '<a href="'.$mypage.'.php">マイページ</a>';

		$fbregister ="fb_register";
		$fbregistername ="会員詳細情報登録";
		$fbregistertag = '<a href="'.$fbregister.'.php">会員詳細情報登録</a>';

		$localinfo ="localinfo";
		$localinfoname = "観光スポットカテゴリー選択";
		$localinfotag = '<a href="'.$localinfo.'.php">観光スポットカテゴリー選択</a>';

		$localinfo2 ="localinfo2";
		$localinfo2name = "観光スポット閲覧";
		$localinfo2tag = '<a href="'.$localinfo.'.php">観光スポット閲覧</a>';

		$recomend1 ="recomend1";
		$recomend1name ="観光スポット推薦";
		$recomend1tag = '<a href="'.$recomend1.'.php">観光スポット推薦</a>';

		$recomend2 ="recomend2";
		$recomend2name = "推薦スポット表示";
		$recomend2tag = '<a href="'.$recomend2.'.php">推薦スポット表示</a>';

		$br = '<br>';
		$arrow = ' > ';

		if($url == $mypage)
			return $toppagetag.$arrow.$mypagename;
		if($url == $fbregister)
			return $toppagetag.$arrow.$mypagetag.$arrow.$fbregistername;
		if($url == $recomend1)
			return $toppagetag.$arrow.$recomend1name;
		if($url == $recomend2)
			return $toppagetag.$arrow.$recomend1tag.$arrow.$recomend2name;
		if($url == $localinfo)
			return $toppagetag.$arrow.$localinfoname;
		if($url == $localinfo2)
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo2name;
	}

?>