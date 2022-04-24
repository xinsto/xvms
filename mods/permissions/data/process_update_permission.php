<?php
if(isset($_SESSION['volunteer_id'])) {

	//Message Variables
	$err = array();
	$suc = array();

	$mod_name = $_GET['id'];
	
	$sql = "UPDATE mods SET mod_acl_control_id = '$_POST[mod_acl_control_id]' WHERE mod_name = '$mod_name'";
	mysql_query($sql);
	echo mysql_error();
	
	$sql = "UPDATE mods SET mod_acl_control_id = '$_POST[mod_acl_control_id]' WHERE mod_parent_name = '$mod_name'";
	mysql_query($sql);
	echo mysql_error();
	
	
	
?>

	<div class="success">
	The Permissions for this module have been updated.
	</div>

<?php
}
?>