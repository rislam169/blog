<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fb  = mysqli_real_escape_string($db->link, $fm->validation($_POST['fb']));
        $tw = mysqli_real_escape_string($db->link, $fm->validation($_POST['tw']));
        $ln   = mysqli_real_escape_string($db->link, $fm->validation($_POST['ln']));
        $gp = mysqli_real_escape_string($db->link, $fm->validation($_POST['gp']));

        if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
            echo "<span class='error'>Field must not be empty!! </span>";
        }else{
            $updatequery  = "UPDATE tbl_social set
                    fb = '$fb',
                    tw = '$tw', 
                    ln = '$ln',
                    gp = '$gp' 
                    WHERE id = '1'";
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
    $query = "SELECT * FROM tbl_social WHERE id = '1'";
    $socialdata = $db->select($query);
    if ($socialdata) {
        while ($result = $socialdata->fetch_assoc()) {

 ?>                 
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="ln" value="<?php echo $result['ln']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
<?php } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>