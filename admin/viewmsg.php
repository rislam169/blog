<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script> window.location = 'inbox.php';</script>";
    }else{
        $msgid = $_GET['msgid'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location = 'inbox.php';</script>";
    }
 ?>
                <div class="block">
    <?php 
        $query = "SELECT * FROM tbl_contact WHERE id = '$msgid'";
        $msgdata = $db->select($query);
        if ($msgdata) {
            $msgresult = $msgdata->fetch_assoc();

     ?>               
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $msgresult['firstname'].' '.$msgresult['lastname']; ?>"  class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $msgresult['email']; ?>"  class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->formatDate($msgresult['date']); ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                              <textarea rows="10" readonly cols="75">
                                    <?php echo $msgresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
        <?php } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>
