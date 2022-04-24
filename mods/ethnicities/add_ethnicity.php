<?php
	if(isset($_SESSION['volunteer_id'])) {
		if($_POST['submit'] == 'Submit') {
		
			$ethnicity_name = $_POST['ethnicity_name'];
			$ethnicity_name = mysql_real_escape_string($ethnicity_name);
			
			$err = array();
			$suc = array();
			
			if(strlen($ethnicity_name) < 1) {
			
				$err[] = 'The Ethnicity Name can not be blank.';
			
			}
			
			$sql = "SELECT * FROM ethnicities WHERE ethnicity_name = '$ethnicity_name'";
			$num = mysql_num_rows(mysql_query($sql));
			
			if($num >= 1) {
			
				$err[] = 'An Ethnicity with that name is already in the database.';
			
			}
			
			if(count($err)) {
			
				echo '<div class="error">';
				echo implode('<br />', $err);
				echo '</div>';
			
			}
			
			if(!count($err)) {
		
				$sql = "INSERT INTO ethnicities (ethnicity_name) VALUES ('$ethnicity_name')";
				mysql_query($sql);
				echo mysql_error();
			
				echo '<div class="success">';
				echo 'The Ethnicity has been created.';
				echo '</div>';
			
			}
		
		}
?>
<div id="section_470_left">
	<h4>Ethnicity Details</h4>
	<hr />
	<form name="add_ethnicity" method="post" action="">
		<table>
			<tr><th align="right">Ehtnicity Name:</th><td><input type="text" name="ethnicity_name" id="input_full" class="k-textbox" /></td></tr>
			<tr><td align="right" colspan="2"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
		</table>
	</form>
</div>
<?php
	} else {
		echo 'You do not have access to this resource.';
	}