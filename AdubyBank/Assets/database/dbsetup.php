<?php
	$server = "localhost";
	$user = "root";
	$password = "";
	$conn = new mysqli($server,$user,$password);

	if(!$conn->error){
		//create database if not exists
		$sql = "create database if not exists adubybank";
		$result = $conn->query($sql);

		if(!$conn->error){
			//use database
			$sql1 = "use adubybank";
			$result1 = $conn->query($sql1);
			if($conn->error){
				echo "<br>".$conn->error;
			}
			//create Teller table
			/*
				Teller Types
				==================
				1. - Admin
				2. - Tellers
				3. - Customer Care
				
				Gender
				=======
				0. - NA
				1. - Male
				2. - Female

				Salutation
				============
				0. - NA.
				1. - Mr.
				2. - Mrs.
				3. - Miss.
				4. - Chief.
				5. - Engineer
				6. - Doctor.
				7. - Professor.
				8. - Barrister.
			*/
			$sql2 = "create table if not exists Tellers (
						sno int not null primary key auto_increment,
						tellerID varchar(15) not null unique,
						tellerType int(1) not null,
						salutation int(1) not null,
						firstname varchar(50) not null,
						middlename varchar(50) null,
						lastname varchar(50) not null,
						gender int(1) not null,
						email varchar(50) not null unique,
						phone varchar(20) not null,
						address text not null,
						password text not null
					)";
			$result2 = $conn->query($sql2);
			if($conn->error){
				echo "<br>".$conn->error;
			}

			//Create logsessions table
			$sql3 = "create table if not exists logsessions(
						sno int not null primary key auto_increment,
						tellerID varchar(15) not null,
						timestamp_login datetime not null,
						timestamp_logout datetime not null,
						device_ip varchar(20) not null
					)";
			$result3 = $conn->query($sql3);
			if($conn->error){
				echo "<br>".$conn->error;
			}

			//insert Super Admin to Tellers table if not exists

			$sql4 = "select * from Tellers";
			$result4 = $conn->query($sql4);

			if($result4->num_rows == 0){
				$tellerId = "ADMIN1";
				$tellerType = 1;
				$gender = 0;
				$salutation = 0;
				$email = "admin@adubybank.com";
				$phone = "+2349090000000";
				$address = "GFCL Coding School, 4 Akowonjo Road, Egbeda Lagos";
				$password = password_hash("1stTimePassword",PASSWORD_DEFAULT);

				$sql5 = "insert into Tellers 
							(tellerID, tellerType, salutation, firstname,middlename,lastname,gender,email,phone,address,password) 
							values 
							('$tellerId',$tellerType,$salutation,'Super','','Admin',$gender,'$email','$phone','$address','$password')
						";
				$result5 = $conn->query($sql5);
				if($conn->error){
					echo "<br>".$conn->error;
				}
			}

		}
	}
?>