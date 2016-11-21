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

		$localinfo21 ="localinfo21";
		$localinfo21name = "飲食";

		$localinfo22 ="localinfo22";
		$localinfo22name = "ショッピング";

		$localinfo23 ="localinfo23";
		$localinfo23name = "テーマパーク・公園";

		$localinfo24 ="localinfo24";
		$localinfo24name = "名所・史跡";

		$localinfo25 ="localinfo25";
		$localinfo25name = "芸術・博物館";

		$localinfo26 ="localinfo26";
		$localinfo26name = "その他";

		$recomend1 ="recomend1";
		$recomend1name ="観光スポット推薦";
		$recomend1tag = '<a href="'.$recomend1.'.php">観光スポット推薦</a>';

		$recomend2 ="recomend2";
		$recomend2name = "推薦スポット表示";
		$recomend2tag = '<a href="'.$recomend2.'.php">推薦スポット表示</a>';

		$changepw = "changepw";
		$changepwname = "パスワード変更";

		$br = '<br>';
		$arrow = ' > ';

		if($url == $mypage) //マイページ
			return $toppagetag.$arrow.$mypagename;
		if($url == $fbregister) //利用者詳細情報
			return $toppagetag.$arrow.$mypagetag.$arrow.$fbregistername;
		if($url == $recomend1) //推薦項目選択
			return $toppagetag.$arrow.$recomend1name;
		if($url == $recomend2) //推薦一覧
			return $toppagetag.$arrow.$recomend1tag.$arrow.$recomend2name;
		if($url == $localinfo) //カテゴリー選択
			return $toppagetag.$arrow.$localinfoname;
		if($url == $localinfo21) //飲食
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo21name;
		if($url == $localinfo22) //ショッピング
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo22name;
		if($url == $localinfo23) //テーマパーク・公園
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo23name;
		if($url == $localinfo24) //名所・史跡
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo24name;
		if($url == $localinfo25) //芸術・博物館
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo25name;
		if($url == $localinfo26) //その他
			return $toppagetag.$arrow.$localinfotag.$arrow.$localinfo26name;
		if($url == $changepw)
			return $toppagetag.$arrow.$mypagetag.$arrow.$changepwname;
	}

?>