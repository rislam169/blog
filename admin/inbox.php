<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php 
	if (isset($_GET['seenid'])) {
		$seenid = $_GET['seenid']; 
		$updatequery  = "UPDATE tbl_contact set
                status = '1'
                WHERE id = '$seenid'";
        $update_rows = $db->insert($updatequery);
        if ($update_rows) {
            echo "<h4 style='color:green;font-weight:bold;'>Message Sent to Seen Box!!!</h4>";
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
								<th width="15%">Name</th>
								<th width="15%">Email</th>
								<th width="25%">Message</th>
								<th width="20%">Date</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
				<?php 
					$query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
					$msg = $db->select($query);
					if ($msg) {
						$i=0;
						while ($result = $msg->fetch_assoc()) {
						$i++;
				 ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
								<td><?php echo $result['email']; ?></td>
								<td><?php echo $fm->textShorten($result['body'],50); ?></td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td>
									<a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> || 
									<a href="replymsg.php?msgid=<?php echo $result['id'] ?>">Reply</a> ||
									<a href="?seenid=<?php echo $result['id'] ?>">Seen</a>
								</td>
							</tr>
				<?php } } ?>
						</tbody>
					</table>
            	</div>
            </div>
            <div class="box round first grid">
                <h2>Seen Messages</h2>
<?php 
	if (isset($_GET['delid'])) {

		$delid = $_GET['delid']; 
		$delquery = "DELETE FROM tbl_contact WHERE id = $delid";
		$delmessage = $db->delete($delquery);
		if ($delmessage) {
			echo "<h4 style='color:green;font-weight:bold;'>Message deleted Successfully!!!</h4>";
		}else{
			echo "<h4 style='color:red;font-weight:bold;'>Message Not Deleted!!!</h4>";		
		}
	}
	if (isset($_GET['unseenid'])) {
		
		$unseenid = $_GET['unseenid'];
		$updatequery  = "UPDATE tbl_contact set
                status = '0'
                WHERE id = '$unseenid'";
        $update_rows = $db->insert($updatequery);
        if ($update_rows) {
            echo "<h4 style='color:green;font-weight:bold;'>Message Sent to UnSeen Box!!!</h4>";
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
								<th width="15%">Name</th>
								<th width="15%">Email</th>
								<th width="25%">Message</th>
								<th width="20%">Date</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
				<?php 
					$query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
					$msg = $db->select($query);
					if ($msg) {
						$i=0;
						while ($result = $msg->fetch_assoc()) {
						$i++;
				 ?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
								<td><?php echo $result['email']; ?></td>
								<td><?php echo $fm->textShorten($result['body'],50); ?></td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td>
									<a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> ||
									<a href="?unseenid=<?php echo $result['id'] ?>">Unseen</a> ||
									<a onclick="return confirm('Are you sure to Delete!');" href="?delid=<?php echo $result['id'] ?>">Delete</a>
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
