<?php
if(isset($_SESSION['volunteer_id'])) {
	if($_POST['submit'] == 'Submit') {
		$date = date('Y-m-d');
		$time = date('H-i-s');
		$volunteer_id = $_GET['id'];
		$file_name = $date.'_'.$time.'_'.$volunteer_id;
		
		$err = array();
		$suc = array();
		$len_des = strlen($_POST['description']);
		if($len_des < 1) {
			$err[] = 'You must specifiy a description.';
		}
		
		if ($_FILES["file"]["error"] > 0) {
			$err[] = 'The was an error uploading your document.';
	 	}
	 	
	 	if(count($err)) {
	 	
	 		echo '<div class="error">';
	 		echo implode('<br />', $err);
	 		echo '</div>';
	 		
	 	
	 	}
	 		
		if(!count($err)) {	
			function file_extension($filename)
			{
   			 return end(explode(".", $filename));
			}
			
			$file_ext = file_extension($_FILES["file"]["name"]);
			$file_name = $file_name.'.'.$file_ext;
			$real_file_name = $_FILES["file"]["name"];
			
    		if(file_exists("mods/documents/uploads/" . $file_name)) {
		      echo $file_name . " already exists. ";
      		} else {
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"mods/documents/uploads/" . $file_name);
				//echo "Stored in: " . "mods/documents/uploads/" . $file_name;
	    	}
	    	
	    	$description = mysql_real_escape_string($_POST['description']);
	    	$path = 'mods/documents/uploads/' . $file_name;
	    	
	    	$sql = "INSERT INTO documents (document_name, document_description, document_path, "
	    	."document_volunteer_id, document_type, document_upload_date) VALUES "
	    	."('$real_file_name', '$description', '$path', '$volunteer_id', '3', '$date')";
	    	mysql_query($sql);
	    	echo mysql_error();
	    	
	    	echo '<div class="success">';
	    	echo 'The file was successfuly uploaded';
	    	echo '</div>';
	    	
	    	
		}
		
		
		
		
  }

$sql = "SELECT * FROM volunteers WHERE volunteer_id = '$_GET[id]'";
$result = mysql_fetch_assoc(mysql_query($sql));
$volunteer_first_name = $result['volunteer_first_name'];
$volunteer_last_name = $result['volunteer_last_name'];
?>

<div id="section_470_left">
<a href="?p=volunteer_documents&id=4" class="k-button">Back to Documents</a>
<br />
<br />
	<h4><?php echo $volunteer_last_name; ?>, <?php echo $volunteer_first_name; ?></h4>
	<hr />
	<form action="" method="post" enctype="multipart/form-data">
		<label for="file">Filename:</label>
		<input type="file" name="file" id="file" /> 
		<br />
		<br />
		<label for="file">File Description:</label>
		<input type="text" name="description" id="input_full" class="k-textbox" /> 
		<br />
		<p id="important_small">A "File Description" is required to upload a file.</p>
		<p id="small"><em>Example:</em> "Volunteer Application"</p>
		<br />
		<input type="submit" name="submit" value="Submit" />
	</form>
</div>
<div id="clear"></div>



<?php
} 
?>