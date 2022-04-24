<?php

	//GET THE ORGANIZATION_NAME FROM DB
	$sql = "SELECT application_setting FROM application_settings WHERE application_setting_name = 'organization_name'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$organization_name = $result['application_setting'];
	
	//GET THE TITLE FROM DB
	$sql = "SELECT application_setting FROM application_settings WHERE application_setting_name = 'title'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$title = $result['application_setting'];
	
	//GET THE VERSION FROM DB
	$sql = "SELECT application_setting FROM application_settings WHERE application_setting_name = 'version'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$version = $result['application_setting'];


	

?>