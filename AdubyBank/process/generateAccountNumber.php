<?php
	include("../Assets/database/setup.php");

	//create Account Numbers Table if Not Exists
	/*
		Account Type
		1. Current
		2. Savings
		3. Corporate
		4. Fixed;
	*/
	$sql = "create table if not exists AccountNumbers(
				sno int not null primary key auto_increment,
				AccountNumberID varchar(20) not null unique,
				AccountNumber varchar(10) not null unique,
				AccountType int(1) not null,
				CreatedDate date not null,
				StaffID varchar(15) not null 
		   )";

	$result = $conn->query($sql);
	if(!$conn->error){
		//call account number generator
		$account_number = generateAcct();

		//create Customers Table if not exists
		/*
			AccountStatus
			0. -  New Account
			1. -  Active
			2. -  Inactive
			3. -  Dormant
			4. -  Closed

		*/

		$sql2 = "create table if not exists Customer(
					sno int not null primary key auto_increment,
					CustomerID varchar(20) not null unique,
					AccountNumberID varchar(20) not null,
					FirstName varchar(50) not null,
					MiddleName varchar(50) not null,
					LastName varchar(50) not null,
					Date_of_birth date not null,
					Gender varchar(10) not null,
					Salutation varchar(20) not null,
					Email varchar(50) not null,
					Phone varchar(20) not null,
					AccountStatus int(1) not null
				)";
		$result2 = $conn->query($sql2);

		if(!$conn->error){
			//create Accounts Table if not exists
			/*
				Transaction Type
				0. Not Applicable
				1. Credit/Deposit
				2. Debit/Withdrawal
			*/
			$sql3 = "create table if not exists AccountsHistory(
						sno int not null primary key auto_increment,
						AccountNumberID varchar(20) not null,
						CustomerID varchar(20) not null,
						TrxnDate date not null,
						Amount decimal(19,2) not null,
						PreTrxnBalance decimal(19,2) not null,
						TransactionType int(1) not null,
						PostTrxnBalance decimal(19,2) not null,
						Narration text null
					)";
			$result3 = $conn->query($sql3);

			if(!$conn->error){
				echo $account_number;
			}
			else{
				echo $conn->error;
				echo "<script>
						alert('1. Error Creating Account');
						window.location.replace('../dashboard.php');
					  </script>";
			}
		}
		else{
			echo $conn->error;
			echo "<script>
					alert('2. Error Creating Account');
					window.location.replace('../dashboard.php');
				  </script>";
		}
		
	}
	else{
		echo $conn->error;
		echo "<script>
				alert('3. Error Creating Account');
				window.location.replace('../dashboard.php');
			  </script>";
	}


	function generateAcct(){
		$acct = strval(rand(0000000000,9999999999));
		if(strlen($acct) < 10){
			$acct = "Try Generate another Number";
			generateAcct();
		}
		
			return $acct;	
		
		
	}
?>