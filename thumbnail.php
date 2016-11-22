<?php
// コンテンツがPNG画像であることをブラウザにお知らせ 
header ('Content-Type: image/png');

// オリジナル画像のファイルパスを指定
$original_file = 'images/sakura.png';

// getimagesize関数 オリジナル画像の横幅・高さを取得
list($original_width, $original_height) = getimagesize($original_file);

// サムネイルの横幅を指定
$thumb_width = 200;

// サムネイルの高さを算出 round関数で四捨五入
$thumb_height = round( $original_height * $thumb_width / $original_width );

// オリジナルファイルの画像リソース
$original_image = imagecreatefrompng($original_file);

// サムネイルの画像リソース
$thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);

// サムネイル画像の作成
imagecopyresized($thumb_image, $original_image, 0, 0, 0, 0,
                 $thumb_width, $thumb_height,
                 $original_width, $original_height);

// サムネイル画像の出力
return imagepng($thumb_image);

// 画像リソースを破棄
imagedestroy($original_image);
imagedestroy($thumb_image);
?>