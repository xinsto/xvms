<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';

$query = "SELECT * FROM tasks, task_states, volunteers WHERE tasks.task_state_id = task_states.task_state_id AND task_assigned_to_volunteer_id = volunteer_id ORDER BY task_created_date, task_state DESC";
echo mysql_error();
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>