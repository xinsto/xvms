<?php if(isset($_SESSION['volunteer_id'])) { ?>
<a href="?p=add_volunteer" class="k-button">Add Volunteer</a>
<br />
<br />
<?php
	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'You are about to delete a Volunteer.  Doing this will remove all information related to this Volunteer for the Management System.<br />Are you sure you would like to delete the Volunteer? <a href="?p=manage_volunteers&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes, delete the Volunteer.</a> or <a href="?p=manage_volunteers" class="k-button">No, do not delete the Volunteer.</a>';
		echo '</div>';
	}
	
	if($_GET['o'] == 'confirm_delete') {
	
		$sql = "DELETE FROM volunteers WHERE volunteer_id = '$_GET[id]'";
		mysql_query($sql);
		
		echo mysql_error();
		
		$sql = "DELETE FROM volunteer_details WHERE volunteer_detail_volunteer_id = '$_GET[id]'";
		mysql_query($sql);
		
		
		$sql = "DELETE FROM hours WHERE hours_volunteer_id = '$_GET[id]'";
		mysql_query($sql);
		
		echo '<div class="success">';
		echo 'The Volunteer has been deleted.';
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
            		url: "mods/volunteers/data/get_volunteers.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    volunteer_id: { type: "number" },
                    volunteer_first_name: { type: "string" },
                    volunteer_last_name: { type: "string" },
                    volunteer_date_of_birth: { type: "date" },
                    volunteer_email: { type: "string" }
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
                    title:"First Name",
                    field:"volunteer_first_name",
                    },{
                    title:"Last Name",
                    field:"volunteer_last_name",
                    },{
                    title:"Email Address",
                    field:"volunteer_email",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=manage_volunteer&id=#=volunteer_id#' class='k-button'>Manage</a> <a href='?p=manage_volunteers&o=delete&id=#=volunteer_id#' class='k-button'>Delete</a>"
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