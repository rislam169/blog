<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock">
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['theme'])) {
        $theme = mysqli_real_escape_string($db->link, $_POST['theme']);

        $query = "UPDATE tbl_theme SET theme = '$theme' WHERE id = '1'";
        $themeupdate = $db->insert($query);
        if ($themeupdate) {
            echo "<span class='success'>Theme Updated Successfully!!!</span>";
        }else{
            echo "<span class='error'>Theme Not Updated!!!</span>";
        }    
    }
 ?>    
<?php 
     $query = "SELECT * FROM tbl_theme WHERE id = '1'"; 
     $theme = $db->update($query);
     if ($theme) {
         $result = $theme->fetch_assoc();
   ?> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                               <input <?php if ($result['theme']=="default") {echo "checked";} ?> type="radio" name="theme" value="default">Default
                            </td>
                        </tr>                   
                        <tr>
                            <td>
                               <input <?php if ($result['theme']=="purple") {echo "checked";} ?> type="radio" name="theme" value="purple">Purple
                            </td>
                        </tr>                   
                        <tr>
                            <td>
                               <input <?php if ($result['theme']=="lime") {echo "checked";} ?> type="radio" name="theme" value="lime">Lime
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