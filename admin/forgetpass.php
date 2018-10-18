<?php 
	include '../lib/Session.php';
	Session::checklogin();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = $fm->validation($_POST['email']);
			$email = mysqli_real_escape_string($db->link, $email);

			if (empty($email)) {
				echo "<h4 style='color:red;font-weight:bold;'>Field Must Not be Empty!!!</h4>";
			}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	            echo "<h4 style='color:red;font-weight:bold;'>Email is not valid!!!</h4>";
			}else{
				$mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
	            $checkmail = $db->select($mailquery);
	            if (!$checkmail) {
	            	echo "<h4 style='color:red;font-weight:bold;'>Email is Not Exist!!!!</h4>";
	            }else{
	            	$value = $checkmail->fetch_assoc();
	            	$userid = $value['id'];
	            	$username = $value['username'];

	            	$text = substr($email, 0, 3);
	            	$rand = rand(1000, 9999);
	            	$newpass = "$text$rand";
	            	$password = md5($newpass);

	            	$updatequery = "UPDATE tbl_user SET password = '$password' WHERE id = $userid ";
	            	$updated_row = $db->update($updatequery);

	            	$to      = $email;
	            	$from    = "rafiqr961@gmail.com";
					$subject = 'Your Password';
					$message = 'hello, Your username is: '.$username.' and password is: '.$newpass.' Please visit website to login';
					$headers = 'From: $from' . "\r\n" .
					    'Reply-To: webmaster@example.com' . "\r\n" .
					    'X-Mailer: PHP/' . phpversion();

					$sendmail = mail($to, $subject, $message, $headers);
					if ($sendmail) {
						echo "<h4 style='color:red;font-weight:bold;'>Password Sent to Your Email!!</h4>";
					}else{
						echo "<h4 style='color:red;font-weight:bold;'>Email Not Sent!!!!!</h4>";
					}
	            }
			}	
		}
	 ?>	

		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Mail" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Md. Rafiqul Islam</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>