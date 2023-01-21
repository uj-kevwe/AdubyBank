<?php
	session_start();
	include("../Assets/database/setup.php");
	$teller = $_SESSION["tellerID"];
	//update logout time on logsessions table
	$logouttime = date("Y-m-d h:i:s");
	$sql = "update logsessions set timestamp_logout = '$logouttime' 
			where tellerID = '$teller' 
			and timestamp_logout is null";
	$result = $conn->query($sql);
	if(!$conn->error){
		unset($_SESSION["tellername"]);
		unset($_SESSION["tellerType"]);
		unset($_SESSION["tellerID"]);
		header("location:../index.php");
	}
	else{
		echo "<br>".$conn->error;
	}
?>