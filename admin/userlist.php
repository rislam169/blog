<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
    <?php 
    	if (isset($_GET['deluserid'])) {
    		$deluserid = $_GET['deluserid'];
    		$delquery = "DELETE from tbl_user WHERE id = '$deluserid'";
    		$deluserdata = $db->delete($delquery);
    		if ($deluserdata) {
                echo "<span class='success'>User Deleted Successfully!!!</span>";
            }else{
                echo "<span class='error'>User Not Deleted!!!</span>";
            }
    	}
     ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="10%">No.</th>
                            <th width="15%">Name</th>
							<th width="10%">User Name</th>
                            <th width="20%">Email</th>
                            <th width="20%">Details</th>
                            <th width="10%">Role</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$query = "SELECT * FROM tbl_user ORDER BY id DESC";
					$userData = $db->select($query);
					if ($userData) {
						$i=0;
						while ($result = $userData->fetch_assoc()) {
						$i++;	
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->textShorten($result['details'],30); ?></td>
							<td>
                                <?php
                                    if ($result['role'] == 0) {
                                        echo "Admin";
                                    }elseif ($result['role'] == 1) {
                                        echo "Author";
                                    }elseif ($result['role'] == 2) {
                                        echo "Editor";
                                    }
                                ?>        
                            </td>

							<td><a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a> 
                        <?php if (Session::get('userRole') == 0) { ?>
                            || <a onclick="return confirm('Are you sure to Delete!');" href="?deluserid=<?php echo $result['id']; ?>">Delete</a></td>
                        <?php } ?>
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
