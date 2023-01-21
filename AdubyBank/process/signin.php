<?php
	session_start();
	//print_r($_POST);
	echo "1.<br>";
	include ("../Assets/database/setup.php");
	$username = $_POST["userid"];
	$password = $_POST["userpass"];

	$sql = "select * from Tellers where tellerID = '$username' or email = '$username'";
	$result = $conn->query($sql);

	if($result->num_rows>0){
		echo "2.<br>";
		while($row = $result->fetch_assoc()){
			echo "3.<br>";
			if($row["password"] != "1stTimePassword"){
				if(password_verify($password,$row["password"])){
					echo "4.<br>";
					//check if no logged session
					$tellerId = $row["tellerID"];
					$sql2 = "select * from logsessions where tellerID = '$tellerId'";
					$result2 = $conn->query($sql2);

					if($result2->num_rows>0){
						echo "5a.<br>";
						while($row2 = $result2->fetch_assoc()){
							echo "6.<br>";
							if($row2["timestamp_logout"] == "0000-00-00 00:00:00"){
								echo "7a.<br>";
								continue;
							}
							else{
								echo "7b.<br>";
								$device = $row2["device_ip"];
								echo "<input type = 'hidden' id = 'deviceip' value = '$device'>";
								echo "<script>
										const d = document.getElementById('deviceip').value;
										alert('You are currently logged on Device: '+ d);
										window.location.replace('../index.php');
									</script>";
							}
						}
						//login
						//create a session for this login
						$logintime = date("Y-m-d h:i:s");
						$device_ip = $_SERVER["REMOTE_ADDR"];

						$sql = "insert into logsessions
									(tellerID,timestamp_login,device_ip)
									values
									('$tellerId','$logintime','$device_ip')
								";
						$result = $conn->query($sql);

						if(!$conn->error){
							echo "8a.<br>";
							$_SESSION["tellername"] = $row["firstname"]." ".substr($row["middlename"],0,1)." ".$row["lastname"];
							$_SESSION["tellerID"] = $row["tellerID"];
							$_SESSION["tellerType"] = $row["tellerType"];
							header("location:../dashboard.php");
						}
						else{
							echo "8b.<br>";
							echo "<br>".$conn->error;
						}

					}
					else{
						echo "5b.<br>";
						//create a session for this login
						$logintime = date("Y-m-d h:i:s");
						$device_ip = $_SERVER["REMOTE_ADDR"];

						$sql = "insert into logsessions
									(tellerID,timestamp_login,device_ip)
									values
									('$tellerId','$logintime','$device_ip')
								";
						$result = $conn->query($sql);

						if(!$conn->error){
							echo "9a.<br>";
							$_SESSION["tellername"] = $row["firstname"]." ".substr($row["middlename"],0,1)." ".$row["lastname"];
							$_SESSION["tellerID"] = $row["tellerID"];
							$_SESSION["tellerType"] = $row["tellerType"];
							header("location:../dashboard.php");
						}
						else{
							echo "9b.<br>";
							echo "<br>".$conn->error;
						}
					}
				}
				else{
					echo "<script>
							alert('Wrong Password');
							window.location.replace('../index.php');
						</script>";
				}
			}
			else{
				header("Location:resetPassword.php?email=".$row["email"]."&fname=".$row["firstname"]);
			}
		}
	}
	else{
		echo "<script>
				alert('Wrong Teller ID or Email');
				window.location.replace('../index.php');
			</script>";
	}


?>