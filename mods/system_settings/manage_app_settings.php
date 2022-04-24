<?php
if(isset($_SESSION['volunteer_id'])) {

	if($_POST['submit'] == 'Submit') {
	
	$sql = "UPDATE application_settings SET application_setting = '$_POST[organization_name]' WHERE application_setting_name = 'organization_name'";
	mysql_query($sql);

	$sql = "UPDATE application_settings SET application_setting = '$_POST[application_title]' WHERE application_setting_name = 'title'";
	mysql_query($sql);
	
	echo '<div class="success">';
	echo 'The Settings have been updated!';
	echo '</div>';
	
	}
	
?>
<div id="section_470_left">
	<h4>Orginization Name & Application Title</h4>
	<hr />
	<form name="update_org_name" method="post" action="">
		<table>
			<tr><th align="right">Orginization Name:</th><td><input type="text" name="organization_name" value="<?php echo $organization_name; ?>" class="k-textbox" id="input_full" /></td></tr>
			<tr><th align="right">Application Title:</th><td><input type="text" name="application_title" value="<?php echo $title; ?>" class="k-textbox" id="input_full" /></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
		</table>
	</form>
</div>
<?php
}
?>