<?php
define('INCLUDE_CHECK',true);
include '../../../config/connect.php';
$query = "SELECT * FROM mods WHERE mod_parent_name = 'none' AND mod_type !='4' ORDER BY mod_display_name";
$mysql_result = mysql_query($query);
$result = array();
while ($row = mysql_fetch_assoc($mysql_result)) {
   $result[] = $row;
}
$data = json_encode($result);

print_r($data);
?>