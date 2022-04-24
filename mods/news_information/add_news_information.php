<?php
if(isset($_SESSION['volunteer_id'])) {

	if($_POST['submit'] == 'Submit') {
	
		$err = array();
		$suc = array();
		
		$news_len = strlen($_POST['news']);
		if($news_len < 5) {
			$err[] = 'The news item does not contain enough charaters (5), to be created.';
		}
		if($_POST['date_start'] == '') {
			$err[] = 'You must select a start date.';
		}
		if($_POST['date_end'] == '') {
			$err[] = 'You must select an end date.';
		}
		if($_POST['login_dashboard'] == 'null') {
			$err[] = 'You must select Where to Diplay the Item...';	
		}
		
		if(count($err)) {
			echo '<div class="warning">';
			echo implode('<br />', $err);
			echo '</div>';
		}
		
		if(!count($err)) {
		
			$suc[] = 'The item has sucessfully been added.';
			
			$news = mysql_real_escape_string($_POST['news']);
			$date_start = $_POST['date_start'];
			$date_end = $_POST['date_end'];
			$login_dashboard = $_POST['login_dashboard'];
			
			$sql = "INSERT INTO news (date_start, date_end, data, login_dashboard) "
			."VALUES ('$date_start', '$date_end', '$news', '$login_dashboard')";
			mysql_query($sql);
			echo mysql_error();
		
		}
		
		if(count($suc)) {
			echo '<div class="success">';
			echo implode('<br />', $suc);
			echo '</div>';
		}
	
	}

?>

	<h4>News & Information Details</h4>
	<hr />
	<form name="add_news" method="post" action="" />
		<table>
			<tr><th colspan="3">Information to Display</th></tr>
			<tr><td colspan="3"><textarea name="news" class="k-textbox" id="textarea_full_200"></textarea></td></tr>
			<tr><th>Start Date</th><th>End Date</th><th>Where to Display?</th></tr>
			<tr><td><input type="date" name="date_start" id="date_start" /></td><td><input type="date" name="date_end" id="date_end" /></td>
			<td>
				<select name="login_dashboard">
					<option value="null">Please select...</option>
					<?php
					$sql = "SELECT * FROM news_display_states";
					$result = mysql_query($sql);
					echo mysql_error();
					$num = mysql_num_rows($result);
					$i = 0;
					while ($i < $num) {
					
						$news_display_state_id = mysql_result($result, $i, "news_display_state_id");
						$news_display_state = mysql_result($result, $i, "news_display_state");
						
						echo '<option value="'.$news_display_state_id.'">'.$news_display_state.'</option>';
					
					
					$i++;
					}
					?>
				</select>
			</td>
			</tr>
			<tr><td colspan="3"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
		</table>
	</form>

<script>
$(document).ready(function(){
	$("#date_start").kendoDatePicker({ format: "yyyy-MM-dd" });
	$("#date_end").kendoDatePicker({ format: "yyyy-MM-dd" });

});
</script>

<?php
} else {
	echo 'You do not have access to this resource.';
}
?>