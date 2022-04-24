<?php
if(isset($_SESSION['volunteer_id'])) {

	if($_GET['o'] == 'download') {
	
		//GET FILE DOWNLOAD PATH
		$sql = "SELECT * FROM documents WHERE document_id = '$_GET[doc_id]'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		$download_path = $result['document_path'];
		
		echo '<div class="info">';
		echo 'Click this button to download the requested file --> <a href="'.$download_path.'" class="k-button">Click Here to Download</a>';
		echo '</div>';
	
	}
	
	if($_GET['o'] == 'delete') {
	
		$sql = "SELECT * FROM documents WHERE document_id = '$_GET[doc_id]'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		$doc_path = $result['document_path'];	
		
		$fh = fopen($doc_path, w) or die ("can't open file");
		fclose($fh);
		unlink($doc_path);
		
		$sql = "DELETE FROM documents WHERE document_id = '$_GET[doc_id]'";
		mysql_query($sql);
		
		echo '<div class="success">';
		echo 'The file has been deleted.';
		echo '</div>';
	
	}

$sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_GET[id]'";
$result = mysql_fetch_assoc(mysql_query($sql));
$volunteer_first_name = $result['volunteer_first_name'];
$volunteer_last_name = $result['volunteer_last_name'];
?>
<div id="section_470_left">
	<h4><?php echo $volunteer_last_name; ?>, <?php echo $volunteer_first_name; ?></h4>
	<hr />
	<a href="?p=upload_volunteer_document&id=<?php echo $_GET['id']; ?>" class="k-button">Upload Document</a>
	<p id="important_small">Only administrators can view douments uploaded for the volunteer here.</p>
</div>
<div id="clear"></div>


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
            		url: "mods/documents/data/get_volunteer_documents.php?id=<?php echo $_GET['id']; ?>",
            		dataType: "json"
        		}
    		},
                schema: {
                model: {
                fields: {
                	document_volunteer_id: { type: "number" },
                    document_id: { type: "number" },
                    document_description: { type: "string" },
                    document_name: { type: "string" },
                    document_upload_date: { type: "date" }
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
                    title:"Description",
                    field:"document_description",
                    },{
                    title:"File Name",
                    field:"document_name",
                    },{
                    title:"Upload Date",
                    field:"document_upload_date",
                    },{
                    	width:"200px",
                        title:"Options",
                        filterable: false,
                        template:"<a href='?p=volunteer_documents&o=download&id=#=document_volunteer_id#&doc_id=#=document_id#' class='k-button'>Download</a> <a href='?p=volunteer_documents&o=delete&id=#=document_volunteer_id#&doc_id=#=document_id#' class='k-button'>Delete</a>"
                    },
                    ]
                });
        });
</script>


<?php
} 
?>