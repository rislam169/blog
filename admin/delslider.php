<?php 
    include '../lib/Session.php';
    Session::checksession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php
    $db = new Database();
?>
<?php 
	if (!isset($_GET['delsliderid']) && $_GET['delsliderid'] == NULL) {
        echo "<script> window.location = 'sliderlist.php';</script>";
	}else{
		$sliderid = $_GET['delsliderid'];

		$query = "SELECT * FROM tbl_slider WHERE id = '$sliderid'";
		$getdata = $db->select($query);
		if ($getdata) {
			$delimg = $getdata->fetch_assoc();
			unlink($delimg['image']);
		}
	}

	$delquery = "DELETE FROM tbl_slider WHERE id = $sliderid";
	$deldata = $db->delete($delquery);
	if ($deldata) {
		echo "<script>alert('Slider deleted Successfully!!!');</script>";
        echo "<script> window.location = 'sliderlist.php';</script>";
	}else{
		echo "<script>alert('Slider Not Deleted!!!');</script>";
        echo "<script> window.location = 'sliderlist.php';</script>";		
	}
 ?>