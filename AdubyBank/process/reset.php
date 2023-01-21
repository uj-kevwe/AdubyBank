<?php
	include("../Assets/database/setup.php");
	print_r($_POST);
	$pass1 = $_POST["newpassword1"];
	$pass2 = $_POST["newpassword2"];
	$email = $_POST["email"];
	$fname = $_POST["fname"];
	echo "<input type = 'hidden' id = 'email' value = $email>";
	echo "<input type = 'hidden' id = 'fname' value = $fname>";

	if($pass1 == $pass2){
		$password = password_hash($pass1, PASSWORD_DEFAULT);

		$sql = "update tellers
					set password = '$password'
					where email = '$email';
				";
		$result = $conn->query($sql);

		if(!$conn->error){
			echo "<script>
					alert('Password changed successfully');
					window.location.replace('../index.php');
				  </script>";
		}
		else{
			echo $conn->error;
		}
	}
	else{
		echo "<script>
				var email = document.getElementById('email').value; 
				var fname = document.getElementById('fname').value;
				alert('Both Password must match');
				window.location.replace('resetPassword.php?email='+email+'&fname='+fname);
			 </script>";
	}
?>