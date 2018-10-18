<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<?php 
	$query = "SELECT * FROM tbl_theme WHERE id = '1'"; 
	$theme = $db->update($query);
	$result = $theme->fetch_assoc();

	if ($result['theme'] == "default") {
?>
		<link rel="stylesheet" href="themes/default.css">
<?php
	}  
	if ($result['theme'] == "purple") {
?>
		<link rel="stylesheet" href="themes/purple.css">
<?php
	}
	if ($result['theme'] == "lime") {
?>
		<link rel="stylesheet" href="themes/lime.css">
<?php } ?>