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
   // #で始まるアンカーを押した場合に処理
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
<?php include_once("analyticstracking.php") ?>
	<div id="page">
		<?php
		//----------------------------------------
		// ■ヘッダーの取り込み
		//----------------------------------------
		require_once("./header_use.php");
		?>
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
								<li><a href="#12">SNSをつかって登録/ログイン</a>
									<ul>
										<li><a href="#121">Facebookを使う</a></li>
										<li><a href="#122">Twitterを使う</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="#2">マイページ</a>
							<ul>
								<li><a href="#21">会員詳細情報編集</a></li>
								<li><a href="#22">グループ登録・編集</a></li>
								<li><a href="#23">パスワード変更</a></li>
								<li><a href="#24">アンケートに答える</a></li>
							</ul>
						</li>
						<li><a href="#3">観光スポット閲覧</a>
							<ul>
								<li><a href="#31">観光スポットの選択</a></li>
								<li><a href="#32">観光スポットの詳細情報</a></li>
								<li><a href="#33">観光スポットのレビューの投稿</a></li>
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
						<p>方法は２通りあります</p>
						<div id="11">
							<h3>SNSを使わずに登録</h3>
							<ol>
								<li>ページ上部の項目「ログイン」を押す</li>
								<li>新規利用登録の項目より「登録はこちらから」のリンクを押す</li>
								<li>登録画面へ遷移するので、注意書きに従って項目を埋める
									<ul>
										<li>ユーザID : 5〜30文字の半角英数字</li>
										<li>パスワード : 6文字以上かつ半角英小文字,半角英大文字,数字を混在させたもの</li>
										<li>確認用パスワード : 再度パスワードを入力する</li>
									</ul>
								</li>
								<li>入力終了後、「登録する」ボタンを押す</li>
								<li>入力の注意に沿って入力がされていなければ、エラーが出力されるので、再度入力をする</li>
								<li>「登録が完了しました」で登録が完了し、自動的に<a href="#2">会員詳細情報編集</a>ページへ遷移する</li>
							</ol>
							<h3>SNSを使わずにログイン</h3>
							<ol>
								<li>ページ上部の項目「ログイン」を押す</li>
								<li>会員ログイン項目に登録した ユーザID と パスワード を入力する</li>
								<li>入力終了後、右下の「ログイン」ボタンを押す</li>
								<li>入力されたユーザIDとパスワードに誤りがあると、エラーが出力されるので、再度入力をする</li>
								<li>ログインが完了すると、自動的に<a href="#2">会員詳細情報編集</a>ページへ遷移する</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="12">
							<h3>SNSをつかって登録/ログイン</h3>
							<div id="121">
								<h4>Facebookをつかう</h4>
								<ol>
									<li>ページ上部の項目「ログイン」を押す</li>
									<li>SNS連帯の項目にあるFacebookアイコンを押す</li>
									<li>Facebook側での認証をする</li>
									<li>初回ログイン時は自動的に<a href="#2">会員詳細情報編集</a>ページへ遷移する</li>
									<li>2回目以降のログインの際は、同様にFacebookアイコンを押す</li>
								</ol>
							</div>
							<div id="122">
								<h4>Twitterをつかう</h4>
								<ol>
									<li>ページ上部の項目「ログイン」を押す</li>
									<li>SNS連帯の項目にあるTwitterアイコンを押す</li>
									<li>Twitter側での認証をする</li>
									<li>初回ログイン時は自動的に<a href="#2">会員詳細情報編集</a>ページへ遷移する</li>
									<li>2回目以降のログインの際は、同様にTwitterアイコンを押す</li>
								</ol>
							</div>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
					</div>

					<div id="2">
						<h2>マイページ</h2>
						<div id="21">
							<h3>会員詳細情報編集</h3>
							<h4>個人ステータスの登録</h4>
							　この項目は、SNS連帯ログインの場合表示されません
							<ul>
								<li>会員番号：あなたの会員番号</li>
								<li>性別：あなたの性別を選択</li>
								<li>年代：あなたの年代を選択</li>
							</ul>
							<h4>嗜好情報の入力</h4>
							　あなたが訪れたい観光スポットの評価度合いを５段階で入力してください
							<table id="table7765" border="1"><tr><td>満足度</td><td>(1)低い</td><td><---></td><td>(5)高い</td></tr><tr><td>アクセス</td><td>(1)困難</td><td><---></td><td>(5)容易</td></tr><tr><td>人混みの少なさ</td><td>(1)少ない</td><td><---></td><td>(5)多い</td></tr><tr><td>バリアフリー</td><td>(1)進んでいない</td><td><---></td><td>(5)進んでいる</td></tr><tr><td>コストパフォーマンス</td><td>(1)低い</td><td><---></td><td>(5)高い</td></tr><tr><td>雰囲気</td><td>(1)悪い</td><td><---></td><td>(5)良い</td></tr><tr><td>快適度</td><td>(1)少ない</td><td><---></td><td>(5)多い</td></tr><tr><td>おすすめ度</td><td>(1)低い</td><td><---></td><td>(5)高い</td></tr></table><style type="text/css"><!-- #table7765{text-align:left;border:solid 1px #ffffff;border-collapse:collapse}#table7765>tbody>tr>td{border:solid 1px #ffffff;padding:4px;min-width:60px} --></style>
							記入後、「登録する」ボタンを押す<br><br>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="22">
							<h3>グループ登録・編集</h3>
							　観光スポットに訪れるグループの編集を行います
							<ol>
								<li>項目ごとに該当する<font color="red">会員番号</font>を<font color="red">半角数字</font>入力する<br>(空欄でも構いません)</li>
								<li>登録を完了するために「登録する」ボタンを押す</li>
								<li>入力にエラーが発生した場合、エラー内容にしたがって再度登録をする</li>
								<li>「登録が完了しました」と出力されれば登録が完了</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<div id="23">
							<h3>パスワード変更(SNSを使わないログインを行っている方のみ)</h3>
							　パスワードの変更を行います
							<ol>
								<li>項目に従って入力をする
									<ul>
										<li>旧パスワード: 5〜30文字の半角英数字</li>
										<li>新パスワード: 6文字以上かつ半角英[小文字/大文字],数字を混在させたもの</li>
										<li>新パスワード(確認用): 再度新パスワードを入力</li>
									</ul>
								</li>
								<li>入力完了後「変更する」ボタンを押す</li>
								<li>入力にエラーが発生した場合、エラー内容に従って入力を変更する</li>
								<li>「登録が完了しました」と出力されれば変更完了</li>
							</ol>
							<a class="button" href="#index">▲ 目次に戻る</a>
						</div>
						<br>
						<!--<div id="24">
							<h3>アンケートに答える(調整中)</h3>
							<p><font color="red">この項目の選択は一度しかできません<br>
								推薦システムを利用後に回答をおねがいします</font><br>
								選択後、外部サイトに遷移します<br>
								今後の研究の発展のために、ぜひ回答をお願いします<br>
							</p>
						</div>-->
						<a class="button" href="#index">▲ 目次に戻る</a>
					</div>

					<div id="3">
						<h2>観光スポット閲覧</h2>
						<p>　観光スポットの情報をカテゴリーごとに見ることができます</p>
						<div id="31">
							<h3>観光スポットの選択</h3>
							<ol>
								<li>カテゴリーを選択する<br>「その他」にはイベント情報等が分類されている</li>
								<li>登録されている観光スポットの情報が一覧となって表示される</li>
								<li>詳細情報を閲覧したい観光スポットの名前のリンクを押す</li>
							</ol>
						</div>
						<br>
						<div id="32">
							<h3>観光スポットの詳細情報</h3>
							<table cellpadding="4" style="border-collapse:collapse;text-align:left"><tr><td>スポット名</td><td>：</td><td>スポットの名前</td></tr><tr><td>カテゴリー</td><td>：</td><td>スポットが該当するカテゴリー</td></tr><tr><td>紹介文</td><td>：</td><td>スポットについての詳細文</td></tr><tr><td>参考URL</td><td>：</td><td>スポットの外部サイトリンク</td></tr><tr><td>レビュー</td><td>：</td><td><a href="#33">観光スポットのレビューの投稿</a>へのリンク</li></td></tr></table>
						</div>
						<br>
						<div id="33">
							<h3>観光スポットのレビューの投稿</h3>
							<p>行ったことのある観光スポットについて、下記の項目に従って評価をお願いします<br>このレビューは観光スポットを推薦するための評価値として使われます</p>
							<table id="table7765" border="1"><tr><td>満足度</td><td>(1)低い</td><td><---></td><td>(5)高い</td></tr><tr><td>アクセス</td><td>(1)困難</td><td><---></td><td>(5)容易</td></tr><tr><td>人混みの少なさ</td><td>(1)少ない</td><td><---></td><td>(5)多い</td></tr><tr><td>バリアフリー</td><td>(1)進んでいない</td><td><---></td><td>(5)進んでいる</td></tr><tr><td>コストパフォーマンス</td><td>(1)低い</td><td><---></td><td>(5)高い</td></tr><tr><td>雰囲気</td><td>(1)悪い</td><td><---></td><td>(5)良い</td></tr><tr><td>快適度</td><td>(1)少ない</td><td><---></td><td>(5)多い</td></tr><tr><td>おすすめ度</td><td>(1)低い</td><td><---></td><td>(5)高い</td></tr></table><style type="text/css"><!-- #table7765{text-align:left;border:solid 1px #ffffff;border-collapse:collapse}#table7765>tbody>tr>td{border:solid 1px #ffffff;padding:4px;min-width:60px} --></style>
							すべての項目について入力が完了したら、「投稿する」ボタンを押す
						</div>
						<a class="button" href="#index">▲ 目次に戻る</a>
					</div>

					<div id="4">
						<h2>観光スポットの推薦</h2>
						<p>　嗜好にあった観光スポットを推薦します</p>
						<div id="41">
							<h3>推薦項目の入力</h3>
							<ol>
								<li>観光するグループを選択する<br>グループについては<a href="#22">グループ登録・編集</a>を参照</li>
								<li>推薦して欲しい観光スポットのカテゴリーを選択する<br>なお、「その他」にはイベント情報等が分類されています</li>
								<li>観光の際に重視する項目を１つ選択する<br>デフォルトでは「何も重視しない」が選択されています</li>
								<li>1〜3の項目をすべて選択し終えたら、「送信」ボタンを押す<br>エラー内容が出た場合は、再度入力をする</li>
							</ol>
						</div>
						<div id="42"><h3>推薦された観光スポットの表示</h3>
							<p>あなたにおすすめする観光スポットを表示する<br>地図上にあるマーカーを押すと
								<ul>
									<li>名前</li>
									<li>分類(カテゴリー)</li>
									<li><a href="#32">詳細情報</a>へのリンク</li>
								</ul>
								が地図上に表示される<br>
								<font color="red">(注意) 画面をスクロールしてから地図を押すると正常な位置にポップが表示されません</font><br>
								地図の下のテーブル内には「推薦スポット一覧」を表示<br>
								テーブル内の名前のリンクからも<a href="#32">詳細情報</a>へ飛ぶことができる
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