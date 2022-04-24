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
			
			$sql = "SELECT * FROM ethnicities WHERE ethnicity_id != '$_GET[id]' AND ethnicity_name = '$ethnicity_name'";
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
		
			$sql = "UPDATE ethnicities SET ethnicity_name='$ethnicity_name' WHERE ethnicity_id = '$_GET[id]'";
			mysql_query($sql);
			echo mysql_error();
			
			echo '<div class="success">';
			echo 'The Ethnicity has been updated.';
			echo '</div>';
			
			}
		
		}
		
	$sql = "SELECT * FROM ethnicities WHERE ethnicity_id = '$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$ethnicity_name = $result['ethnicity_name'];
	echo mysql_error();
?>
<div id="section_470_left">
	<h4>Ethnicity Details</h4>
	<hr />
	<form name="manage_ethnicity" method="post" action="">
		<table>
			<tr><th align="right">Ethnicity Name:</th><td><input type="text" name="ethnicity_name" id="input_full" class="k-textbox" value="<?php echo $ethnicity_name; ?>" /></td></tr>
			<tr><td align="right" colspan="2"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
		</table>
	</form>
</div>
<?php
	} else {
		echo 'You do not have access to this resource.';
	}