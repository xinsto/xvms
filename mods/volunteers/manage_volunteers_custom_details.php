<?php if(isset($_SESSION['volunteer_id'])) { 
	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'You are about to delete a custom detail.  Doing this will remove all information related to this custom detail for the Management System.<br />Are you sure you would like to delete the custom detail? <a href="?p=manage_volunteers_custom_details&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes, delete the custom detail.</a> or <a href="?p=manage_volunteers_custom_details" class="k-button">No, do not delete the custom detail.</a>';
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
<a href="?p=add_custom_detail" class="k-button">Add Custom Detail</a>
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
            		url: "mods/volunteers/data/get_custom_details.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    volunteer_detail_item_common_name: { type: "number" },
                    volunteer_detail_item_display_name: { type: "string" }
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
                    field:"volunteer_detail_item_display_name",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=manage_volunteers_custom_detail&id=#=volunteer_detail_item_common_name#' class='k-button'>Manage</a> <a href='?p=manage_volunteers_custom_details&o=delete&id=#=volunteer_detail_item_common_name#' class='k-button'>Delete</a>"
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