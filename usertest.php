<?php
echo mb_substr('シーンライブ', 0, 4,"UTF-8");  // 実行結果９ : シーンラ
 
echo mb_substr('シーンライブ', 0, 6,"UTF-8");  // 実行結果１０ : シーンライブ
 
echo mb_substr('シーンライブ', -2, 2,"UTF-8"); // 実行結果１１ : イブ
 
echo mb_substr('scenelive', 0, 4); // 実行結果１２ : scen

?>