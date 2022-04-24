<?php
if(isset($_SESSION['volunteer_id'])) {

	//GET THE MOD PERMISSION INFO TO EDIT
	
	$sql="SELECT * FROM mods WHERE mod_name='$_GET[id]'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	
	$mod_display_name = $result['mod_display_name'];
	$mod_acl_control_id = $result['mod_acl_control_id'];
	
	
	//GET ACL CONTROL NAME
	$sql = "SELECT * FROM acl_controls WHERE acl_control_id = '$mod_acl_control_id'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	$mod_acl_control_name = $result['acl_control_name'];
	

?>
<div id="section_650">
	<div id="server_message">
		<div class="info">

			Update the permission to this module below.

		</div>
	</div>

<form name="update_permission" id="update_permission" method="post" action="?p=process_update_permission&id=<?php echo $_GET['id']; ?>">

	<table>
		<tr><th align="right"><?php echo $mod_display_name; ?>:</th>
		<td>
			
			<select name="mod_acl_control_id" id="mod_acl_control_id">
			<option value="<?php echo $mod_acl_control_id; ?>"><?php echo $mod_acl_control_name; ?></option>
			<?php 
			$sql = "SELECT * FROM acl_controls WHERE acl_control_id != '$mod_acl_control_id'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$i = 0;
			
			while ($i < $num) {
			
				$acl_control_id = mysql_result($result, $i, "acl_control_id");
				$acl_control_name = mysql_result($result, $i, "acl_control_name");
				
				echo '<option value="'.$acl_control_id.'">'.$acl_control_name.'</option>';
			
				$i++;
			}
			
			?>
		</select>
		</td>
		</tr>
		<tr>
		<td colspan="2" align="right">
		<input type="submit" name="submit" value="Submit Form" />
		</td>
		</tr>
	</table>

</form>

</div>
<script type="text/javascript"> 
$(document).ready(function() {

	
	
    // bind form using ajaxForm 
    $('#update_permission').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#server_message', 
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('#server_message').fadeIn("slow"); 
            
        } 
    });
    

    

    
});


</script> 

<?php

} else {
	echo 'You do not have access to this resource.';
}
?>