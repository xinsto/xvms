<?php
	if(isset($_SESSION['volunteer_id'])) {
		
		//RESET PASSWORD!
		if($_POST['submit'] == 'Change Password') {
		
			$warn = array();
			$suc = array();
			
			if($_POST['new_password'] != $_POST['confirm_password']) {
			
				$warn[] = 'The password did not match.';
			
			} else {
			
				$suc[] = 'The Volunteers password has been changed.';
			
			}
			
			if(count($suc)) {
			
				$volunteer_password = md5($_POST['new_password']);
			
				$password = mysql_real_escape_string($_POST['new_password']);
				$volunteer_id = $_GET['id'];
				
				
				
				$sql = "UPDATE volunteers SET volunteer_password = '$volunteer_password', volunteer_force_password_change = '$_POST[require_rest]' WHERE volunteer_id = '$volunteer_id'";
				mysql_query($sql);
				echo mysql_error();
				
				echo '<div class="success">';
				echo implode('<br />', $suc);
				echo '</div>';
			
			}
			
			if(count($warn)) {
				echo '<div class="warning">';
				echo implode('<br />', $warn);
				echo '</div>';
						
			}
			
			

			
		
		}
		
			//CHANGE EMAIL ADDRESS
			
			$warn = array();
			$suc = array();
			
			if($_POST['submit'] == 'Change Email') {
			
				$new_email = mysql_real_escape_string($_POST['new_email']);
			
				$sql = "SELECT * FROM volunteers WHERE volunteer_email = '$new_email'";
				$result = mysql_query($sql);
				$count = mysql_num_rows($result);

				
				if($count >= 1) {
				
					$warn[] = 'That email address is already in use.';
				
				} else {
				
					$suc[] = 'The Volunteers email address has been changed.';
					$sql = "UPDATE volunteers SET volunteer_email = '$new_email' WHERE volunteer_id = '$_GET[id]'";
					mysql_query($sql);
					echo mysql_error();

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
		
		//GET VOLUNTEER WE ARE EDITITNG
		$sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_GET[id]'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		
		$volunteer_first_name = $result['volunteer_first_name'];
		$volunteer_last_name = $result['volunteer_last_name'];
		$volunteer_email = $result['volunteer_email'];
?>
<p><em id="important_red">for</em> : <?php echo $volunteer_last_name; ?>, <?php echo $volunteer_first_name; ?></p>
<div id="section_470_left">
	<h3>Reset Password</h3>
	<hr />
	<form name="rest_password" method="post" action="">
		<table>
			<tr><th align="right">New Password:</th><td><input type="password" name="new_password" class="k-textbox" id="input_full" required /></td><tr>
			<tr><th align="right">Confirm Password:</th><td><input type="password" name="confirm_password" class="k-textbox" id="input_full" required /></td><tr>
			<tr><th align="right">Require Password Change<em id="important_red">* at next login</em> :</th><td><input type="checkbox" value="1" name="require_rest" /></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Change Password" class="k-button" /></td></tr>
		</table>
	</form>
</div>

<div id="section_470_right">
	<h3>Change Email Address</h3>
	<hr />
	<form name="change_email" method="post" action="">
		<table>
			<tr><th align="right">Current Email:</th><td><input type="text" name="current_email" class="k-textbox" id="input_full" value="<?php echo $volunteer_email; ?>" required readonly /></td><tr>
			<tr><th align="right">New Email:</th><td><input type="text" name="new_email" class="k-textbox" id="input_full" required /></td><tr>
			<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Change Email" class="k-button" /></td></tr>
		</table>
	</form>
</div>
<div id="clear"></div>
<?php
} else {
	echo 'You do not have access to this resource';
}