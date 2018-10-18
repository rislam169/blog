<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title  = mysqli_real_escape_string($db->link, $_POST['title']);
        $cat_id = mysqli_real_escape_string($db->link, $_POST['cat_id']);
        $body   = mysqli_real_escape_string($db->link, $_POST['body']);
        $author = mysqli_real_escape_string($db->link, $_POST['author']);
        $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
        $description = mysqli_real_escape_string($db->link, $_POST['description']);
        $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if ($title == "" || $cat_id == "" || $body == "" || $author == "" || $tags == "" || $description == "") {
           echo "<span class='error'>Field must not be empty!! </span>";
        }elseif(empty($file_name)) {
            echo "<span class='error'>Please Select any Image !</span>";
        }elseif ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

        } else{
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO tbl_post(cat_id, title, body, image, author, tags, meta_description, userid) VALUES('$cat_id', '$title', '$body', '$uploaded_image', '$author', '$tags', '$description', '$userid')";
            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
                echo "<span class='success'>Data Inserted Successfully.</span>";
            }else {
                echo "<span class='error'>Data Not Inserted !</span>";
            }
        }
    }
 ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat_id">
                                    <option>Select Category</option>
                            <?php 
                                $query = "SELECT * FROM tbl_category";
                                $category = $db->select($query);
                                if ($category) {
                                    while ($result = $category->fetch_assoc()) {

                             ?>
                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['cat_name']; ?></option>
                            <?php } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" readonly value="<?php echo Session::get('username') ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('id') ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Meta Description</label>
                            </td>
                            <td>
                                <input type="text" name="description" placeholder="Enter Meta Description..." class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
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
