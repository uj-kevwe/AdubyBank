<?php
	//print_r($_POST);
	include("../Assets/database/setup.php");

	$sql = "select * from tellers";
	$result = $conn->query($sql);
	echo "0";
	if($result->num_rows >= 1){
		if($_POST["tellertype"] == "Admin"){
			echo "<br> 1";
			$tellerType = 1;
			$tellerID = "Admin".rand(2,1000);
		}
		else if($_POST["tellertype"] == "Cash Processing Teller"){
			echo "<br> 2";
			$tellerType = 2;
			$tellerID = "Teller".rand(1,1000);
		}
		else if($_POST["tellertype"] == "Customer Care"){
			echo "<br> 3";
			$tellerType = 3;
			$tellerID = "CCare".rand(1,1000);

		}

		$salute = intval(str_split($_POST["salute"])[0]);
		$gender = intval(str_split($_POST["gender"])[0]);
		$firstname = $_POST["firstname"];
		$middlename = $_POST["middlename"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$address = $_POST["address"];
		$password = "1stTimePassword";


		$sql2 = "insert into tellers 
					(tellerID,tellerType,salutation,firstname,middlename,lastname,gender,email,phone,address,password)
					values
					('$tellerID',$tellerType,$salute,'$firstname','$middlename','$lastname',$gender,'$email','$phone','$address','$password')
				";
		$result2 = $conn->query($sql2);
		if(!$conn->error){
			echo "<script>
					alert('New Teller Created Successfully');
					window.location.replace('../dashboard.php');
				</script>";
		}
		else{
			echo $conn->error;
		}


	}
?>