<?php
if(isset($_SESSION['volunteer_id'])) {

	$sql = "SELECT * FROM messages, volunteers WHERE message_from_id = volunteer_id AND message_id = '$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$volunteer_first_name = $result['volunteer_first_name'];
	$volunteer_last_name = $result['volunteer_last_name'];
	$message_subject = $result['message_subject'];
	$message_body = $result['message_body'];
	
	$sql = "UPDATE messages SET message_state = 'Read' WHERE message_id = '$_GET[id]'";
	mysql_query($sql);
	

?>
<div id="section_470_left">

	<table>
		<tr><th align="right">From:</th><td><?php echo $volunteer_last_name; ?>, <?php echo $volunteer_first_name; ?></td></tr>
		<tr><th align="right">Subject:</td><td><?php echo $message_subject; ?></td></tr>
		<tr><td colspan="2"><hr /></td></tr>
		<tr><th align="right">Message:</td><td><?php echo $message_body; ?></td></tr>
	</table>

</div>
<?php
} else {
	echo 'You do not have access to this resource';
}
?>