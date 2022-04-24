<?php
	if(isset($_SESSION['volunteer_id'])) {
		if($_POST['submit'] == 'Submit') {
		
			$sql = "INSERT INTO work_types (work_type_name) VALUES ('$_POST[work_type_name]')";
			mysql_query($sql);
			echo mysql_error();
			
			echo '<div class="success">';
			echo 'The Work Type has been created.';
			echo '</div>';
		
		}
?>
<div id="section_470_left">
	<h4>Work Type Details</h4>
	<hr />
	<form name="add_work_type" method="post" action="">
		<table>
			<tr><th align="right">Work Type:</th><td><input type="text" name="work_type_name" id="input_full" class="k-textbox" /></td></tr>
			<tr><td align="right" colspan="2"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
		</table>
	</form>
</div>
<?php
	} else {
		echo 'You do not have access to this resource.';
	}