<div id="content">
	<div id="header">
<h1><?php echo $organization_name; ?></h1>
		<p><?php echo $title; ?><span id="application_version"><a href="http://geekismybloodtype.com/projects/volunteer-management/" id="a_version">v<?php echo $version; ?></span></a></p>
		
		<div id="user_options"><?php if($_GET['p'] != 'login') { if(isset($_SESSION['volunteer_id'])) {?><a href="?p=documentation" id="documentation"><img src="img/icons/32x32/help.png" border="0"/></a><a href="?p=logoff"><img src="img/icons/32x32/cancel.png" border="0"/></a><?php } } ?></div>
		
	</div>
	<?php if($_GET['p'] != 'login') { ?>
	<?php if(isset($_SESSION['volunteer_id'])) { ?>
		<div id="main_menu">
			<ul id="menu">
				<?php
				//GET MENU FROM mods TABLE 
				$sql = "SELECT * FROM mods WHERE mod_type = '1' AND mod_acl_control_id <= '$_SESSION[volunteer_acl_id]' AND mod_active_inactive = '1' ORDER BY mod_weight";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);
				echo mysql_error();
				$i = 0;
				while ($i < $num) {
					
					$mod_display_name = mysql_result($result, $i, "mod_display_name");
					$mod_name = mysql_result($result, $i, "mod_name");
					$mod_parent_name = mysql_result($result, $i, "mod_parent_name");
									
					if($mod_parent_name == 'none') {						
						$get_child_count = "SELECT * FROM mods WHERE mod_parent_name = '$mod_name' AND mod_type = '2' ORDER BY mod_weight";
						$get_child_count_result = mysql_query($get_child_count);
						$get_child_count_num = mysql_num_rows($get_child_count_result);
						$i_get_child_count = 0;
						echo mysql_error();
						if($get_child_count_num >= 1) {
							echo '<li>'.$mod_display_name.'<ul>';
							//GET CHILD ITEMS
							while ($i_get_child_count < $get_child_count_num) {
								
								$child_mod_display_name = mysql_result($get_child_count_result, $i_get_child_count, "mod_display_name");
								$child_mod_name = mysql_result($get_child_count_result, $i_get_child_count, "mod_name");
								
								echo '<li><a href="?p='.$child_mod_name.'">'.$child_mod_display_name.'</a></li>';
								
								$i_get_child_count++;
							}
							echo '</ul></li>';
						} else {
							echo '<li><a href="?p='.$mod_name.'">'.$mod_display_name.'</a></li>';
						}					
					};
					
					$i++;
				}
				?>

			</ul>
			
		<div>
	
</div>
<div id="clear"></div>
<?php
//echo $_SESSION[volunteer_acl_id];
?>

<script>
$(document).ready(function() {
    $("#menu").kendoMenu();
});
</script>
<?php 
} 
} 
?>