<?php
	define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$volunteer_id = $_GET['id'];
$query = "SELECT * FROM documents WHERE document_volunteer_id = '$volunteer_id' AND document_type = '3' ORDER BY document_upload_date";
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>