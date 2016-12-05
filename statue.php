<table align="center" border="0" cellspacing="3" cellpadding="3"  width="600px">
	<tr><div class="label3" align="center">個人ステータスの登録</div></tr>
	<tr>
		<td align="center" ><div class="label3">会員番号</div></td>
		<td><font size=5><?=$my_no ?></font></td>
	</tr>
	<tr><td align="center"><div class="label3">性別</div></td>
		<td>
			<input type="radio" name="gender" value="male"<?php if ($gender!="female"){ print " checked"; }?> >男
			<input type="radio" name="gender" value="female"<?php if ($gender=="female"){ print " checked"; }?> >女
		</td>
	</tr>
	<tr>
		<td align="center">
			<div class="label3">年代</div>
		</td>
		<td>
			<input type="radio" name="age" value="10"<?php if ($age!=20&&$age!=30&&$age!=40&&$age!=50&$age!=60){ print " checked"; }?> >10
			<input type="radio" name="age" value="20"<?php if ($age==20){ print " checked"; }?> >20
			<input type="radio" name="age" value="30"<?php if ($age==30){ print " checked"; }?> >30
			<input type="radio" name="age" value="40"<?php if ($age==40){ print " checked"; }?> >40
			<input type="radio" name="age" value="50"<?php if ($age==50){ print " checked"; }?> >50
			<input type="radio" name="age" value="60"<?php if ($age==60){ print " checked"; }?> >60以上
		</td>
	</tr>
</table>
<br>