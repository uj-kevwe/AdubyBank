<?php
	include("../Assets/database/setup.php");
	$trxndate = date("Y-m-d h:m:s");
	$acctnum = $_GET["acctnum"];
	$sql = "create table if not exists suspense(
				sno int not null primary key auto_increment,
				AccountNumber varchar(10) not  null,
				AccountName varchar(150) not null,
				Amount decimal(19,2) not null,
				Narration text not null,
				Date date not null
			)";

	$result = $conn->query($sql);

	if(!$conn->error){
		$sql2 = "select accountnumbers.AccountNumberID, accountnumbers.AccountNumber, concat(customer.FirstName,' ',customer.MiddleName,' ',customer.LastName) as AccountName, accountshistory.PostTrxnBalance, accountshistory.CustomerID 
		    from accountnumbers inner join customer on accountnumbers.AccountNumberID = customer.AccountNumberID inner join accountshistory on customer.AccountNumberID = accountshistory.AccountNumberID 
				where AccountNumber = '$acctnum'";

		$result2 = $conn->query($sql2);

		if($result2->num_rows > 0){
			while($rows2 = $result2->fetch_assoc()){
				$acctid = $rows2["AccountNumberID"];
				$acct = $rows2["AccountNumber"];
				$acctName = $rows2["AccountName"];
				$closeAmt = $rows2["PostTrxnBalance"];
				$cusId = $rows2["CustomerID"];
			}
			$prebal = $closeAmt;
			$postbal = 0.00;
			$sql3 = "insert into accountshistory
						(AccountNumberID,CustomerID,TrxnDate,Amount,PreTrxnBalance,TransactionType,PostTrxnBalance,Narration)
						values
						('$acctid','$cusId','$trxndate','$closeAmt',$prebal,2,$postbal,'Account Closed')
					";

			$result3 = $conn->query($sql3);

			if(!$conn->error){
				$sql4 = "insert into suspense
							(AccountNumber,AccountName,Amount,Narration,Date)
							values
							('$acct','$acctName',$closeAmt,'Account Closed','$trxndate')
						";

				$result4 = $conn->query($sql4);

				if(!$conn->error){
					$sql5 = "update customer set AccountStatus = 4 where AccountNumberID = '$acctid'";

					$result5 = $conn->query($sql5);

					if(!$conn->error){
						echo "<div class = 'formgroup'>";
							echo "<label>Final Output</label>";
							echo "<table class = 'table' id = 'tableoutput'>";
							echo "<tr>
									<th>Account Name</th>
									<th>Account Balance</th>
									<th>Date of Closure</th>
									<th>Status</th>
								  </tr>
								 ";
							echo "<tr>
									<td>$acctName</td>
									<td>$closeAmt</td>
									<td>$trxndate</td>
									<td>Account Closed</td>
								  </tr>
								 ";
							echo "</table>";
						echo "</div>";
					}
				}
				else{
					echo $conn->error;
				}
			}
			else{
				echo $conn->error;
			}
		}
		else{
			echo $conn->error;
		}
	}
	else{
		echo $conn->error;
	}
?>