<?php
	include("../Assets/database/setup.php");

	$accountnum = $_GET["acct"];
	$sql = "select concat(customer.FirstName,' ',customer.MiddleName,' ',customer.LastName) as AccountName, customer.AccountStatus, accountnumbers.AccountNumber from customer inner join accountNumbers on customer.AccountNumberID = accountnumbers.AccountNumberID where accountnumbers.AccountNumber = '$accountnum'";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($rows = $result->fetch_assoc()){
			$accountStatus = $rows["AccountStatus"];
			$accountname = $rows["AccountName"];
		}
	}
	else{
		$accountname = "error fetching accountname";
	}
	if(!$accountStatus == 4){
		echo $accountname;
	}
	else{
		echo "Account Closed";
	}

?>