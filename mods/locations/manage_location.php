<?php
	if(isset($_SESSION['volunteer_id'])) {
	

	
		//echo $current_location_address;
	
		if($_POST['submit'] == 'Submit Form') {
		
			$warn = array();
			$suc = array();
				
			//CHECK IF A LOCATION WITH THAT NAME EXISTS
			$sql = "SELECT * FROM locations WHERE location_name = '$_POST[location_name]'";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);
			echo mysql_error();
			
			if($count >= 2) {
			
				$warn[] = 'A Location with the name specified already exists.';
			
			} else {
			
			$suc[] = 'The Location was successfully updated.';
			$sql = "UPDATE locations SET location_name='$_POST[location_name]', location_address='$_POST[location_address]'";
			
			mysql_query($sql);
			//echo mysql_error();
			
			}
			
			if(count($warn)) {
				echo '<div class="warning">';
				echo implode('<br />', $warn);
				echo '</div>';
						
			}
			
			if(count($suc)) {
				echo '<div class="success">';
				echo implode('<br />', $suc);
				echo '</div>';
						
			}
		
		}
		
		//GET LOCATION INFORMATION
		
		$sql = "SELECT * FROM locations WHERE location_id = '$_GET[id]'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		echo mysql_error();
		
		$current_location_name = $result['location_name'];
		$current_location_address = $result['location_address'];
		
		
		
	
?>

<div id="section_470_left">
	<h4>Location Details<h4>
	<hr />
	<form name="add_location" action="" method="POST">
		<table>
			<tr><th align="right">Name:</th><td><input type="text" name="location_name" id="input_full" class="k-textbox" value="<?php echo $current_location_name; ?>" required /></td></tr>
			<tr><th align="right">Address:</th><td><textarea class="k-textbox" name="location_address" id="textarea_full_100"><?php echo $current_location_address; ?></textarea></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Submit Form" class="k-button" /></td></tr>
		</table>
	</form>
</div>

<?php 

} else {

	echo 'You do not have access to this resource.';

}