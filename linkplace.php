<?php
/*
	現在地を返すfunciton
*/

	function pwd($url){
		$toppagetag = "<a href='./index.php'>トップページ</a>";

		$mypage ="mypage";
		$mypagename = "マイページ";
		$mypagetag = '<a href="'.$mypage.'.php">マイページ</a>';

		$registeruser = "register_usr";
		$registerusername = "新規会員登録";

		$registerinfo ="register_info";
		$registerinfoname ="会員詳細情報編集";
		$registerinfotag = '<a href="'.$registerinfo.'.php">会員詳細情報編集</a>';

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

		$login = "login";
		$loginname = 'ログインページ';
		$logintag = '<a href="'.$login.'.php">ログインページ</a>';

		$howtouse = "howtouse";
		$howtousename = "使い方";

		$br = '<br>';
		$arrow = ' > ';

		if($url == $mypage) //マイページ
			return $toppagetag.$arrow.$mypagename;
		if($url == $registeruser) //新規会員登録
			return $toppagetag.$arrow.$logintag.$arrow.$registerusername;
		if($url == $registerinfo) //会員詳細情報編集
			return $toppagetag.$arrow.$mypagetag.$arrow.$registerinfoname;
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
		if($url == $changepw) //パスワード変更
			return $toppagetag.$arrow.$mypagetag.$arrow.$changepwname;
		if($url == $howtouse) //使い方
			return $toppagetag.$arrow.$howtousename;
		if($url == $login) //ログイン
			return $toppagetag.$arrow.$loginname;
	}
	function pwd_spot($category,$name){
		$arrow = ' > ';
		$br = '<br>';

		$toppagetag = "<a href='./index.php'>トップページ</a>";
		$localinfo ="localinfo";
		$localinfotag = '<a href="'.$localinfo.'.php">観光スポットカテゴリー選択</a>';

		if($category == 1){
			$category_name ="飲食";
			$category_tag ='<a href="https://study-yokohama-sightseeing.herokuapp.com/localinfo2.php?c_check=1">'.$category_name.'</a>';
		}
		else if($category == 2){
			$category_name ="ショッピング";
			$category_tag ='<a href="https://study-yokohama-sightseeing.herokuapp.com/localinfo2.php?c_check=2">'.$category_name.'</a>';
		}
		else if($category == 3){
			$category_name ="テーマパーク・公園";
			$category_tag ='<a href="https://study-yokohama-sightseeing.herokuapp.com/localinfo2.php?c_check=3">'.$category_name.'</a>';
		}
		else if($category == 4){
			$category_name ="名所・史跡";
			$category_tag ='<a href="https://study-yokohama-sightseeing.herokuapp.com/localinfo2.php?c_check=4">'.$category_name.'</a>';
		}
		else if($category == 5){
			$category_name = "芸術・博物館";
			$category_tag ='<a href="https://study-yokohama-sightseeing.herokuapp.com/localinfo2.php?c_check=5">'.$category_name.'</a>';
		}
		else{
			$category_name ="その他";
			$category_tag ='<a href="https://study-yokohama-sightseeing.herokuapp.com/localinfo2.php?c_check=6">'.$category_name.'</a>';
		}

		return $toppagetag.$arrow.$localinfotag.$arrow.$category_tag.$arrow.$name;
	}
?>