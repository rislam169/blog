<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $note  = mysqli_real_escape_string($db->link, $fm->validation($_POST['note']));

        if ($note == "") {
            echo "<span class='error'>Field must not be empty!! </span>";
        }else{
            $updatequery  = "UPDATE tbl_slogan set
                    note = '$note'
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
                <div class="block copyblock">
<?php 
    $query = "SELECT * FROM tbl_slogan WHERE id = '1'";
    $socialdata = $db->select($query);
    if ($socialdata) {
        $result = $socialdata->fetch_assoc();   

 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>
