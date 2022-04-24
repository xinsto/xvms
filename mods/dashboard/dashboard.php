<?php
if(isset($_SESSION['volunteer_id'])) {
	//Check is messages mod is active 
	
	$sql = "SELECT * FROM mods WHERE mod_name = 'messages'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$message_state = $result['mod_active_inactive'];
	
	//Get Unread Messages
	$sql = "SELECT COUNT(*) AS count FROM messages WHERE message_to_id = '$_SESSION[volunteer_id]' AND message_state = 'New'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	echo mysql_error();
	$message_count = $result['count'];
	
	//Check is tasks mod is active 
	
	$sql = "SELECT * FROM mods WHERE mod_name = 'tasks'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$task_state = $result['mod_active_inactive'];
	
	//Get Assigned to the User
	$sql = "SELECT COUNT(*) AS count FROM tasks WHERE task_assigned_to_volunteer_id = '$_SESSION[volunteer_id]' AND task_state_id = '1'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	echo mysql_error();
	$task_count = $result['count'];
?>
<div id="section_470_left">
	<h4>Welcome, <?php echo $_SESSION['volunteer_first_name']; ?>!</h4>
	<hr />
	<?php if($message_state == '1') { ?>
	<div id="dashboard_item">
		<p id="dashboard_item_title">Message's</p>
		<p id="dashboard_item_info"><?php echo $message_count; ?></p>
		<p id="dashboard_item_footer">Unread</p>
	</div>
	<?php } ?>
	<?php if($task_state == '1') { ?>
	<div id="dashboard_item">
		<p id="dashboard_item_title">Task's</p>
		<p id="dashboard_item_info"><?php echo $task_count; ?></p>
		<p id="dashboard_item_footer">assigned to you</p>
	</div>
<?php } ?>


</div>
<div id="section_470_right">
	<h4>News & Information</h4>
	<hr />
	<?php
	$sql = "SELECT * FROM news WHERE login_dashboard = '1' OR login_dashboard = '3' ORDER BY date_end";
	$result = mysql_query($sql);
	echo mysql_error();
	$num = mysql_num_rows($result);
	$i = 0;
	while ($i < $num) {
		
		$data = mysql_result($result, $i, "data");
		
		echo $data;
		echo '<br />';
		echo '<br />';
		
		$i++;
	}
	
	?>
</div>
<div id="clear"></div>

<?php
} else {
	'You do not have access to this resource.';
}
?>