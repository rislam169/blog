<?php 
	if (isset($_GET['pageid'])) {
		$pageid = $_GET['pageid'];

		$query = "SELECT * FROM tbl_page WHERE id = '$pageid'";
		$pagedata = $db->select($query);
		if ($pagedata) {
			$result = $pagedata->fetch_assoc();
?>
		<title><?php echo $result['name']; ?> | <?php echo TITLE; ?></title>
<?php 	} 
	}elseif (isset($_GET['category'])) {
			$categoryid = $_GET['category'];

			$query = "SELECT * FROM tbl_category WHERE id = '$categoryid'";
			$catdata = $db->select($query);
			if ($catdata) {
				$result = $catdata->fetch_assoc();
?>
				<title><?php echo $result['cat_name']." Posts"; ?> | <?php echo TITLE; ?></title>
<?php   	} 
	}elseif (isset($_GET['id'])) {
			$postid = $_GET['id'];

			$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
			$postdata = $db->select($query);
			if ($postdata) {
				$result = $postdata->fetch_assoc();
?>
				<title><?php echo $result['title']; ?> | <?php echo TITLE; ?></title>
<?php   	} 
	}else{
?>
		<title><?php echo $fm->title(); ?> | <?php echo TITLE; ?></title>
<?php } ?>
	

	<meta name="language" content="English">
<?php 
	if (isset($_GET['id'])) {
		$pageid = $_GET['id'];
		$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
		$pagedata = $db->select($query);
		if ($pagedata) {
			$result = $pagedata->fetch_assoc();
?>
	
	<meta name="description" content="<?php echo $result['meta_description']; ?>">
	<meta name="keywords" content="<?php echo $result['tags']; ?>">

<?php } }else{ ?>
	<meta name="keywords" content="<?php echo META_DESCRIPTION; ?>">
	<meta name="keywords" content="<?php echo KEYWORDS; ?>">
<?php } ?>
	<meta name="author" content="Rafiq">