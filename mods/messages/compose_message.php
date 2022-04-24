<?php
if(isset($_SESSION['volunteer_id'])) {

	if($_POST['submit'] == 'Send') {
	
		$err = array();
		$suc = array();
		
		$sub_strlen = strlen($_POST['message_subject']);
		$body_strlen = strlen($_POST['message_body']);
		if($sub_strlen < 1) {
		
			$err[] = 'You must specifiy a Subject to send a Message.';
		
		}
		if($body_strlen < 1) {
		
			$err[] = 'You must specifiy a Body to send a Message.';
		
		}
		if($_POST['message_to_id'] == 'null') {
		
			$err[] = 'You must select a Volunteer to send a Message.';
		
		}
		
		if(count($err)) {
		
			echo '<div class="warning">';
			echo implode("<br />", $err);
			echo '</div>';
		
		}
		
		if(!count($err)) {
		
			$message_subject = mysql_real_escape_string($_POST['message_subject']);
			$message_body = mysql_real_escape_string($_POST['message_body']);
			
			$sql = "INSERT INTO messages (message_from_id, message_to_id, message_subject, message_body, message_state)"
			." VALUES ('$_SESSION[volunteer_id]', '$_POST[message_to_id]', '$message_subject', '$message_body', 'New')";
			
			mysql_query($sql);
			echo mysql_error();
			
			$suc[] = 'The message has been sent!';
		
		}
		
		if(count($suc)) {
		
			echo '<div class="success">';
			echo implode("<br />", $suc);
			echo '</div>';
		
		}
		
		
			
	}
	
//include 'data/get_volunteers.php';
?>
<br />
<style>
#message_to_id {
width:100%;
}
</style>
<div id="section_470_left">
	<form name="compose_message" method="post" action="">
		<table>
			<tr><th align="right">To:</th><td>
			<select name="message_to_id" id="input_full">
			<option value="null">Select a volunteer...</option>
			<?php
			$sql = "SELECT volunteer_id, volunteer_first_name, volunteer_last_name FROM volunteers WHERE volunteer_id != '1' ORDER BY volunteer_last_name";
			$result = mysql_query($sql);
			echo mysql_error();
			$num = mysql_num_rows($result);
			$i = 0;
			while ($i < $num) {
			
				$volunteer_id = mysql_result($result, $i, "volunteer_id");
				$volunteer_first_name = mysql_result($result, $i, "volunteer_first_name");
				$volunteer_last_name = mysql_result($result, $i, "volunteer_last_name");
			
				echo '<option value="'.$volunteer_id.'">'.$volunteer_last_name.', '.$volunteer_first_name.'</option>';
				
				$i++;
			}
			?>
			</select>
			</td></tr>
			<tr><th align="right">Subject:</th><td><input type="text" name="message_subject" id="input_full" class="k-textbox" <?php if(count($err)) { echo 'value="'.$_POST['message_subject'].'"'; } ?> /></td></tr>
			<tr><th align="right">Message:</th><td><textarea class="k-textbox" name="message_body" id="textarea_full_100"><?php if(count($err)) { echo $_POST['message_body']; } ?></textarea></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Send" class="k-button" /></td></tr>
		</table>
	</form>
</div>


<?php
} else {
	echo 'You do not have access to this resource.';
}
?>