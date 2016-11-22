<?php
	//======================================================================
	//  ■：how to use
	//======================================================================
	session_start(); //セッションスタート
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylet.css"></link>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>使い方</title>
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<!-- スムーズスクロール部分の記述 -->
<script>
$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 400; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});
</script>
</head>
<body>
	<div id="page">
	<?php
			//----------------------------------------
			// ■ヘッダーの取り込み
			//----------------------------------------
		require_once("./header.php");
		require_once("./linkplace.php");
		echo pwd("howtouse");
		?>
<div id="contents">
<div id="menuL">
<div class="subinfo">
<div class="label"><h2 id="index">目次</h2></div>
<ul>
	<li><a href="#1">ユーザ登録</a></li>
	<ul>
		<li><a href="#11">SNSを使わずに登録</a></li>
		<li><a href="#12">マイページ</a></li>
	</ul>
	<li><a href="#2"></a></li>
	<li><a href="#3"></a></li>
	<li><a href="#4"></a></li>
	<li><a href="#5">section4</a></li>
	<li><a href="#6">section5</a></li>
	<li><a href="#7">section6</a></li>
</ul>
</div>
</div>
<div id="main">
<h1>当サイトの使い方</h1>
<div id="1">
	<h2>ユーザ登録</h2>
	方法は２通りあります。<br>
	<div id="11">
	<h3>SNSを使わずに登録</h3>
	<ol>
	<li>ページ上部のログインボタンを押下</li>
	<li>新規利用登録の項目より「登録する」のリンクをクリック</li>
	<li>登録画面へ遷移するので、注意書きに従って項目を埋める</li>
	　　ユーザID: 5〜30文字の半角英数字<br>
	　　パスワード: 6文字以上かつ半角英[小文字/大文字],数字を混在させたもの<br>
	　　確認用パスワード: 再度パスワードを入力してください<br>
	<li>入力終了後、「登録する」ボタンを押す。</li>
	<li>入力の注意に沿って入力がされていなければ、エラーが出力されるので、<br>
		 再度入力をする。</li>
	<li>「登録が完了しました」で登録が完了です。<br>再度ログイン画面よりログインをお願いします。</li>
	<li>なお、初回ログイン時は自動的に<a href="#2">会員詳細情報登録</a>ページに遷移します。</li>
	</ol>
	</div>
	<div id="12">
	<h3>SNSをつかって登録する</h3>
	<ol>
	<li>Facebookを使ったユーザ登録となります。</li>
	<li>SNS連帯の項目にあるfacebookログインバナーをクリックしてください</li>
	<li>Facebook側での認証をしてください</li>
	<li>登録完了と同時に<a href="#2">会員詳細情報登録</a>ページに遷移します。</li>
	<li>ログインの際は、同様にバナーをクリックしてください</li>
	</ol>
	<a class="button" href="#index">▲ 目次に戻る</a>
</div>
</div>
<div id="2">
	<h2>ユーザ詳細情報入力ページ</h2>
	<h3>個人ステータスの登録</h3>
	<ul>
	<li>会員番号：あなたの会員番号です。</li>
	<li>性別：性別を選択してください。</li>
	<li>年代：年代を選択してください。</li>
	</ul>
	<h3>嗜好情報の入力</h3>
	５段階評価で入力してください。初期値は３となっております。
	<ul>
	<li>満足度　　　　　　　：(1)低い　　　　<--->(5)高い</li>
	<li>アクセス　　　　　　：(1)困難　　　　<--->(5)容易</li>
	<li>人混みの少なさ　　　：(1)少ない　　　<--->(5)多い</li>
	<li>バリアフリー　　　　：(1)進んでいない<--->(5)進んでいる</li>
	<li>コストパフォーマンス：(1)低い　　　　<--->(5)高い</li>
	<li>雰囲気　　　　　　　：(1)悪い　　　　<--->(5)良い</li>
	<li>快適度　　　　　　　：(1)少ない　　　<--->(5)多い</li>
	<li>おすすめ度　　　　　：(1)低い　　　　<--->(5)高い</li>
	</ul>
	記入後、「登録する」ボタンを押してください。
	<a class="button" href="#index">▲ 目次に戻る</a>
</div>


<div id="3">
	<h2>section3</h2>
	<a class="button" href="#index">▲ 目次に戻る</a>
</div>


<div id="4">
	<h2>section4</h2>
	<a class="button" href="#index">▲ 目次に戻る</a>
</div>


<div id="5">
	<h2>section5</h2>
	<a class="button" href="#index">▲ 目次に戻る</a>
</div>


<div id="6">
	<h2>section6</h2>
	<a class="button" href="#index">▲ 目次に戻る</a>
</div>
</div>
</div>
</div>
</body>
</html>