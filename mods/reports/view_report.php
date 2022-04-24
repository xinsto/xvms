<?php
if(isset($_SESSION['volunteer_id'])) {

	if(isset($_GET['id'])) {

?>
<div id="tabstrip">
	<ul>
       	<li class="k-state-active">View Report</li>
   	</ul>
    <div></div>
   	<div></div>
</div>
 
 <script>
 $(document).ready(function(){
    $("#tabstrip").kendoTabStrip({
        contentUrls: ["?p=report_details&id=<?php echo $_GET['id']; ?>"]
    });
 });
 </script>

<?php
	} else {
		echo '<div id="section_700">';
			echo '<div class="info">';
			echo 'Please select a Report from the list to the left.';
			echo '</div>';
		echo '</div>';
	
	}

} else {
	echo 'You do not have access to this resource.';
}
?>