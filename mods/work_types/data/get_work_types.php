<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$query = 'SELECT * FROM work_types ORDER BY work_type_name';
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>