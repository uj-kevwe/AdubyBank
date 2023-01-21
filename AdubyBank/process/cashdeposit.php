<?php
	include("../Assets/database/setup.php");
	$accountnumber = $_GET["acctnum"];
	$amount = floatval($_GET["amount"]);
	$narration = $_GET["narration"];
	$trxndate = date("Y-m-d");

	$sql = "select accountnumbers.AccountNumber, accountshistory.AccountNumberID, accountshistory.PostTrxnBalance,accountshistory.CustomerID 
			from accountnumbers inner join accountshistory 
			on accountnumbers.AccountNumberID = accountshistory.AccountNumberID
			where AccountNumber = '$accountnumber'";

	$result = $conn->query($sql);

	if($result->num_rows>0){
		while($rows = $result->fetch_assoc()){
			$lastaccountbalance = $rows["PostTrxnBalance"];
			$accountid = $rows["AccountNumberID"];
			$custid = $rows["CustomerID"];
		}
	}
	$newaccountbalance = $lastaccountbalance + $amount;

	$sql = "insert into accountshistory
			  (AccountNumberID,CustomerID,TrxnDate,Amount,PreTrxnBalance,TransactionType,PostTrxnBalance,Narration)
			  values
			  ('$accountid','$custid','$trxndate',$amount,$lastaccountbalance,1,$newaccountbalance,'$narration')
		   ";

	$result = $conn->query($sql);

	if(!$conn->error){
		$sql2 = "update customer 
				set AccountStatus = 1 
				where AccountNumberID = '$accountid'";

		$result2 = $conn->query($sql2);

		if(!$conn->error){
			echo $newaccountbalance;
		}
		else{
			echo $conn->error;
		}
	}
	else{
		echo $conn->error;
	}
?>