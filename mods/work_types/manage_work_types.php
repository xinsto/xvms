<?php if(isset($_SESSION['volunteer_id'])) { 
	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'You are about to delete a work type.  Doing this will remove all information related to this work type for the Management System.<br />Are you sure you would like to delete the work type? <a href="?p=manage_volunteers_custom_details&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes, delete the work type.</a> or <a href="?p=manage_volunteers_custom_details" class="k-button">No, do not delete the work type.</a>';
		echo '</div>';
	}
	
	if($_GET['o'] == 'confirm_delete') {
	
		$sql = "DELETE FROM volunteer_detail_items WHERE volunteer_detail_item_common_name = '$_GET[id]'";
		mysql_query($sql);
		
		echo mysql_error();

		$sql = "DELETE FROM volunteer_details WHERE volunteer_detail_item_common_name = '$_GET[id]'";
		mysql_query($sql);
		
		echo '<div class="success">';
		echo 'The Location has been deleted.';
		echo '</div>';
	
	}
?>
<a href="?p=add_work_type" class="k-button">Add Work Type</a>
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
            		url: "mods/work_types/data/get_work_types.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    work_type_id: { type: "number" },
                    work_type_name: { type: "string" }
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
                    title:"Work Type",
                    field:"work_type_name",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=manage_work_type&id=#=work_type_id#' class='k-button'>Manage</a> <a href='?p=manage_work_types&o=delete&id=#=work_type_id#' class='k-button'>Delete</a>"
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