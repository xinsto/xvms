<?php
if(isset($_SESSION['volunteer_id'])) {
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
            		url: "mods/tasks/data/get_tasks_complete.php?id=<?php echo $_SESSION['volunteer_id']; ?>",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    task_id: { type: "number" },
                    task_data: { type: "string" },
                    task_created_date: { type: "string" },
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
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=edit_task&id=#=task_id#' class='k-button'>Edit</a>"
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