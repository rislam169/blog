<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Published Post List</h2>
<?php 
	if (isset($_GET['inactiveid'])) {
		$inactiveid = $_GET['inactiveid'];
		$updatequery  = "UPDATE tbl_post set
                status = '1'
                WHERE id = '$inactiveid'";
        $update_rows = $db->insert($updatequery);
        if ($update_rows) {
            echo "<h4 style='color:green;font-weight:bold;'>Post is Unpublished!!!</h4>";
        }else {
            echo "<h4 style='color:red;font-weight:bold;'>Something Went Wrong!!!</h4>";
        }
	}
 ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Image</th>
							<th width="7%">author</th>
							<th width="8%">category</th>
							<th width="5%">tags</th>
							<th width="10%">Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
				$query = "SELECT tbl_post.*, tbl_category.cat_name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.id WHERE tbl_post.status = '0' ORDER BY tbl_post.id DESC";
				$post = $db->select($query);
				if ($post) {
					$i=0;
					while ($result = $post->fetch_assoc()) {
					$i++;	
			 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],50); ?></td>
							<td><img src="<?php echo $result['image']; ?>" alt="Post Image" height="40px" width="60px"></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['cat_name']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="viewpost.php?viewpostid=<?php echo $result['id'];?>">View</a>
						<?php if (Session::get('id') == $result['userid'] || Session::get('userRole') == 0) { ?>
								 ||
								<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a>
								 || 
								<a href="?inactiveid=<?php echo $result['id'];?>">Inactive</a>
								 || 
								<a onclick="return confirm('Are you sure to Delete!');" href="delpost.php?delpostid=<?php echo $result['id'];?>">Delete</a>
						<?php } ?>
							</td>
						</tr>
			<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
            <div class="box round first grid">
                <h2>Unublished Post List</h2>
<?php 
	if (isset($_GET['activeid'])) {
		$activeid = $_GET['activeid'];
		$updatequery  = "UPDATE tbl_post set
                status = '0'
                WHERE id = '$activeid'";
        $update_rows = $db->insert($updatequery);
        if ($update_rows) {
            echo "<h4 style='color:green;font-weight:bold;'>Post is Published!!!</h4>";
        }else {
            echo "<h4 style='color:red;font-weight:bold;'>Something Went Wrong!!!</h4>";
        }
	}
 ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Image</th>
							<th width="7%">author</th>
							<th width="8%">category</th>
							<th width="5%">tags</th>
							<th width="10%">Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
				$query = "SELECT tbl_post.*, tbl_category.cat_name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.id WHERE tbl_post.status = '1' ORDER BY tbl_post.id DESC";
				$post = $db->select($query);
				if ($post) {
					$i=0;
					while ($result = $post->fetch_assoc()) {
					$i++;	
			 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],50); ?></td>
							<td><img src="<?php echo $result['image']; ?>" alt="Post Image" height="40px" width="60px"></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['cat_name']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="?activeid=<?php echo $result['id'];?>">Active</a>
						<?php if (Session::get('id') == $result['userid'] || Session::get('userRole') == 0) { ?>
								 || 
								<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a>
								 || 
								<a onclick="return confirm('Are you sure to Delete!');" href="delpost.php?delpostid=<?php echo $result['id'];?>">Delete</a>
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
