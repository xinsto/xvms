<?php
if(isset($_SESSION['volunteer_id'])) {

	if($_POST['submit'] == 'Create Task') {
	
		$err = array();
		$suc = array();
		
		$task_len = strlen($_POST['task_data']);
		
		if($task_len < 1) {
		
			$err[] = 'The Task can not be blank...';
		
		}
		
		if($_GET['id'] < 1){
		
			$err[] = 'No Volunteer was selected.';
		
		}
		
		if(count($err)) {
		
			echo '<div class="warning">';
			echo implode('<br />', $err);
			echo '</div>';
		
		}
		
		if(!count($err)) {
		
			$task_data = mysql_real_escape_string($_POST['task_data']);
			$date = date('Y-m-d');
		
			$sql = "INSERT INTO tasks (task_assigned_to_volunteer_id, task_created_by_volunteer_id, task_created_date, task_state_id, task_data)"
			." VALUES ('$_GET[id]', '$_SESSION[volunteer_id]', '$date', '1', '$task_data')";
			mysql_query($sql);
			echo mysql_error();
			echo '<div class="success">';
			echo 'The Task has been created.';
			echo '</div>';
			
			$task_id = mysql_insert_id();
			
			//Add To TASK_LOG
			$sql = "INSERT INTO tasks_log (task_log_task_id, task_log_date, task_log_data)"
			." VALUES ('$task_id', '$date', 'Task Created by: ".$_SESSION['volunteer_first_name']." ".$_SESSION['volunteer_last_name'].".')";
			mysql_query($sql);
			echo mysql_error();
	
			
		}
	
	}

	$sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$volunteer_first_name = $result['volunteer_first_name'];
	$volunteer_last_name = $result['volunteer_last_name'];

?>
<div id="section_470_left">
	<h4>Task Details for:<em id="important_red"> <?php echo $volunteer_last_name; ?>, <?php echo $volunteer_first_name; ?></em></h4>
	<hr />
	<form name="create_task" method="post" action="">
		<table>
		<tr><th align="right">Task:</th><td><textarea name="task_data" class="k-textbox" id="textarea_full_200"></textarea></td></tr>
		<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Create Task" class="k-button" /></td></tr>
		</table>
	</form>
</div>
<div id="section_470_right">
	<h4>Instructions</h4>
	<hr />
	Input the task the Volunteer should complete and click the "Create Task" button.
<div>
<?php
} else {
	echo 'You do not have access to the resource.';
}
?>