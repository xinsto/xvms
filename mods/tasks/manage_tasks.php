<?php
if(isset($_SESSION['volunteer_id'])) {

	if($_GET['o'] == 'delete') {
		echo '<div class="info">';
		echo 'Are you sure you would like to Delete this task? <a href="?p=manage_tasks&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes!</a> <a href="?p=manage_tasks" class="k-button">No...</a>';
		echo '</div>';
	
	}
	
	if($_GET['o'] == 'confirm_delete') {
	
		$sql = "DELETE FROM tasks WHERE task_id = '$_GET[id]'";
		mysql_query($sql);
		
		$sql = "DELETE from tasks_log WHERE task_log_task_id = '$_GET[id]'";
		mysql_query($sql);
	
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
            		url: "mods/tasks/data/get_all_tasks.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    task_id: { type: "number" },
                    task_data: { type: "string" },
                    task_created_date: { type: "string" },
                    task_state: { type: "string" },
                    volunteer_first_name: { type: "string" },
                    volunteer_last_name: { type: "string" },
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
                    title:"Task",
                    field:"task_data",
                    },{
                    width:"150px",
                    title:"Date Created",
                    field:"task_created_date",
                    },{
                    width:"150px",
                    title:"Assigned To",
                    template:"#=volunteer_first_name# #=volunteer_last_name#",
                    },{
                    width:"150px",
                    title:"State",
                    field:"task_state",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=edit_task&id=#=task_id#' class='k-button'>Edit</a> <a href='?p=manage_tasks&o=delete&id=#=task_id#' class='k-button'>Delete</a>"
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