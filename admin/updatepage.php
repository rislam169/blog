<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
<style>
    .delaction a{
        color: #444;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
        background-color: #DDDDDD;
        margin-left: 10px;
        font-weight: 400;
    }
</style>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script> window.location = 'index.php';</script>";
    }else{
        $pageid = $_GET['pageid'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Page</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name  = mysqli_real_escape_string($db->link, $_POST['name']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);

        if ($name == "" || $body == "") {
           echo "<span class='error'>Field must not be empty!! </span>";
        }else{
            $updatequery  = "UPDATE tbl_page set
                    name = '$name', 
                    body  = '$body'
                    WHERE id = '$pageid'";
            $update_rows = $db->insert($updatequery);
            if ($update_rows) {
                echo "<span class='success'>Data Updated Successfully!!!</span>";
            }else {
                echo "<span class='error'>Data Not Updated!!!</span>";
            }
        }
    }
 ?>
                <div class="block">
    <?php 
        $query = "SELECT * FROM tbl_page WHERE id = '$pageid'";
        $pagedata = $db->select($query);
        if ($pagedata) {
            while ($pageresult = $pagedata->fetch_assoc()) {

     ?>               
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Page Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $pageresult['name']; ?>"  class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Page Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $pageresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="delaction"><a onclick="return confirm('Are you sure to Delete the page!');" href="delpage.php?delpageid=<?php echo $pageresult['id']; ?>">Delete</a></span>
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
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>
