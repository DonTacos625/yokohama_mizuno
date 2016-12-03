<!--左サイドメニュー-->
<div class="subinfo">
	<div class="label">推薦項目</div>
	<ul>
		<?php
		echo "グループ";
		echo "<ul><li>";
		if($relation==1){
			echo "家族";
		}else if($relation==2){
			echo "恋人/夫婦";
		}else if($relation==3){
			echo "友達グループ1";
		}else if($relation==4){
			echo "友達グループ2";
		}else{
			echo "一人";
		}
		echo "</li></ul>";
		echo "カテゴリー";
		echo "<ul>";
		for($i=0;$i<6;$i++){
			if($categorycheck[$i]!=0){
				if($categorycheck[$i]==1){
					echo "<li>飲食</li>";
				}else if($categorycheck[$i]==2){
					echo "<li>ショッピング</li>";
				}else if($categorycheck[$i]==3){
					echo "<li>テーマパーク・公園</li>";
				}else if($categorycheck[$i]==4){
					echo "<li>名所・史跡</li>";
				}else if($categorycheck[$i]==5){
					echo "<li>芸術・博物館</li>";
				}else{
					echo "<li>その他</li>";
				}
			}
		}
		echo "</ul>";
		echo "重視する項目";
		echo "<ul><li>";
		if($point==0)echo "何も重視しない";
		if($point==1)echo "満足度";
		if($point==2)echo "アクセスのしやすさ";
		if($point==3)echo "人混みの少なさ";
		if($point==4)echo "バリアフリー";
		if($point==5)echo "コストパフォーマンス";
		if($point==6)echo "雰囲気";
		if($point==7)echo "快適度";
		if($point==8)echo "おすすめ度";
		echo "</li></ul>";
		?>
	</ul>
</div>

