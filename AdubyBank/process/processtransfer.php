<?php
	include ("../Assets/database/setup.php");
	$acctnum = $_GET["acctnum"];
	$benacctnum = $_GET["benacctnum"];
	$amount = $_GET["amount"];
	$narration1 = $_GET["narration1"]; 
	$trxnType = 2;
	$trxnDate = date("Y-m-d");
	$sql = "select accountnumbers.AccountNumber, accountNumbers.AccountNumberID, accountshistory.PostTrxnBalance,accountshistory.CustomerID from accountnumbers inner join accountshistory on accountnumbers.AccountNumberID = accountshistory.AccountNumberID where accountnumbers.AccountNumber = '$acctnum'";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($rows = $result->fetch_assoc()){
			$acctId = $rows["AccountNumberID"];
			$custId = $rows["CustomerID"];
			$preBal = $rows["PostTrxnBalance"];
		}

		$postBal = $preBal - $amount;

		$sql2 = "insert into accountshistory
				    (AccountNumberID,CustomerID,TrxnDate,Amount,PreTrxnBalance,TransactionType,PostTrxnBalance,Narration)
				    values
				    ('$acctId','$custId','$trxnDate',$amount,$preBal,2,$postBal,'$narration1')
				";
		$result2 = $conn->query($sql2);
		if(!$conn->error){
			//beneficiary
			$sql3 = "select accountnumbers.AccountNumber, accountnumbers.AccountNumberID, accountshistory.PostTrxnBalance,accountshistory.CustomerID from accountnumbers inner join accountshistory on accountnumbers.AccountNumberID = accountshistory.AccountNumberID where accountnumbers.AccountNumber = '$benacctnum'";
			$result3 = $conn->query($sql3);

			if($result3->num_rows > 0){
				while($rows3 = $result3->fetch_assoc()){
					$benacctId = $rows3["AccountNumberID"];
					$bencustId = $rows3["CustomerID"];
					$benpreBal = $rows3["PostTrxnBalance"];
				}

				$benpostBal = $benpreBal + $amount;

				$narration2 = $_GET["narration2"];
				$sql4 = "insert into accountshistory
				    (AccountNumberID,CustomerID,TrxnDate,Amount,PreTrxnBalance,TransactionType,PostTrxnBalance,Narration)
				    values
				    ('$benacctId','$bencustId','$trxnDate',$amount,$benpreBal,1,$benpostBal,'$narration2')
				";
				$result4 = $conn->query($sql4);

				if(!$conn->error){
					$sql5 = "update customer
							    set AccountStatus = 1
							    where AccountNumberID = '$benacctId'
							";

					$result5 = $conn->query($sql5);

					if(!$conn->error){
						echo $postBal;
					}
					else{
						echo $conn->error;
					}
				}
				else{
					echo $conn->error;
				}

			}

		}
		else{
			echo "Error Selecting Beneficiary Account";
		}
	}
	else{
		echo "Error Selecting Payee Account";
	} 
?>

