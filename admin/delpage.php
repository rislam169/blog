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
	if (!isset($_GET['delpageid']) && $_GET['delpageid'] == NULL) {
        echo "<script> window.location = 'index.php';</script>";
	}else{
		$pageid = $_GET['delpageid'];
		}

	$delquery = "DELETE FROM tbl_page WHERE id = $pageid";
	$delpage = $db->delete($delquery);
	if ($delpage) {
		echo "<script>alert('Page deleted Successfully!!!');</script>";
        echo "<script> window.location = 'index.php';</script>";
	}else{
		echo "<script>alert('Page Not Deleted!!!');</script>";
        echo "<script> window.location = 'index.php';</script>";		
	}
 ?>