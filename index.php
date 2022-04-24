<?php
include 'header.php';

if(isset($_GET['p'])) {
	//GET PAGE CONTENT TO DISPALY FROM mods TABLE
	$sql = "SELECT * FROM mods WHERE mod_name = '$_GET[p]' AND mod_active_inactive = '1'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$page_display_name = $result['mod_display_name'];
	$page_path = $result['mod_path'];
	$page_acl_control = $result['mod_acl_control_id'];
	$mod_type = $result['mod_type'];
	if($_SESSION['volunteer_acl_id'] >= $page_acl_control || $_GET['p'] == 'login') {
		if($mod_type != '3') {	
			include 'mods/menu/menu.php';
			echo '<div id="content">';
			echo '<h2 id="page_title">'.$page_display_name.'</h2>';
			echo '<div id="clear"></div>';
		}
	
		include 'mods/'.$page_path;
	
		if($mod_type != '3') {	
			echo '</div>';
		}
	} else {
		echo '<div id="section_960">';
		echo '<div class="error">';
		echo '<p>You do not have access to this resource</p>';
		echo $page_acl_control;
		echo '</div>';
		echo '<a href="?p=dashboard">';
		echo '<p>Click here to return to the Dashboard</p>';
		echo '</a>';
		echo '</div>';
	
	}
}	
?>