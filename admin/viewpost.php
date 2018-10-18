<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
<?php 
    if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL) {
        echo "<script> window.location = 'postlist.php';</script>";
    }else{
        $viewpostid = $_GET['viewpostid'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Post</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
    }
 ?>
                <div class="block">
    <?php 
        $query = "SELECT * FROM tbl_post WHERE id = '$viewpostid'";
        $postdata = $db->select($query);
        if ($postdata) {
            while ($postresult = $postdata->fetch_assoc()) {

     ?>               
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['title']; ?>"  class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
                            <?php 
                                $query = "SELECT * FROM tbl_category";
                                $category = $db->select($query);
                                if ($category) {
                                    while ($result = $category->fetch_assoc()) {

                             ?>
                                    <option 
                        <?php 
                            if ($postresult['cat_id'] == $result['id']) {
                                echo "selected = 'selected'";
                            }
                         ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['cat_name']; ?></option>
                            <?php } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['image']; ?>" alt="Post Image" height="100px" width="250px"><br/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['author']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Meta Description</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['meta_description']; ?>" class="medium" />
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
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>
