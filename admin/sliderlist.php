<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Active Slider List</h2>
<?php 
	if (isset($_GET['inactiveid'])) {
		$inactiveid = $_GET['inactiveid'];
		$updatequery  = "UPDATE tbl_slider set
                status = '1'
                WHERE id = '$inactiveid'";
        $update_rows = $db->insert($updatequery);
        if ($update_rows) {
            echo "<h4 style='color:green;font-weight:bold;'>Image is Inactive in Slider!!!</h4>";
        }else {
            echo "<h4 style='color:red;font-weight:bold;'>Something Went Wrong!!!</h4>";
        }
	}
 ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="15%">No.</th>
							<th width="30%">Slider Title</th>
							<th width="30%">Image</th>
							<th width="25%">Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
				$query = "SELECT * FROM tbl_slider WHERE status='0' ORDER BY id DESC ";
				$sliderimage = $db->select($query);
				if ($sliderimage) {
					$i=0;
					while ($result = $sliderimage->fetch_assoc()) {
					$i++;	
			 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" alt="Slider Image" height="50px" width="80px"></td>
							<td>
								<a href="editslider.php?editsliderid=<?php echo $result['id'];?>">Edit</a>
						<?php if (Session::get('userRole') == 1) { ?>
								||
								<a href="?inactiveid=<?php echo $result['id'];?>">Inactive</a>
								 || 
								<a onclick="return confirm('Are you sure to Delete!');" href="delslider.php?delsliderid=<?php echo $result['id'];?>">Delete</a>
						<?php } ?>
							</td>
						</tr>
			<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
            <div class="box round first grid">
                <h2>Inactive Slider List</h2>
<?php 
	if (isset($_GET['activeid'])) {
		$activeid = $_GET['activeid'];
		$updatequery  = "UPDATE tbl_slider set
                status = '0'
                WHERE id = '$activeid'";
        $update_rows = $db->insert($updatequery);
        if ($update_rows) {
            echo "<h4 style='color:green;font-weight:bold;'>Image is Activate!!!</h4>";
        }else {
            echo "<h4 style='color:red;font-weight:bold;'>Something Went Wrong!!!</h4>";
        }
	}
 ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="15%">No.</th>
							<th width="30%">Slider Title</th>
							<th width="30%">Image</th>
							<th width="25%">Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
				$query = "SELECT * FROM tbl_slider WHERE status='1' ORDER BY id DESC";
				$inactiveslider = $db->select($query);
				if ($inactiveslider) {
					$i=0;
					while ($result = $inactiveslider->fetch_assoc()) {
					$i++;	
			 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" alt="Slider Image" height="50px" width="80px"></td>
							<td>
								<a href="editslider.php?editsliderid=<?php echo $result['id'];?>">Edit</a>
						<?php if (Session::get('userRole') == 1) { ?>
								||
								<a href="?activeid=<?php echo $result['id'];?>">Active</a>
								 || 
								<a onclick="return confirm('Are you sure to Delete!');" href="delslider.php?delsliderid=<?php echo $result['id'];?>">Delete</a>
						<?php } ?>
							</td>
						</tr>
			<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
