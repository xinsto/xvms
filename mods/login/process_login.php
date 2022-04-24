<?php
if($_POST['submit'] == 'Login!') {

	$volunteer_email = mysql_real_escape_string($_POST['volunteer_email']);
	$volunteer_password = mysql_real_escape_string($_POST['volunteer_password']);
	
	$password = md5($_POST['volunteer_password']);
	
	$sql = "SELECT * FROM volunteers WHERE volunteer_email = '$volunteer_email' AND volunteer_password = '$password'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$_SESSION['volunteer_id'] = $result['volunteer_id'];
	$_SESSION['volunteer_acl_id'] = $result['volunteer_acl_control_id'];
	$_SESSION['volunteer_first_name'] = $result['volunteer_first_name'];
	$_SESSION['volunteer_last_name'] = $result['volunteer_last_name'];
	
	if(isset($_SESSION['volunteer_id'])) {
		header('Location: ?p=dashboard');
		echo $_SESSION['volunteer_id'];
	} else {
		//echo '<div class="error">That email address and password combination where not found in the system.</div>';
	}

}
?>