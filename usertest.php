<?php
echo substr('abcdef', 1);       // 実行結果１ : bcdef
 
echo substr('あいうえお', 2,2); // 実行結果２ : ?? ※文字エンコーディングを指定できないので文字化けします。
 
echo substr('scenelive', 1);     // 実行結果３ : cenelive
 
echo substr('scenelive', 1, 3);  // 実行結果４ : cen
 
echo substr('scenelive', 0, 4);  // 実行結果５ : scen
 
echo substr('scenelive', 0, 8);  // 実行結果６ : sceneliv
 
echo substr('scenelive', -1, 1); // 実行結果７ : e
 
echo substr('scenelive', -5, -2); // 実行結果８ : eli
 
echo mb_substr('シーンライブ', 0, 4,"UTF-8");  // 実行結果９ : シーンラ
 
echo mb_substr('シーンライブ', 0, 6,"UTF-8");  // 実行結果１０ : シーンライブ
 
echo mb_substr('シーンライブ', -2, 2,"UTF-8"); // 実行結果１１ : イブ
 
echo mb_substr('scenelive', 0, 4); // 実行結果１２ : scen

phpinfo();

?>