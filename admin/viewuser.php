<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
<?php 
    if (isset($_GET['userid'])) {
        $userid = $_GET['userid'];
    }else{
        echo "<script> window.location = 'userlist.php';</script>";
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Details</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location = 'userlist.php';</script>";
    }
 ?>
                <div class="block">
    <?php 
        $query = "SELECT * FROM tbl_user WHERE id = '$userid'";
        $userdata = $db->select($query);
        if ($userdata) {
            while ($result = $userdata->fetch_assoc()) {

     ?>               
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['username']; ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce">
                                    <?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
        <?php } } ?>
                </div>
            </div>
        </div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
    });
</script>
<?php include 'inc/footer.php'; ?>
