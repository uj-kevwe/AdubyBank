<?php
	include("../Assets/database/setup.php");
	$accountnumber = $_GET["acctnum"];

	$sql = "select accountnumbers.AccountNumber, accountnumbers.AccountType, concat(customer.FirstName,' ',customer.MiddleName,' ',customer.LastName) as AccountName, customer.AccountStatus, accountshistory.PostTrxnBalance from accountnumbers inner join customer on accountnumbers.AccountNumberID = customer.AccountNumberID inner join accountshistory on customer.AccountNumberID = accountshistory.AccountNumberID where accountnumbers.AccountNumber = '$accountnumber'";
	$result = $conn->query($sql);

	if($result->num_rows>0){
		while($rows = $result->fetch_assoc()){
			$accountStatus = $rows["AccountStatus"];
			$accountname = $rows["AccountName"];
			$accountbalance = $rows["PostTrxnBalance"];
			switch($rows["AccountType"]){
				case 1:
					$type = "Current Account";
					break;
				case 2:
					$type = "Savings Account";
					break;
				case 3:
					$type = "Corporate Account";
					break;
				case 4:
					$type = "Fixed Deposit Account";
					break;
			}
		}
	}
	else{
		$accountname = $conn->error;
		$accountbalance = 0.0;
		$type = $conn->error;
	}
?>

<table class="table">
	<tr>
		<th>Account Name</th>
		<td><?php echo $accountname." <span style = 'font-style:italic'>(".$type.")</span>"?></td>
	</tr>
	<tr>
		<?php
			if($accountStatus == 4){
				echo "<td colspan = '2'>Account Closed</td>";
			}
			else{
		?>
			<th>Account Balance</th>
			<td><?php echo $accountbalance ?></td>
		<?php
			}
		?>
	</tr>
</table>