<?php
if(isset($_SESSION['volunteer_id'])) {


	$report_name = $_GET['id'];
	$generated_date = date('d-m-Y');
	
	//GET report display name
	$sql = "SELECT * FROM reports WHERE report_name = '$report_name'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$report_display_name = $result['report_display_name'];
	$report_path = $result['report_path'];
	
	include('mods/'.$report_path);
	

	
} else {
	echo 'You do not have access to this resource.';
}
?>