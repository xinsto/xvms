<?php
	if(isset($_SESSION['volunteer_id'])) {
	if($_POST['submit'] == 'Submit Form') {
	
		$err = array();
		$suc = array();
		$warn = array();
		
		$volunteer_email = mysql_real_escape_string($_POST['volunteer_email']);
		$volunteer_password = mysql_real_escape_string($_POST['volunteer_password']);
		$volunteer_confirm_password = mysql_real_escape_string($_POST['volunteer_confirm_password']);		
		$volunteer_firstname = mysql_real_escape_string($_POST['volunteer_firstname']);
		$volunteer_lastname = mysql_real_escape_string($_POST['volunteer_lastname']);
		$volunteer_ethnicity = mysql_real_escape_string($_POST['volunteer_ethnicity']);
		$volunteer_sex = mysql_real_escape_string($_POST['volunteer_sex']);
		$volunteer_acl_control_id = mysql_real_escape_string($_POST['volunteer_acl_control_id']);
		
		$set_password = md5($volunteer_password);
		
		if($volunteer_password <> $volunteer_confirm_password) {
			$warn[] = 'The password used did not match!';
		}
		
		$sql = "SELECT * FROM volunteers WHERE volunteer_email = '$volunteer_email'";
		$count = mysql_num_rows(mysql_query($sql));
		
		if($count >= 1) {
			$warn[] = 'That email address is alreading being used!';
		}
		
		if($_POST['volunteer_ethnicity'] == 'null') {
			$warn[] = 'You must select an ethniticy to submit the form!';
		}
		
		if($_POST['volunteer_sex'] == 'null') {
			$warn[] = 'You must select a sex to submit the form!';
		}
		
		if($_POST['volunteer_acl_control_id'] == 'null') {
			$warn[] = 'You must select an Access Level to submit the form!';
		}
		
		if(count($warn)) {
			echo '<div class="warning">';
			echo implode('<br />', $warn);
			echo '</div>';
			//unset($warn);
		}
		
		if(!count($warn)) {
			$suc[] = 'The Volunteer has successfully been added to the system.';
		}
		
		if(count($suc)) {
			echo '<div class="success">';
			echo implode('<br />', $suc);
			echo '</div>';
			unset($suc);
			
			//ADD THE VOLUNTEER TO THE VOLUNTEERS TABLE
			
			$sql = "INSERT INTO volunteers (volunteer_email, volunteer_password, volunteer_first_name, volunteer_last_name, "
			."volunteer_ethnicity_id, volunteer_sex_id, volunteer_acl_control_id, volunteer_date_of_birth, volunteer_force_password_change)"
			." VALUES"
			." ('$volunteer_email', '$set_password', '$volunteer_firstname', '$volunteer_lastname', "
			."'$volunteer_ethnicity', '$volunteer_sex', '$volunteer_acl_control_id', '$_POST[volunteer_date_of_birth]', '$_POST[require_reset]')";
			
			mysql_query($sql);
			echo mysql_error();
			
			$new_volunteer_id = mysql_insert_id();
			
			//POPULATE THE DETAILS TABLE

			$sql = "SELECT * FROM volunteer_detail_items ORDER BY volunteer_detail_weight";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$i = 0;
			while ($i < $num) {		
			
				$volunteer_detail_item_common_name = mysql_result($result, $i, "volunteer_detail_item_common_name");
				$data_from_post = mysql_real_escape_string($_POST[$volunteer_detail_item_common_name]);
				
				$sql_a = "INSERT INTO volunteer_details (volunteer_detail_volunteer_id, volunteer_detail_item_common_name, volunteer_detail_data) "
				."VALUES ('$new_volunteer_id', '$volunteer_detail_item_common_name', '$data_from_post')";
				
				mysql_query($sql_a);
				echo mysql_error();
			
				$i++;
			}
		}
		
	}
?>
<form name="add_volunteer" method="post" action="">
	<div id="section_470_left">
		<a href="?p=manage_volunteers" class="k-button">Manage Volunteers</a>
		<h3>Login Information</h3>
		<hr />
		<table>
			<tr><th align="right" width="150">Email Address:</th><td><input type="email" name="volunteer_email" <?php if(count($warn)) { echo 'value="'.$_POST['volunteer_email'].'"'; } ?>class="k-textbox" id="input_full" required data-email-msg="Email format is not valid"/></td></tr>
			<tr><th align="right" width="150">Password:</th><td><input type="password" name="volunteer_password" <?php if(count($warn)) { echo 'value="'.$_POST['volunteer_password'].'"'; } ?>class="k-textbox" id="input_full" required /></td></tr>
			<tr><th align="right" width="150">Confirm Password:</th><td><input type="password" name="volunteer_confirm_password" <?php if(count($warn)) { echo 'value="'.$_POST['volunteer_confirm_password'].'"'; } ?>class="k-textbox" id="input_full" required /></td></tr>
			<tr><th align="right">Password Change<em id="important_red">* at next login</em> :</th><td><input type="checkbox" value="1" name="require_reset" /></td></tr>
		</table>
		<h3>Required Details</h3>
		<hr />
		<table>
			<tr><th align="right">First Name:</th><td colspan="3"><input type="text" name="volunteer_firstname" <?php if(count($warn)) { echo 'value="'.$_POST['volunteer_firstname'].'"'; } ?>class="k-textbox" id="input_full" required /></tr>
			<tr><th align="right">Last Name:</th><td colspan="3"><input type="text" name="volunteer_lastname" <?php if(count($warn)) { echo 'value="'.$_POST['volunteer_lastname'].'"'; } ?>class="k-textbox" id="input_full" required /></tr>
			<tr><th align="right">Date of Birth:</th><td><input type="date" name="volunteer_date_of_birth" <?php if(count($warn)) { echo 'value="'.$_POST['volunteer_date_of_birth'].'"'; } ?> id="dateOfBirth" required data-email-msg="A DOB is a must!" /></td><th>Ethnicity:</th>
				<td width="140">
				<select name="volunteer_ethnicity" id="input_full">
				<option value="null">Select One...</option>
				<?php
				$sql = "SELECT * FROM ethnicities";
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
				<option value="null">Select One...</option>
				<?php
				$sql = "SELECT * FROM acl_controls";
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
				<option value="null">Select One...</option>
				<?php
				$sql = "SELECT * FROM sexies";
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
				
					echo '<tr><th align="right">'.$volunteer_detail_item_display_name.':</th><td><input type="text" name="'.$volunteer_detail_item_common_name.'" class="k-textbox" id="input_full" /></td></tr>';
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
<p>Please fully complete the <em id="important_red">Login Information</em> and <em id="important_red">Required Details</em> sections before submitting this form.
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