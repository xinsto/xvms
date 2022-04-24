<?php
	if(isset($_SESSION['volunteer_id'])) {
	
		if($_POST['submit'] == 'Submit') {
		
			$warn = array();
			$suc = array();
			
			if($_POST['location'] == 'null') {
				$warn[] = 'You must select a Location to report hours.';
			}
			if($_POST['work_type'] == 'null') {
				$warn[] = 'You must select a Work Type to report hours.';
			}
			if($_POST['date'] <= ' ') {
				$warn[] = 'You must select a Date to report hours.';
			}
			if(count($warn)) {
				echo '<div class="warning">';
				echo implode('<br />', $warn);
				echo '</div>';
			}
			if(!count($warn)) {
				//Current User or Admin Input for another user
				if(isset($_GET['id'])) {
					$volunteer_id = $_GET['id'];
				} else {
					$volunteer_id = $_SESSION['volunteer_id'];
				}
				//INSERT HOURS
				$sql = "UPDATE hours SET hours_work_type_id = '$_POST[work_type]', hours_location_id = '$_POST[location]',"
				." hours_worked = '$_POST[hours_worked]', hours_notes = '$_POST[notes]', hours_date = '$_POST[date]' WHERE hours_id = '$_GET[hours_id]'";
				mysql_query($sql);
				echo mysql_error();
				echo '<div class="success">';
				echo 'The hours have been updated.';
				echo '</div>';
			}
			
		
		}
 
?>

<?php
if(isset($_GET['id'])) {
 $sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_GET[id]'";
 $result = mysql_fetch_assoc(mysql_query($sql));
 $volunteer_first_name = $result['volunteer_first_name'];
 $volunteer_last_name = $result['volunteer_last_name'];
 
 $volunteer_name = $volunteer_last_name.', '.$volunteer_first_name;
 
 $sql = "SELECT * FROM hours, work_types, locations WHERE hours_id = '$_GET[hours_id]' AND hours_work_type_id = work_type_id AND hours_location_id = location_id";
 $result = mysql_fetch_assoc(mysql_query($sql));
 
 $hours_work_type_id = $result['hours_work_type_id'];
 $hours_work_type_name = $result['work_type_name'];
 $hours_location_name = $result['location_name'];
 $hours_location_id = $result['hours_location_id'];
 $hours_worked = $result['hours_worked'];
 $hours_notes = $result['hours_notes'];
 $hours_date = $result['hours_date'];
 
 
 
}
?>

<div id="section_470_left">
	<h4>Edit Volunteer Hours <?php if(isset($_GET['id'])) { echo ' : <em id="important_red">'.$volunteer_name.'</em>'; } ?></h4>
	<hr />
	<form name="report_hours" method="post" action="">
		<table>
			<tr>
				<th align="right">Hours:</td><td><input type="number" name="hours_worked" step=".5" class="k-textbox" id="input_hours" value="<?php echo $hours_worked; ?>" readonly / ></td>
				<th align="right">Date:</th><td><input type="date" name="date" id="date" value="<?php echo $hours_date; ?>" readonly /></td></tr>
			</tr>
			<tr>
				<th align="right">Location:</th>
				<td colspan="3">
					<select name="location" id="input_full">
						<option value="<?php echo $hours_location_id; ?>"><?php echo $hours_location_name; ?></option>
						<?php
						$sql = "SELECT * FROM locations WHERE location_id != '$hours_location_id' ORDER BY location_name";
						$result = mysql_query($sql);
						$num = mysql_num_rows($result);
						$i = 0;
						while ($i < $num) {
						
							$location_id =mysql_result($result, $i, "location_id");
							$location_name =mysql_result($result, $i, "location_name");
							
							echo '<option value="'.$location_id.'">'.$location_name.'</option>';
							
							$i++;
						
						}
						?>
					</select">
				</td>
			</tr>
			<tr>
				<th align="right">Work Type:</th>
				<td colspan="3">
					<select name="work_type" id="input_full">
						<option value="<?php echo $hours_work_type_id; ?>"><?php echo $hours_work_type_name; ?></option>>
					<?php
						$sql = "SELECT * FROM work_types WHERE work_type_id != '$hours_work_type_id' ORDER BY work_type_name";
						$result = mysql_query($sql);
						$num = mysql_num_rows($result);
						$i = 0;
						while ($i < $num) {
						
							$work_type_id =mysql_result($result, $i, "work_type_id");
							$work_type_name =mysql_result($result, $i, "work_type_name");
							
							echo '<option value="'.$work_type_id.'">'.$work_type_name.'</option>';
							
							$i++;
						
						}
						?>
					</select"
				</td>
			</tr>
			<tr><th align="right">Notes:</th><td colspan="3"><textarea name="notes" id="textarea_full_100" class="k-textbox"><?php echo $hours_notes; ?></textarea></td></tr>
			<tr><td align="right" colspan="4"><input type="submit" name="submit" value="Submit" class="k-button" /></td></tr>
			
		</table>
	</form>
</div>
<div id="clear"></div>

<script>
$(document).ready(function(){
	$("#date").kendoDatePicker({ format: "yyyy-MM-dd" });
	$("#input_hours").kendoNumericTextBox({ decimals: 3 });

});
</script>

<?php
	} else {
		echo 'You do not have access to this resource.';
	}
?>