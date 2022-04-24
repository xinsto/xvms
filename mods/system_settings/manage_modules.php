<?php
if(isset($_SESSION['volunteer_id'])) {

if($_GET['action'] == 'inactivate') {

	$sql = "UPDATE mods SET mod_active_inactive = '2' WHERE mod_name = '$_GET[mod_name]'";
	mysql_query($sql);
	echo mysql_error();
	
	$sql = "SELECT * FROM mods WHERE mod_parent_name = '$_GET[mod_name]'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$i = 0;
	while ($i < $num) {
	
		$common_name = mysql_result($result, $i, "mod_name");
		
		$update = "UPDATE mods SET mod_active_inactive = '2' WHERE mod_name = '$common_name'";
		mysql_query($update);
		echo mysql_error();
	
	
		$i++;
	}

}

if($_GET['action'] == 'activate') {

	$sql = "UPDATE mods SET mod_active_inactive = '1' WHERE mod_name = '$_GET[mod_name]'";
	mysql_query($sql);
	echo mysql_error();
	
	$sql = "SELECT * FROM mods WHERE mod_parent_name = '$_GET[mod_name]'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$i = 0;
	while ($i < $num) {
	
		$common_name = mysql_result($result, $i, "mod_name");
		
		$update = "UPDATE mods SET mod_active_inactive = '1' WHERE mod_name = '$common_name'";
		mysql_query($update);
		echo mysql_error();
	
	
		$i++;
	}

}

?>

<div id="section_470_left">
	<h4>Acitve Modules</h4>
	<hr />
	<table>
	<?php
	//GET MODS THAT ARE ENABLED
	$sql = "SELECT * FROM mods WHERE mod_can_en_dis = '1' AND mod_active_inactive = '1' AND mod_parent_name = 'none'";
	$result = mysql_query($sql);
	echo mysql_error();
	$num = mysql_num_rows($result);
	$i = 0;
	
	while ($i < $num) {
		
		$mod_name = mysql_result($result, $i, "mod_name");
		$mod_display_name = mysql_result($result, $i, "mod_display_name");

		echo '<tr><th align="right">'.$mod_display_name.'</th><td><a href="?p=manage_modules&action=inactivate&mod_name='.$mod_name.'" class="k-button">Inactivate</a></td></tr>';
	
		$i++;
	}
	
	?>
	</table>
	
</div>

<div id="section_470_right">
<h4>Inactive Modules</h4>
<hr />
	<table>
	<?php
	//GET MODS THAT ARE DISABLED
	$sql = "SELECT * FROM mods WHERE mod_can_en_dis = '1' AND mod_active_inactive = '2' AND mod_parent_name = 'none'";
	$result = mysql_query($sql);
	echo mysql_error();
	$num = mysql_num_rows($result);
	$i = 0;
	
	while ($i < $num) {
		
		$mod_name = mysql_result($result, $i, "mod_name");
		$mod_display_name = mysql_result($result, $i, "mod_display_name");

		echo '<tr><th align="right">'.$mod_display_name.'</th><td><a href="?p=manage_modules&action=activate&mod_name='.$mod_name.'" class="k-button">Activate</a></td></tr>';
	
		$i++;
	}
	
	?>
	</table>
	
</div>
<div id="clear"></div>
<?php
}
?>