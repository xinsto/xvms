<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$id = $_GET['id'];
$query = "SELECT * FROM messages, volunteers WHERE message_to_id = '$id' AND message_from_id = volunteer_id ORDER BY message_state, message_id";
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>