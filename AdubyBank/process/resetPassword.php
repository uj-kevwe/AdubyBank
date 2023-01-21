<?php
	$email = $_GET["email"];
	$fname = $_GET["fname"];
	
?>
<style type="text/css">
	#body{
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		position: fixed;
		background-color: black;
	}
	#reset{
		top: 25%;
		left: 30%;
		right: 30%;
		bottom: 25%;
		position: fixed;
		background-color: white;
		z-index: 2;
		line-height: 2;
	}
	#reset h4, #reset p, #reset form{
		margin-left: 5%;
		width: 90%;
	}
	#reset input[type=password]{
		width: 70%;
		height: 40px;
		margin-left: 5%;
		margin-top: 5px;
		margin-bottom: 5px;
	}
	#reset input[type=submit]{
		margin-left: 5%;
		width: 35%;
		height: 40px;
	}
</style>
<div id="body">
	<div id="reset">
		<form action="reset.php" method="post">
			<input type = 'hidden' name = 'email' id = 'email' value = '<?php echo $email ?>'>
			<input type = 'hidden' name = 'fname' id = 'fname' value = '<?php echo $fname ?>'>
			<h4>Hello <?php echo $fname ?>,</h4>
			<p>Provide a New Password in the field provided below</p>
			<input type="password" name="newpassword1" placeholder="Type Password Here">
			<input type="password" name="newpassword2" placeholder="Confirm Password Here">
			<input type="submit" name="submit" id="submit" value="Reset">
		</form>
	</div>
</div>