<?php 
if(isset($_SESSION['volunteer_id'])) {

	if($_POST['submit'] == 'Update Task') {
	
	$data = mysql_real_escape_string($_POST['task_update']);
	$date = date('Y-m-d');
	
	$len_data = strlen($_POST['task_update']);
	
	if($len_data > 1) {
	
	$sql = "INSERT INTO tasks_log (task_log_task_id, task_log_date, task_log_data)"
	." VALUES ('$_GET[id]', '$date', 'Task Updated by: ".$_SESSION['volunteer_first_name']." ".$_SESSION['volunteer_last_name'].". <br />".$data."')";
	mysql_query($sql);
	echo mysql_error();
	
	}
	
	if($_POST['complete'] == '1') {
	
		$sql = "UPDATE tasks SET task_state_id = '2' WHERE task_id = '$_GET[id]'";
		mysql_query($sql);
		echo mysql_error();
		
		$sql = "INSERT INTO tasks_log (task_log_task_id, task_log_date, task_log_data)"
		." VALUES ('$_GET[id]', '$date', 'Task Marked Complete by: ".$_SESSION['volunteer_first_name']." ".$_SESSION['volunteer_last_name'].".')";
		mysql_query($sql);
		echo mysql_error();
	
	}
	
	}

?>
<div id="section_470_left">
	<h4>Task Details</h4>
	<hr />
	<?php 
	$sql = "SELECT * FROM tasks WHERE task_id = '$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$task_created_date = $result['task_created_date'];
	$task_data = $result['task_data'];
	echo '<table>';
	echo '<tr><th>Date Created:</th><td>'.$task_created_date.'</td></tr>';
	echo '<tr><th>Task:</th><td>'.$task_data.'</td></tr>';
	ECHO '</table>';

	
	?>
</div>

<div id="section_470_right">
	<h4>Task Log</h4>
	<hr />
	<table>
	<?php
	$sql = "SELECT * FROM tasks_log WHERE task_log_task_id = '$_GET[id]' ORDER BY task_log_date";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$i = 0;
	while ($i < $num) {
		
		$task_log_data = mysql_result($result, $i, "task_log_data");
		$task_log_date = mysql_result($result, $i, "task_log_date");
		
		echo '<tr><td>'.$task_log_data.'</td><td>'.$task_log_date.'</td></tr>';
		
		$i++;
	}
	?>
	</table>
</div>
<div id="clear"></div>
<div id="section_470_right">
	<h4>Update Task</h4>
	<hr />
	<table>
		<form name="update_taks" method="post" action="">
		<tr><td align="right"><textarea name="task_update" id="textarea_full_100" class="k-textbox"></textarea></td></tr>
		<tr><td align="right"><input type="checkbox"  name="complete" value="1" />Mark Task as Complete <input type="submit" name="submit" value="Update Task" class="k-button" /></td></tr>
		</form>
	</table>
</div>
<?php
}
?>