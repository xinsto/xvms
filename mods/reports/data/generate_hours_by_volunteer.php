<?php
if(isset($_SESSION['volunteer_id'])) {


	$report_name = $_GET['id'];
	$generated_date = date('d-m-Y');
	
	//GET report display name
	$sql = "SELECT * FROM reports WHERE report_name = '$report_name'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$report_display_name = $result['report_display_name'];

	$err = array();
	$suc = array();
	
	if($_POST['start_date'] == "") {
	
		$err[] = 'You must specify a start date to generate this report.';
	
	}
	if($_POST['end_date'] == "") {
	
		$err[] = 'You must specify an end date to generate this report.';
	
	}
	
	if(count($err)) {
	
		echo '<div class="error">';
		echo implode('<br />', $err);
		echo '</div>';
	
	}
	
	if(!count($err)) {

	$sql = "SELECT *, SUM(hours_worked) AS hours_total FROM hours, volunteers WHERE volunteer_id = hours_volunteer_id AND (hours_date BETWEEN '$_POST[start_date]' AND '$_POST[end_date]') GROUP BY hours_volunteer_id ORDER BY volunteer_last_name";
	$result = mysql_query($sql);
	echo mysql_error();
	$num = mysql_num_rows($result);
	$i = 0;
	$hours_total_for_all = 0;
?>
<style>
#h2_table {
padding:0px;
margin:0px;
}
</style>
	<table>
		<tr><th colspan="4"><h2 id="h2_table"><?php echo $report_display_name; ?></h2></th><td align="right"><?php echo $organization_name; ?></td></tr>
		<tr><td colspan="2"><em>from:</em> <?php echo $_POST['start_date']; ?> <em>to:</em> <?php echo $_POST['end_date']; ?></td><td colspan="3" align="right"><?php echo $title; ?></td></tr>
		<tr><th>ID</th><th>Name</th><th>Email</th><th>Date of Birth</th><th align="right">Hours</th></tr>
		<?php
		while ($i < $num) {
			
			$volunteer_id = mysql_result($result, $i, "volunteer_id");
			$volunteer_last_name = mysql_result($result, $i, "volunteer_last_name");
			$volunteer_first_name = mysql_result($result, $i, "volunteer_first_name");
			$volunteer_email = mysql_result($result, $i, "volunteer_email");
			$volunteer_date_of_birth = mysql_result($result, $i, "volunteer_date_of_birth");
			$volunteer_hours_total = mysql_result($result, $i, "hours_total");
			
			$hours_total_for_all =+ $volunteer_hours_total;
			
			echo '<tr><td>'.$volunteer_id.'</td><td>'.$volunteer_last_name.', '.$volunteer_first_name.'</td><td>'.$volunteer_email.'</td><td>'.$volunteer_date_of_birth.'</td><td align="right">'.$volunteer_hours_total.'</td></tr>';
			echo '<tr><td colspan="5"><hr /></td></tr>';
		
			$i++;
		}
		?>
		<tr><th align="right" colspan="4"><em>Total Hours:</em></th><td align="right"><?php echo $hours_total_for_all; ?></td></tr>
	</table>
	
<?php

}
} else {
	echo 'You do not have access to this resource.';
}
?>