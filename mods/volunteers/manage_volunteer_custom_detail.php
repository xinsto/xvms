<?php
	if(isset($_SESSION['volunteer_id'])) {

	
	if($_POST['submit'] == 'Submit') {
	
		$warn = array();
		$suc = array();

		if($count >= 1) {
		
			$warn[] = 'A Custom Volunteer Detail already exists with that Common Name.';
		
		} else {
		
			$suc[] = 'The Custom Volunteer Detail has been updated.';
			
			$sql = "UPDATE volunteer_detail_items SET volunteer_detail_item_common_name = '$_POST[common_name]',"
			." volunteer_detail_item_display_name = '$_POST[display_name]', volunteer_detail_weight = '$_POST[weight]' WHERE volunteer_detail_item_common_name = '$_GET[id]'";
					
			mysql_query($sql);
			echo mysql_error();
			
			//UPDATE volunteer_details with the new field for each volunteer...
			$sql = "SELECT * FROM volunteers";
			$result = mysql_query($sql);
			echo mysql_error();
			$num = mysql_num_rows($result);
			echo mysql_error();
			$i = 0;
			
			while($i < $num) {
			
				$volunteer_id = mysql_result($result, $i, "volunteer_id");
				
				//echo $volunteer_id;
				
				$update = "UPDATE volunteer_details SET  volunteer_detail_item_common_name = '$_POST[common_name]' WHERE volunteer_detail_volunteer_id = '$volunteer_id'";
				mysql_query($update);
				echo mysql_error();
				
				$i++;
			}		
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
	
	//GET Custom Detail to manage
	$sql = "SELECT * FROM volunteer_detail_items WHERE volunteer_detail_item_common_name = '$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$volunteer_detail_item_common_name = $result['volunteer_detail_item_common_name'];
	$volunteer_detail_item_display_name = $result['volunteer_detail_item_display_name'];
	$volunteer_detail_weight = $result['volunteer_detail_weight'];
?>

	<div id="section_470_left">
		<a href="?p=manage_volunteers_custom_details" class="k-button">Manage Custom Details</a>
		<h4>Custom Detail</h4>
		<hr />
		<form name="add_custom_detail" action="" method="post">
			<table border="0">
				<tr><th align="right">Common Name:</th><td><input type="text" name="common_name" class="k-textbox" id="input_full" value="<?php echo $volunteer_detail_item_common_name; ?>" /></td></tr>
				<tr><td align="right" colspan="2"><em id="important_red">Please note: </em>The common name should be something unique.</td></tr>
				<tr><th align="right">Display Name:</th><td><input type="text" name="display_name" class="k-textbox" id="input_full" value="<?php echo $volunteer_detail_item_display_name; ?>" /></td></tr>
				<tr><td align="right" colspan="2"><em id="important_red">Please note: </em>The display name is what end users will see.</td></tr>
				<tr><th align="right">Weight:</th><td><input type="number" name="weight" class="k-textbox" id="input_full" value="<?php echo $volunteer_detail_weight; ?>" /></td></tr>
				<tr><td align="right" colspan="2"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
			</table>
		</form>
	</div>

<?php
} else {
	echo 'You do not have access to this resource.';
}
?>