<?php
	if(isset($_SESSION['volunteer_id'])) {

	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'You are about to delete a Location.  Doing this will remove all information related to this Location for the Management System.<br />Are you sure you would like to delete the Location? <a href="?p=manage_locations&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes, delete the Location.</a> or <a href="?p=manage_locations" class="k-button">No, do not delete the Location.</a>';
		echo '</div>';
	}
	
	if($_GET['o'] == 'confirm_delete') {
	
		$sql = "DELETE FROM locations WHERE location_id = '$_GET[id]'";
		mysql_query($sql);
		
		echo mysql_error();

		
		echo '<div class="success">';
		echo 'The Location has been deleted.';
		echo '</div>';
	
	}

?>

		<a href="?p=add_location" class="k-button">Add Location</a>
		<br />
		<br />
	
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
            		url: "mods/locations/data/get_locations.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    location_id: { type: "number" },
                    location_name: { type: "string" },
                    location_address: { type: "string" }
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
                    title:"Name",
                    field:"location_name",
                    },{
                    title:"Address",
                    field:"location_address",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=manage_location&id=#=location_id#' class='k-button'>Manage</a> <a href='?p=manage_locations&o=delete&id=#=location_id#' class='k-button'>Delete</a>"
                    },
                    ]
                });
        });
</script>


<?php
	} else {
	
		echo 'You do not have access to this resource.';
	
	}
?>