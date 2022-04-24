<?php
if(isset($_SESSION['volunteer_id'])) {

		//RESET PASSWORD!
		if($_POST['submit'] == 'Change Password') {
		
			$warn = array();
			$suc = array();
			
			
			if(strlen($_POST['new_password']) < 4) {
				$warn[] = 'Your password is not long enough.';
			}			
			if($_POST['new_password'] != $_POST['confirm_password']) {
			
				$warn[] = 'The password did not match.';
			
			}
			
			if(!count($warn)) {
			
				$volunteer_password = md5($_POST['new_password']);
			
				$password = mysql_real_escape_string($_POST['new_password']);
				//$volunteer_id = $_GET['id'];
				
				$suc[] = 'Your password has been changed';
				
				$sql = "UPDATE volunteers SET volunteer_password = '$volunteer_password', volunteer_force_password_change = '2' WHERE volunteer_id = '$_SESSION[volunteer_id]'";
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
	
	if($force_password_change == '1') {
		echo '<div class="info">';
		echo 'Hello! You need to change your password before you can continue.';
		echo '</div>';
	}
?>

<div id="section_470_left">
	<h4>Input a New Password</h4>
	<hr />
	<form name="change_password" method="post" action="">
		<table>
		<tr><th align="right">New Password:</th><td><input type="password" name="new_password" class="k-textbox" id="input_full" /></td></tr>
		<tr><th align="right">Confirm Password:</th><td><input type="password" name="confirm_password" class="k-textbox" id="input_full" /></td></tr>
		<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Change Password" class="k-button" /></td></tr>
		
		</table>
	</form>
</div>

<?php
} else {
	echo 'You do not have access to this page';
}
?>