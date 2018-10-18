<?php include 'inc/header.php'; ?>
<?php include 'inc/adminSidbar.php'; ?>
<?php 
    if (Session::get('userRole') != 0) { 
        echo "<script> window.location = 'index.php';</script>";
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $fm->validation($_POST['username']);
        $password = $fm->validation(md5($_POST['password']));
        $email     = $fm->validation($_POST['email']);
        $role     = $fm->validation($_POST['role']);
        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);
        $email     = mysqli_real_escape_string($db->link, $email);
        $role     = mysqli_real_escape_string($db->link, $role);

        if (empty($username) || empty($password) || empty($role) || empty($email)) {
           echo "<span class='error'>Field must not be empty!! </span>";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<span class='error'>Email is not valid!! </span>";
        }else{
            $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
            $checkmail = $db->select($mailquery);
            if ($checkmail) {
               echo "<span class='error'>Email is Already Exist!! </span>";
            }else{
                $query = "INSERT INTO tbl_user(username, password, email, role) values('$username', '$password', '$email', '$role')";
                $userinsert = $db->insert($query);
                if ($userinsert) {
                    echo "<span class='success'>User Created Successfully!!!</span>";
                }else{
                    echo "<span class='error'>User Not Created!!!</span>";
                }
            }
        }
        
    }
 ?>    
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td><label for="username">User Name</label></td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>                   
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>                   
                        <tr>
                            <td><label for="password">Email</label></td>
                            <td>
                                <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
                            </td>
                        </tr>					
                        <tr>
                            <td><label for="role">Role</label></td>
                            <td>
                                <select name="role" id="select">
                                    <option>Select Role</option>
                                    <option value="0">admin</option>
                                    <option value="1">author</option>
                                    <option value="2">editor</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>