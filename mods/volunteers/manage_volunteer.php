<?php
	if(isset($_SESSION['volunteer_id'])) {
	if($_POST['submit'] == 'Submit Form') {
	
		$err = array();
		$suc = array();
		$warn = array();
		
		$volunteer_id = $_GET['id'];
		$volunteer_firstname = mysql_real_escape_string($_POST['volunteer_firstname']);
		$volunteer_lastname = mysql_real_escape_string($_POST['volunteer_lastname']);
		$volunteer_ethnicity = mysql_real_escape_string($_POST['volunteer_ethnicity']);
		$volunteer_sex = mysql_real_escape_string($_POST['volunteer_sex']);
		$volunteer_acl_control_id = mysql_real_escape_string($_POST['volunteer_acl_control_id']);
		
		//UPDATE THE VOLUNTEERS TABLE
		$sql = "UPDATE volunteers SET volunteer_first_name = '$volunteer_firstname', volunteer_last_name = '$volunteer_lastname',"
		." volunteer_sex_id = '$volunteer_sex', volunteer_ethnicity_id = '$volunteer_ethnicity', volunteer_acl_control_id = '$volunteer_acl_control_id'"
		." WHERE volunteer_id = '$volunteer_id'";
		mysql_query($sql);
		echo mysql_error();
		
		
		//UPDATE THE VOLUNTEERS DETAILS TABLE
		$sql = "SELECT * FROM volunteer_detail_items ORDER BY volunteer_detail_weight";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		$i = 0;
		while ($i < $num) {		
		
			$volunteer_detail_item_common_name = mysql_result($result, $i, "volunteer_detail_item_common_name");
			$data_from_post = mysql_real_escape_string($_POST[$volunteer_detail_item_common_name]);
			
			$sql_a = "UPDATE volunteer_details SET volunteer_detail_data = '$data_from_post' WHERE volunteer_detail_item_common_name = '$volunteer_detail_item_common_name' AND volunteer_detail_volunteer_id = '$volunteer_id'";
			
			mysql_query($sql_a);
			echo mysql_error();
			
			$i++;
		}

			echo '<div class="success">';
			echo 'The information for the Volunteer has been updated.';
			echo '</div>';

	}
	
	//GET Volunteer INFORMATION
	
	$sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$volunteer_first_name = $result['volunteer_first_name'];
	$volunteer_last_name = $result['volunteer_last_name'];
	$volunteer_date_of_birth = $result['volunteer_date_of_birth'];
	$volunteer_sex_id = $result['volunteer_sex_id'];
	$volunteer_ethnicity_id = $result['volunteer_ethnicity_id'];
	$volunteer_acl_control_id = $result['volunteer_acl_control_id'];
?>
<form name="add_volunteer" method="post" action="">
	<div id="section_470_left">

			<a href="?p=manage_volunteers" class="k-button">Manage Volunteers</a>
		<h3>Required Details</h3>
		<hr />
		<table>
			<tr><th align="right">First Name:</th><td colspan="3"><input type="text" name="volunteer_firstname" value="<?php echo $volunteer_first_name; ?>" class="k-textbox" id="input_full" required /></tr>
			<tr><th align="right">Last Name:</th><td colspan="3"><input type="text" name="volunteer_lastname" value="<?php echo $volunteer_last_name; ?>"class="k-textbox" id="input_full" required /></tr>
			<tr><th align="right">Date of Birth:</th><td><input type="date" name="volunteer_date_of_birth" value="<?php echo $volunteer_date_of_birth; ?>" id="dateOfBirth" required data-email-msg="A DOB is a must!" /></td><th>Ethnicity:</th>
				<td width="140">
				<select name="volunteer_ethnicity" id="input_full">
				<?php
				$sql = "SELECT * FROM ethnicities WHERE ethnicity_id = '$volunteer_ethnicity_id'";
				$result = mysql_fetch_assoc(mysql_query($sql));
				$current_ethnicity_id = $result['ethnicity_id'];
				$current_ethnicity_name = $result['ethnicity_name'];
				?>
				<option value="<?php echo $current_ethnicity_id; ?>"><?php echo $current_ethnicity_name; ?></option>
				<?php
				$sql = "SELECT * FROM ethnicities WHERE ethnicity_id !='$volunteer_ethnicity_id'";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);
				$i = 0;
				while ($i < $num) {
					$ethnicity_id = mysql_result($result, $i, "ethnicity_id");
					$ethnicity = mysql_result($result, $i, "ethnicity_name");
					
					echo '<option value="'.$ethnicity_id.'">'.$ethnicity.'</option>';
					$i++;
				}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<th>Access Level:</th>
				<td>
				<select name="volunteer_acl_control_id" id="input_full">
				<?php
				$sql = "SELECT * FROM acl_controls WHERE acl_control_id = '$volunteer_acl_control_id'";
				$result = mysql_fetch_assoc(mysql_query($sql));
				$current_acl_control_id = $result['acl_control_id'];
				$current_acl_control_name = $result['acl_control_name'];
				?>
				<option value="<?php echo $current_acl_control_id; ?>"><?php echo $current_acl_control_name; ?></option>
				<?php
				$sql = "SELECT * FROM acl_controls WHERE acl_control_id != '$volunteer_acl_control_id'";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);
				$i = 0;
				while ($i < $num) {
					$acl_control_id = mysql_result($result, $i, "acl_control_id");
					$acl_control_name = mysql_result($result, $i, "acl_control_name");
					
					echo '<option value="'.$acl_control_id.'">'.$acl_control_name.'</option>';
					
					$i++;
				}
				?>
				</select>
				</td>
				<th align="right">Sex:</th>
				<td>
				<select name="volunteer_sex" id="input_full">
				<?php
				$sql = "SELECT * FROM sexies WHERE sex_id = '$volunteer_sex_id'";
				$result = mysql_fetch_assoc(mysql_query($sql));
				$current_sex_id = $result['sex_id'];
				$current_sex_name = $result['sex_name'];
				?>
				<option value="<?php echo $current_sex_id; ?>"><?php echo $current_sex_name; ?></option>
				<?php
				$sql = "SELECT * FROM sexies WHERE sex_id !='$volunteer_sex_id'";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);
				$i = 0;
				while ($i < $num) {
					$sex_id = mysql_result($result, $i, "sex_id");
					$sex = mysql_result($result, $i, "sex_name");
					
					echo '<option value="'.$sex_id.'">'.$sex.'</option>';
					
					$i++;
				}
				?>
				</select>
				</td>
			</tr>
	
		</table>
		<h3>Options</h3>
		<hr />
		<table>
			<tr>
				<th>Manage Hours</th><td><a href="?p=manage_reported_hours&id=<?php echo $_GET['id']; ?>" class="k-button">Select</a></td>
				<th>Reset Password & Email</th><td><a href="?p=reset_volunteer_password&id=<?php echo $_GET['id']; ?>" class="k-button">Select</a></td>
			</tr>
			<tr>
				<th>Create Tasks</th><td><a href="?p=create_task&id=<?php echo $_GET['id']; ?>" class="k-button">Select</a></td>
				<th>Manage Documents</th><td><a href="?p=volunteer_documents&id=<?php echo $_GET['id']; ?>" class="k-button">Select</a></td>
			</tr>
			<tr><td></td><td></td><td colspan="2" align="right"><em id="important_small">** Documents stored here are only viewable by administrators.</em></td></tr>

		</table>
	</div>
	<div id="section_470_right">
		<h3>Custom Details</h3>
		<hr />
		<table>
			<?php
			$sql = "SELECT * FROM volunteer_detail_items ORDER BY volunteer_detail_weight";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$i = 0;
			while ($i < $num) {
			
				$volunteer_detail_item_common_name = mysql_result($result, $i, "volunteer_detail_item_common_name");
				$volunteer_detail_item_display_name = mysql_result($result, $i, "volunteer_detail_item_display_name");
				
				if(count($warn)) {
				

				echo '<tr><th align="right">'.$volunteer_detail_item_display_name.':</th><td><input type="text" name="'.$volunteer_detail_item_common_name.'" value="'.$_POST[$volunteer_detail_item_common_name].'" class="k-textbox" id="input_full" /></td></tr>';
				
				} else { 
				
					$detail = "SELECT volunteer_detail_data FROM volunteer_details WHERE volunteer_detail_volunteer_id = '$_GET[id]' AND volunteer_detail_item_common_name = '$volunteer_detail_item_common_name'";
					$detail_result = mysql_fetch_assoc(mysql_query($detail));
					
					$detail_data = $detail_result['volunteer_detail_data'];
					
				
					echo '<tr><th align="right">'.$volunteer_detail_item_display_name.':</th><td><input type="text" name="'.$volunteer_detail_item_common_name.'" class="k-textbox" value="'.$detail_data.'" id="input_full" /></td></tr>';
				}
				$i++;
			}
			?>
		</table>
	</div>
	
<div id="clear"></div>
<br />
<br />

<hr />

<br />
<br />

<input type="submit" name="submit" id="submit" value="Submit Form" class="k-button"/>
</form>
<script>
$(document).ready(function(){
	$("#dateOfBirth").kendoDatePicker({ format: "yyyy-MM-dd" });
    var validatable = $("#add_volunteer").kendoValidator().data("kendoValidator");
    	$("#submit").click(function() {
    		if (validatable.validate()) {
        		save();
         	}
	});

});
</script>
<?php 
} else { 
	echo 'You do not have access to this resource...';
} 
?>


<?php
	if(count($warn)) {
		unset($warn);
	}
	if(count($suc)) {
		unset($suc);
	}
?>