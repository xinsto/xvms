<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$volunteer_id = $_GET['id'];
$query = "SELECT * FROM hours, volunteers, locations, work_types WHERE hours_volunteer_id = '$volunteer_id' AND hours.hours_volunteer_id = volunteers.volunteer_id AND hours.hours_location_id = locations.location_id AND hours.hours_work_type_id = work_types.work_type_id ORDER BY hours_date";
$mysql_result = mysql_query($query);
echo mysql_error();
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>