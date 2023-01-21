<?php
	include("Assets/database/dbsetup.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("include_files/head_tags.php"); ?>
</head>
<body id="body">
	<?php
		include ("include_files/header.php");
	?>
	<form id="login-form" action = "process/signin.php" method="post">
		<div class="formgroup">
			<label for="userid">Teller ID or Email</label>
			<input type="text" name="userid" id="userid" placeholder="Enter your User ID or Email">
		</div>
		<div class="formgroup">
			<label for="userpass">Password</label>
			<input type="password" name="userpass" id="userpass" placeholder="Enter your Password">
		</div>
		<div class="formgroup">
			<input type="submit" name="submit" id="submit" placeholder="Sign In">
		</div>
	</form>
</body>
</html>