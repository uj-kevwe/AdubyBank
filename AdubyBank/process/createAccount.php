<?php
	include("../Assets/database/setup.php");

	//print_r($_POST);
	$staffId = $_POST["kycStaffID"]; echo "<input type = 'hidden' id = 'staffid' value = '$staffId'>";
	$salute = $_POST["salute"]; 
	echo "<input type = 'hidden' id = 'salute' value = '$salute'>";
	$fname = $_POST["firstname"]; 
	echo "<input type = 'hidden' id = 'fname' value = '$fname'>";
	$mname = $_POST["midname"]; 
	echo "<input type = 'hidden' id = 'mname' value = '$mname'>";
	$lname = $_POST["lastname"]; 
	echo "<input type = 'hidden' id = 'lname' value = '$lname'>";
	$gender = $_POST["gender"]; 
	echo "<input type = 'hidden' id = 'gender' value = '$gender'>";
	$dob = $_POST["dob"]; 
	echo "<input type = 'hidden' id = 'dob' value = '$dob'>";
	$email = $_POST["email"]; 
	echo "<input type = 'hidden' id = 'email' value = '$email'>";
	$phone = $_POST["phone"]; 
	echo "<input type = 'hidden' id = 'phone' value = '$phone'>";
	$acctnum = $_POST["acct_number"]; 
	echo "<input type = 'hidden' id = 'acctnum' value = '$acctnum'>";

	if($_POST["acctType"] == "Current Account"){
		$accttype = 1;
	}
	else if($_POST["acctType"] == "Savings Account"){
		$accttype = 2;
	}
	else if($_POST["acctType"] == "Corporate Account"){
		$accttype = 3;
	}
	else if($_POST["acctType"] == "Fixed Deposit Account"){
		$accttype = 4;
	}
	else{
		echo "<script>
				alert('Account Type can not be nill');
				window.location.replace('../dashboard.php');
			</script>";
	}
	$createdate = date("Y-m-d"); echo "<input type = 'hidden' id = 'createdate' value = '$createdate'>";

	if($staffId == "Select a Teller ID"){
		echo "<script>
				alert('You must select a Staff ID');
				window.location.replace('../dashboard.php');
			</script>";
	}
	if($salute == "Select Salutation"){
		echo "<script>
				alert('You must select a legal Salutation');
				window.location.replace('../dashboard.php');
			</script>";
	}
	if($gender == "Select Gender"){
		echo "<script>
				alert('You must select Male or Female');
				window.location.replace('../dashboard.php');
			</script>";
	}
	if(empty($acctnum)){
		echo "<script>
				alert('You must click on Generate Account Number');
				window.location.replace('../dashboard.php');
			</script>";
	}

	if($acctnum == "Try Generate another Number"){
		echo "<script>
				alert('You Must have a valid account number generated for this Customer');
				window.location.replace('../dashboard.php');
			  </script>";
	}
	$sql = "select * from accountnumbers";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		$row_num = $result->num_rows + 1;
	}
	else{
		$row_num = 1;
	}
	$acctId = "CUSACCT".$row_num;
	$sql = "insert into accountnumbers 
			(AccountNumberID,AccountNumber,AccountType, CreatedDate,StaffID)
			values
			('$acctId','$acctnum',$accttype,'$createdate','$staffId')";
	$result = $conn->query($sql);

	if(!$conn->error){
		//Add records to Accounts
		$cusId = "CUSTOMERID".$row_num;
		$sql2 = "insert into Customer
					(CustomerID,AccountNumberID,FirstName,MiddleName,LastName,Date_of_birth,Gender,Salutation,Email,Phone,AccountStatus)
					values
					('$cusId','$acctId','$fname','$mname','$lname','$dob','$gender','$salute','$email','$phone',0)
				";

		$result2 = $conn->query($sql2);

		if(!$conn->error){
			$sql3 = "insert into AccountsHistory
						(AccountNumberID,CustomerID,TrxnDate,Amount,PreTrxnBalance,TransactionType,PostTrxnBalance,Narration)
						values
						('$acctId','$cusId','$createdate',0.0,0.0,0,0.0,'New Account Onboarded')
					";
			$result3 = $conn->query($sql3);

			if(!$conn->error){
				echo '<script>
					var accountname = document.getElementById("fname").value + " " + document.getElementById("mname").value + " " + document.getElementById("lname").value;
					var accountnumber = document.getElementById("acctnum").value;
					var date = document.getElementById("createdate").value;
					alert("Customer Account with the following details created successfully\nACCOUNT NAME: " 
						+ accountname + "\nACCOUNT NUMBER: " + accountnumber 
						+ "\nDATE: " + date);
					window.location.replace("../dashboard.php"); 
				 </script>';
			}
			else{
				echo "<br>";
				echo $conn->error;
			}
			
		}
		else{
			echo "<br>";
			echo $conn->error;
		}
	}
	else{
		echo "<br>";
		echo $conn->error;
	}
?>