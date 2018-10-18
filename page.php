<?php include 'inc/header.php'; ?>
<?php 
	if (isset($_GET['pageid']) && $_GET['pageid'] != NULL) {
		$pageid = $_GET['pageid'];
	}else{
        echo "<script> window.location = '404.php';</script>";
	}
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
		<?php 
			$query = "SELECT * FROM tbl_page WHERE id = '$pageid'";
			$pagedata = $db->select($query);
			if ($pagedata) {
				$result = $pagedata->fetch_assoc();
		 ?>
				<h2><?php echo $result['name']; ?></h2>
	
				<?php echo $result['body']; ?>
		<?php }else{ echo "<h2>Page Not Found!!!</h2>";} ?>
	</div>

		</div>
<?php include 'inc/sidebar.php' ?>		
<?php include 'inc/footer.php' ?>	