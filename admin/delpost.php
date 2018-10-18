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
	if (!isset($_GET['delpostid']) && $_GET['delpostid'] == NULL) {
        echo "<script> window.location = 'postlist.php';</script>";
	}else{
		$postid = $_GET['delpostid'];

		$query = "SELECT * FROM tbl_post WHERE id = '$postid'";
		$getdata = $db->select($query);
		if ($getdata) {
			$delimg = $getdata->fetch_assoc();
			unlink($delimg['image']);
		}
	}

	$delquery = "DELETE FROM tbl_post WHERE id = $postid";
	$deldata = $db->delete($delquery);
	if ($deldata) {
		echo "<script>alert('Post deleted Successfully!!!');</script>";
        echo "<script> window.location = 'postlist.php';</script>";
	}else{
		echo "<script>alert('Post Not Deleted!!!');</script>";
        echo "<script> window.location = 'postlist.php';</script>";		
	}
 ?>