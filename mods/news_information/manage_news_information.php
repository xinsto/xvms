<?php
if(isset($_SESSION['volunteer_id'])) {
	if($_GET['o'] == 'delete') {
	
		echo '<div class="info">';
		echo 'Are you sure you would like to delete this news and information item?  <a href="?p=manage_news_information&o=confirm_delete&id='.$_GET['id'].'" class="k-button">Yes, Delete the item.</a> <a href="?p=manage_news_information" class="k-button">No, Do not delete.</a>';
		echo '</div>';
	
	}
	if($_GET['o'] == 'confirm_delete') {
	
		echo '<div class="success">';
		echo 'The news & infromation item has been deleted.';
		echo '</div>';
		
		$sql = "DELETE FROM news WHERE id = '$_GET[id]'";
		mysql_query($sql);
		echo mysql_error();
	
	}
?>
<a href="?p=add_news_information" class="k-button">Add News & Information Item</a>
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
            		url: "mods/news_information/data/get_news_information.php",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    id: { type: "number" },
                    date_start: { type: "string" },
                    date_end: { type: "string" },
                    data: { type: "string" }
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
                    title:"Item",
                    field:"data",
                    },{
                    title:"Start",
                    field:"date_start",
                    width:"100px",
                    },{
                    title:"End",
                    field:"date_end",
                    width:"100px",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=edit_news_information&id=#=id#' class='k-button'>Manage</a> <a href='?p=manage_news_information&o=delete&id=#=id#' class='k-button'>Delete</a>"
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