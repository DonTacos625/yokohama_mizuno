<?php
// コンテンツがjpeg画像であることをブラウザにお知らせ 
function thumbnail($image){
header ('Content-Type: image/jpeg');

// オリジナル画像のファイルパスを指定

// getimagesize関数 オリジナル画像の横幅・高さを取得
list($original_width, $original_height) = getimagesize($image);

// サムネイルの横幅を指定
$thumb_width = 200;

// サムネイルの高さを算出 round関数で四捨五入
$thumb_height = round( $original_height * $thumb_width / $original_width );

// オリジナルファイルの画像リソース
$original_image = imagecreatefromjpeg($image);

// サムネイルの画像リソース
$thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);

// サムネイル画像の作成
imagecopyresized($thumb_image, $original_image, 0, 0, 0, 0,
                 $thumb_width, $thumb_height,
                 $original_width, $original_height);

// サムネイル画像の出力
imagejpeg($thumb_image);

// 画像リソースを破棄
imagedestroy($original_image);
imagedestroy($thumb_image);
}
?>