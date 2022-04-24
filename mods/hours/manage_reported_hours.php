<?php 
	if(isset($_SESSION['volunteer_id'])) {
		if(isset($_GET['id'])) { 
			$volunteer_id = $_GET['id'];
			echo '<a href="?p=report_hours&id='.$volunteer_id.'" class="k-button">Input Hours</a>';
		} else {
			$volunteer_id = $_SESSION['volunteer_id'];
		}
?>
<br />
<br />
<?php
	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'You are about to delete Hours from the system.  Doing this will remove all information related to the Hours from the Management System.<br />Are you sure you would like to delete the Hours? <a href="?p=manage_reported_hours&o=confirm_delete&id='.$_GET['id'].'&hours_id='.$_GET['hours_id'].'" class="k-button">Yes, delete the Hours.</a> or <a href="?p=manage_reported_hours&id='.$_GET['id'].'" class="k-button">No, do not delete the Hours.</a>';
		echo '</div>';
	}
	
	if($_GET['o'] == 'confirm_delete') {
	
		$sql = "DELETE FROM hours WHERE hours_id = '$_GET[hours_id]'";
		mysql_query($sql);
		
		echo mysql_error();

		
		echo '<div class="success">';
		echo 'The Hours have been removed from the system.';
		echo '</div>';
	
	}
?>
<div id="grid"></div>
<script>
    var dateRegExp = /^\/Date\((.*?)\)\/$/;

    function toDate(value) {
        var date = dateRegExp.exec(value);
            return new Date(parseInt(date[1]));
        }

    $(document).ready(function() {
        $("#grid").kendoGrid({
            dataSource: {
    			transport: {
        			read: {
            		url: "mods/hours/data/get_hours.php?id=<?php echo $volunteer_id; ?>",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    hours_id: { type: "number" },
                    volunteer_first_name: { type: "string" },
                    volunteer_last_name: { type: "string" },
                    hours_date: { type: "date" },
                    location_name: { type: "string" },
                    work_type_name: { type: "string" },
                    volunteer_id: { type: "number" },
                    hours_worked: { type: "hours_worked" }
                }
                }
                },
                pageSize: 10
                },
                height: 350,
                filterable: true,
                sortable: true,
                pageable: true,
                selectable:true,
                    columns: [{
                    title:"Volunteer",
                    template:"#=volunteer_last_name#, #=volunteer_first_name#",
                    },{
                    title:"Location",
                    field:"location_name",
                    },{
                    title:"Work Type",
                    field:"work_type_name",
                    },{
                    title:"Hours Worked",
                    field:"hours_worked",
                    },{
                    title:"Date",
                    field:"hours_date",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=edit_reported_hours&id=#=volunteer_id#&hours_id=#=hours_id#' class='k-button'>Manage</a> <a href='?p=manage_reported_hours&o=delete&id=#=volunteer_id#&hours_id=#=hours_id#' class='k-button'>Delete</a>"
                    },
                    ]
                });
        });
</script>
<?php 
} else { 
	echo 'You do not have access to this resource...';
} 
?>