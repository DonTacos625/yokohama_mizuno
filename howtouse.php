<?php
	session_start(); //セッションスタート
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylet.css">
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
		<div id="header">
		<?php
		//----------------------------------------
		// ■ヘッダーの取り込み
		//----------------------------------------
		require_once("./header.php");
		?>
		</div>
		<?php require_once("./linkplace.php");
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
						<li><a href="#3">観光スポット閲覧</a>
							<ul>
								<li><a href="#31">観光スポットの選択</a></li>
								<li><a href="#32">観光スポットの詳細情報</a></li>
								<li><a href="#33">観光スポットの評価情報の投稿</a></li>
							</ul>
						</li>
						<li><a href="#4">観光スポット推薦</a>
							<ul>
								<li><a href="#41">推薦項目の入力</a></li>
								<li><a href="#42">推薦された観光スポットの表示</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div id="main">
				<div class="contentswrap">
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
								<li>入力の注意に沿って入力がされていなければ、エラーが出力されるので、再度入力をする。</li>
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
							　５段階評価で入力してください。
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
						<br>
						<div id="22">
							<h3>グループ編集</h3>
							　観光スポットに訪れるグループの編集を行います。
							<ol>
								<li>項目ごとに該当する<font color="red">会員番号</font>を<font color="red">半角数字</font>入力してください。<br>(空欄でも構いません)</li>
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
						<h2>観光スポット閲覧</h2>
						<p>　観光スポットの情報をカテゴリーごとに見ることができます。</p>
						<div id="31">
							<h3>観光スポットの選択</h3>
							<ol>
								<li>カテゴリーを選択し、送信してください。<br>なお、「その他」にはイベント情報等が分類されています。</li>
								<li>登録されている観光スポットの情報が一覧となって表示されます。</li>
								<li>詳細情報を閲覧したい観光スポットの名前をクリックしてください。</li>
							</ol>
						</div>
						<br>
						<div id="32">
							<h3>観光スポットの詳細情報</h3>
							<ul>
								<li>スポット名：スポットの名前</li>
								<li>カテゴリー：スポットが該当するカテゴリー</li>
								<li>紹介文　　：スポットについての詳細文</li>
								<li>参考URL　：スポットの外部サイトリンク</li>
								<li>評価　　　：<a href="#33">観光スポットの評価情報の投稿</a>へのリンク</li>
							</ul>
						</div>
						<br>
						<div id="33">
							<h3>観光スポットの評価情報の投稿</h3>
							<p>行ったことのある観光スポットについて、下記の項目に従って評価をお願いします。<br>この評価情報は観光スポットを推薦するための評価値として使われます。</p>
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
							すべての項目について入力が完了したら、「投稿する」ボタンを押してください。
						</div>
						<a class="button" href="#index">▲ 目次に戻る</a>
					</div>

					<div id="4">
						<h2>観光スポットの推薦</h2>
						<p>　嗜好にあった観光スポットを推薦します。</p>
						<div id="41">
							<h3>推薦項目の入力</h3>
							<ol>
								<li>観光するグループを選択してください。<br><a href="#22">グループ編集</a>で登録したグループが表示されます。<br><font color="red">グループが未登録の場合は「一人」しか選択できません。</font></li>
								<li>推薦して欲しい観光スポットのカテゴリーを選択してください。<br>なお、「その他」にはイベント情報等が分類されています。</li>
								<li>観光の際に重視する項目を１つ選択してください。<br>初期値は「何も重視しない」となっております。</li>
								<li>1〜3の項目をすべて選択し終えたら、「送信」ボタンを押してください。<br>エラー文が出た場合は、再度入力をお願いします。</li>
							</ol>
						</div>
						<div id="42"><h3>推薦された観光スポットの表示</h3>
							<p>あなたにおすすめする観光スポットが表示されます。<br>地図上にあるマーカーをクリックすると
								<ul>
									<li>名前</li>
									<li>分類(カテゴリー)</li>
									<li><a href="#32">詳細情報</a>へのリンク</li>
								</ul>
								が地図上に表示されます。
							</p>
							マーカーの凡例
							<table id="table5932" border="1">
								<tr>
									<td><img src="./marker/purple.png">飲食</td>
									<td><img src="./marker/yellow.png">ショッピング</td>
									<td><img src="./marker/red.png">テーマパーク・公園</td>
								</tr>
								<tr>
									<td><img src="./marker/orange.png">名所・史跡</td>
									<td><img src="./marker/ltblue.png">芸術・博物館</td>
									<td><img src="./marker/blue.png">その他</td>
								</tr>
							</table>
							<style type="text/css"><!-- #table5932{text-align:left;background:#ffffff;border:solid 2px #ff99d6;border-collapse:collapse}#table5932>tbody>tr>td{border:solid 0px #ff99d6;padding:4px;min-width:60px} --></style>
						</div>
						<a class="button" href="#index">▲ 目次に戻る</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>