<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$volunteer_id = $_GET['id'];
$query = "SELECT * FROM tasks WHERE task_assigned_to_volunteer_id = '$volunteer_id' AND task_state_id = '1' ORDER BY task_created_date";
echo mysql_error();
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>