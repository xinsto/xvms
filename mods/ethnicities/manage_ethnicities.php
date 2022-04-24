<?php if(isset($_SESSION['volunteer_id'])) { 
	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'You are about to delete an Ehtnicity from the Database.  Doing this will remove all information related to this Ehtnicity for the Management System.<br />Are you sure you would like to delete the Ehtnicity? <a href="?p=manage_ethnicities&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes, delete the Ethnicity.</a> or <a href="?p=manage_ethnicities" class="k-button">No, do not delete the Ethnicity.</a>';
		echo '</div>';
	}
	
	if($_GET['o'] == 'confirm_delete') {
	
		$sql = "DELETE FROM ethnicities WHERE ethnicity_id = '$_GET[id]'";
		mysql_query($sql);
		
		echo mysql_error();

		//$sql = "DELETE FROM volunteer_details WHERE volunteer_detail_item_common_name = '$_GET[id]'";
		//mysql_query($sql);
		
		echo '<div class="success">';
		echo 'The Ethnicity has been deleted.';
		echo '</div>';
	
	}
?>
<a href="?p=add_ethnicity" class="k-button">Add Ethnicity</a>
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
            		url: "mods/ethnicities/data/get_ethnicities.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    ethnicity_id: { type: "number" },
                    ethnicity_name: { type: "string" }
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
                    title:"Ethnicity",
                    field:"ethnicity_name",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=manage_ethnicity&id=#=ethnicity_id#' class='k-button'>Manage</a> <a href='?p=manage_ethnicities&o=delete&id=#=ethnicity_id#' class='k-button'>Delete</a>"
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