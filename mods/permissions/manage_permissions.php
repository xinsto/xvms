<?php
if(isset($_SESSION['volunteer_id'])) {
?>
<div id="section_240_left">
	<div id="grid"></div>
</div>
<div id="section_720_right">
	<div id="permission_view">
		<div id="pane1"></div>
	</div>
	<br />
	
	 
</div>
<div id="clear"></div>



<script>
$(document).ready(function() {

	var dataSource = new kendo.data.DataSource({
    	transport: {
        	read: {
            	url: "mods/permissions/data/get_all_permissions.php",
	            dataType: "json"
    	    }
	    },
            schema: {
            	model: {
            		id: "mod_name",
                	fields: {
                    	mod_name: { type: "number" },
	                    mod_display_name: { type: "string" }
                	}
                }
                
            },
		pageSize: 50,
	});	
	
	$("#permission_view").height(700).trigger("resize");
	var splitter = $("#permission_view").kendoSplitter({
		panes: [
			{ size: "700px",
			  contentUrl: "?p=edit_permission",
			}
		],
		orientation: "vertical"
	}).data("kendoSplitter");
	$("#grid").kendoGrid({
    	dataSource: dataSource,
    		
            height: 700,
            filterable: true,
            sortable: true,
            pageable: true,
            selectable:true,
            scrollable: {
            	virtual:true,
            },
            change: onChange, 
            columns: [{
            	width:"235px",
            	title:"Modules",
                field:"mod_display_name",
            }],

            
            
    		
    });
    
    
    function onChange() {
    	var row = this.select();
		var id = row.data("id");
		//var splitter = $("#mySplitter").data("kendoSplitter");
    	splitter.ajaxRequest("#pane1", "?p=edit_permission", { id: id });    
    }
    


});

    function goCreateUser() {
		var splitter = $("#ticket_view_pane").kendoSplitter().data("kendoSplitter");
    	splitter.ajaxRequest("#pane1", "?p=create_user");    
    }
    

 

    
</script>

<?php
} else {
	echo 'You do not have access to this resource.';
}
?>