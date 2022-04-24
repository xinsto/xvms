<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$query = 'SELECT * FROM volunteer_detail_items ORDER BY volunteer_detail_weight';
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>