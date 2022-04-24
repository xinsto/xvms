<?php
if(isset($_SESSION['volunteer_id'])) {


	$report_name = $_GET['id'];
	$generated_date = date('d-m-Y');
	
	//GET report display name
	$sql = "SELECT * FROM reports WHERE report_name = '$report_name'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	
	$report_display_name = $result['report_display_name'];

?>

	<div id="server_message">
		<div class="info">
			Please select a start and end date then click generate report.
		</div>
	
	<form name="generate_report" id="generate_report" method="post" action="?p=generate_hours_by_volunteer&id=<?php echo $report_name; ?>">
	<table>
		<tr>
			<th align="right">Start Date:</th><td><input type="date" name="start_date" id="start_date" READONLY/></td>
			<th align="right">End Date:</th><td><input type="date" name="end_date" id="end_date" READONLY/></td>
			<td align="right"><input type="submit" name="submit" id="submit" value="Generate Report" class="k-button" /></td>
		</tr>
	<table>
	</form>
	</div>
	
	<script>
	$(document).ready(function(){
		$("#start_date").kendoDatePicker({ format: "yyyy-MM-dd" });
		$("#end_date").kendoDatePicker({ format: "yyyy-MM-dd" });		
    // bind form using ajaxForm 
    $('#generate_report').ajaxForm({ 
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