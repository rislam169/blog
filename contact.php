<?php include 'inc/header.php'; ?>
<div class="contentsection contemplete clear">
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fname = $fm->validation($_POST['firstname']);
		$lname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body = $fm->validation($_POST['body']);

		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$body = mysqli_real_escape_string($db->link, $body);

		$error = "";
		$msg = "";
		if (empty($fname)){
			$error = "First Name can not be empty<br/>";
		}if (empty($lname)){
			$error = $error."Last Name can not be empty<br/>";
		}if (empty($email)){
			$error = $error."Email Field can not be empty<br/>";
		}if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = $error."Email is not valid<br/>";
		}if (empty($body)){
			$error = $error."Message Field can not be empty<br/>";
		}else{
			$query = "INSERT INTO tbl_contact(firstname, lastname, email, body) values('$fname','$lname','$email','$body')";
			$insert_row = $db->insert($query);
			if ($insert_row) {
				$msg = "Messege Sent Successfully!!!";
			}else{
				$error = "Messege Not Sent!!!";
			}
		}
	}

 ?>
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
<?php 
	if (isset($error)) {
		echo  "<h4 style='color:red;font-weight:bold;'>$error</h4>";	
	}if (isset($msg)) {
		echo  "<h4 style='color:green;font-weight:bold;'>$msg</h4>";
	}
?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit"/>
						</td>
					</tr>
				</table>
				<form>				
				</div>

			</div>
			<?php include 'inc/sidebar.php' ?>	
			<?php include 'inc/footer.php' ?>	