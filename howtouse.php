<?php
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
					<div class="label">目次</div>
					<ul>
						<li><a href="#1">ユーザ登録/ログイン</a>
							<ul>
								<li><a href="#11">SNSを使わずに登録/ログイン</a></li>
								<li><a href="#12">SNSをつかって登録/ログイン</a></li>
							</ul>
						</li>
						<li><a href="#2">マイページ</a>
							<ul>
								<li><a href="#21">会員詳細情報編集</a></li>
								<li><a href="#22">グループ編集</a></li>
								<li><a href="#23">パスワード変更</a></li>
								<li><a href="#24">アンケートに答える</a></li>
							</ul>
						</li>
						<li><a href="#3"></a></li>
						<li><a href="#4"></a></li>
						<li><a href="#5">section4</a></li>
						<li><a href="#6">section5</a></li>
						<li><a href="#7">section6</a></li>
					</ul>
				</div>
			</div>
			<div id="main">
				<h1 id="index">当サイトの使い方</h1>
				<div id="1">
					<h2>ユーザ登録/ログイン</h2>
					<p>方法は２通りあります。</p>
					<div id="11">
						<h3>SNSを使わずに登録/ログイン</h3>
						<ol>
							<li>ページ上部のログインボタンを押下</li>
							<li>新規利用登録の項目より「登録する」のリンクをクリック</li>
							<li>登録画面へ遷移するので、注意書きに従って項目を埋める
								<ul>
									<li>ユーザID : 5〜30文字の半角英数字</li>
									<li>パスワード : 6文字以上かつ半角英[小文字/大文字],数字を混在させたもの</li>
									<li>確認用パスワード : 再度パスワードを入力してください</li>
								</ul>
							</li>
							<li>入力終了後、「登録する」ボタンを押す。</li>
							<li>入力の注意に沿って入力がされていなければ、エラーが出力されるので、<br>
								再度入力をする。</li>
								<li>「登録が完了しました」で登録が完了です。<br>再度ログイン画面よりログインをお願いします。</li>
								<li>なお、初回ログイン時は自動的に<a href="#2">会員詳細情報登録</a>ページに遷移します。</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="12">
							<h3>SNSをつかって登録/ログイン</h3>
							<ol>
								<li>Facebookを使ったユーザ登録となります。</li>
								<li>SNS連帯の項目にあるfacebookログインバナーをクリックしてください</li>
								<li>Facebook側での認証をしてください</li>
								<li>認証が完了しましたので、お手数ですがもう一度バナーをクリックしてください。</li>
								<li>初回ログイン時は<a href="#2">会員詳細情報登録</a>ページに遷移します。</li>
								<li>2回目以降のログインの際は、同様にバナーをクリックしてください。</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
					</div>
					<div id="2">
						<h2>マイページ</h2>
						<p>次の項目の登録/編集が可能です。<br>
							項目を選んで「送信」ボタンを押下してください。<br>
						</p>
						<div id="21">
							<h3>会員詳細情報編集</h3>
							<h4>個人ステータスの登録</h4>
							<ul>
								<li>会員番号：あなたの会員番号です。</li>
								<li>性別：あなたの性別を選択してください。</li>
								<li>年代：あなたの年代を選択してください。</li>
							</ul>
							<h4>嗜好情報の入力</h4>
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
							記入後、「登録する」ボタンを押してください。<br><br>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="22">
							<h3>グループ編集</h3>
							　観光スポットに訪れるグループの編集を行います。<br>
							<ol>
								<li>項目ごとに該当する<font color="red">会員番号</font>を<font color="red">半角数字</font>入力してください。(空欄でも構いません)</li>
								<li>登録を完了するために「登録する」ボタンを押してください。</li>
								<li>入力にエラーが発生した場合、エラー文にしたがって再度登録をお願いします。</li>
								<li>「登録が完了しました」と出力されれば登録が完了です。</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="23">
							<h3>パスワード変更(SNSを使わないログインを行っている方のみ)</h3>
							　パスワードの変更を行います。
							<ol>
								<li>項目に従って入力をお願いします。
									<ul>
										<li>旧パスワード: 5〜30文字の半角英数字</li>
										<li>新パスワード: 6文字以上かつ半角英[小文字/大文字],数字を混在させたもの</li>
										<li>新パスワード(確認用): 再度新パスワードを入力してください</li>
									</ul>
								</li>
								<li>入力完了後「変更する」ボタンを押してください。</li>
								<li>入力にエラーが発生した場合、エラー文に従って入力を変更してください。</li>
								<li>「登録が完了しました」と出力されれば変更完了です。</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="24">
							<h3>アンケートに答える</h3>
							<p><font color="red">この項目の選択は一度しかできません。<br>
								推薦システムをご利用いただいた後にご回答ください。</font><br>
								選択後、外部サイトに遷移致します。<br>
								今後の研究の発展のために、ぜひご回答ください。<br>
							</p>
						</div>
						<a class="button" href="#index">▲ 目次に戻る</a>
					</div>

					<div id="3">
						<h2>観光スポット情報閲覧</h2>
						<p>　観光スポットの情報をカテゴリーごとに見ることができます。</p>
						<h3>観光スポットの選択</h3>
						<ol>
							<li>カテゴリーを選択し、送信してください。</li>
							<li>登録されている観光スポットの情報が一覧となって表示されます。</li>
							<li>詳細情報を閲覧したい観光スポットの名前をクリックしてください。</li>
						</ol>
						<h3>観光スポットの詳細情報</h3>
						<ul>
							<li></li>
							<li> </li>
							<li> </li>
							<li> </li>
						</ul>
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