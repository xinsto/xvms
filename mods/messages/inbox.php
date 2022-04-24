<?php
if(isset($_SESSION['volunteer_id'])) {
	if($_GET['o'] == 'delete') {
	
		$sql = "DELETE FROM messages WHERE message_id = '$_GET[id]' AND message_to_id = '$_SESSION[volunteer_id]'";
		mysql_query($sql);
		echo mysql_error();
		echo '<div class="success">';
		echo 'The message has been deleted';
		echo '</div>';
	
	}
?>
<a href="?p=compose_message" class="k-button">Compose Message</a>
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
            		url: "mods/messages/data/get_messages.php?id=<?php echo $_SESSION['volunteer_id']; ?>",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                    message_id: { type: "number" },
                    volunteer_first_name: { type: "string" },
                    message_state: { type: "string" },
                    message_subject: { type: "string" },
                    volunteer_last_name: { type: "string" }
   
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
                    width:"100px",
                    title:"State",
                    field:"message_state",
                    },{
                    width:"200px",
                    title:"From",
                    template:"#=volunteer_last_name#, #=volunteer_first_name#",
                    },{
                    title:"Subject",
                    field:"message_subject",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=read_message&id=#=message_id#' class='k-button'>Read</a> <a href='?p=messages&o=delete&id=#=message_id#' class='k-button'>Delete</a>"
                    },
                    ]
                });
        });
</script>
<?php
} else {
	echo 'You do not have access to this resource.';
}