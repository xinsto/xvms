<?php
	define('INCLUDE_CHECK',true);
	include 'config/connect.php';
	include 'config/get_application_settings.php';
	
	
	session_name('PHPVolunteerManagent');
	session_start();


	//Check to see if the users needs to reset thier password before doing anything else...
	if(isset($_SESSION['volunteer_id'])) {
		$sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_SESSION[volunteer_id]'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		echo mysql_error();
		$force_password_change = $result['volunteer_force_password_change'];
		if($force_password_change == '1') {
			if($_GET['p'] != 'change_password') {
				header('Location: ?p=change_password');
			}
		}
	}

	if(!isset($_SESSION['volunteer_id'])) {
		if($_GET['p'] !='login') {
			header('Location: ?p=login');
		}
	}
	
	if(isset($_SESSION['volunteer_id'])) {
		if(!isset($_GET['p'])) {
			header('Location: ?p=dashboard');
		}
	}
	
	if($_GET['p'] == 'logoff') {
		session_start();
		session_destroy();
		header('Location: ?p=login');
	}
	
	include 'mods/login/process_login.php';

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<link rel="icon" 
      type="image/png" 
      href="img/icons/VMS.png">
	<head>
		<title><?php echo $title; ?> | <?php echo $organization_name; ?></title>
		<link href="css/styles.css" rel="stylesheet"/>
		<link href="css/messages.css" rel="stylesheet"/>
        <link href="css/kendo/kendo.common.min.css" rel="stylesheet"/>
        <link href="css/kendo/kendo.silver.min.css" rel="stylesheet"/>
        <script src="js/kendo/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/kendo/kendo.all.min.js"></script>
	</head>

	<body>


