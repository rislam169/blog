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
                <h2>Reply Message</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $to  = mysqli_real_escape_string($db->link, $_POST['toemail']);
        $from  = mysqli_real_escape_string($db->link, $_POST['fromemail']);
        $subject  = mysqli_real_escape_string($db->link, $_POST['subject']);
        $message = mysqli_real_escape_string($db->link, $_POST['message']);

        $sendmail = mail($to, $subject, $message, $from);
        if ($sendmail) {
            echo  "<h4 style='color:green;font-weight:bold;'>Message Sent Successfully!!!</h4>";
        }else{            
            echo  "<h4 style='color:red;font-weight:bold;'>Message Not Sent!!!</h4>";
        }
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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="email" readonly name="toemail" value="<?php echo $msgresult['email']; ?>"  class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="email"  name="fromemail" placeholder="Enter Your Mail Address..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text"  name="subject" placeholder="Enter Subject..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message">
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    </form>
        <?php } ?>
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
