

<div id="section_470_left">
	<h4>Thank you for Volunteering!</h4>
	<hr />
	<form name="login" method="post" action="">
	<table>
		<tr><th align="right">Email:</th><td><input type="text" name="volunteer_email" class="k-textbox" id="input_full" required /></td></tr>
		<tr><th align="right">Password:</th><td><input type="password" name="volunteer_password" class="k-textbox" id="input_full" required /></td></tr>
		<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Login!" class="k-button" /></td></tr>
	</table>
	</form>
	<br />

</div>
<div id="section_470_right">
<h4>News & Information</h4>
<hr/>
	<?php
	$today = date('Y-m-d');
	$sql = "SELECT * FROM news WHERE (login_dashboard = '1' OR login_dashboard = '2') AND date_end > '$today' ORDER BY date_end";
	$result = mysql_query($sql);
	echo mysql_error();
	$num = mysql_num_rows($result);
	$i = 0;
	while ($i < $num) {
		
		$data = mysql_result($result, $i, "data");
		
		echo $data;
		echo '<br />';
		echo '<br />';
		
		$i++;
	}
	
	?>
</div>
<div id="clear"></div>