<?php
	include("../Assets/database/setup.php");
	$accountnumber = $_GET["acctnum"];

	$sql = "select accountnumbers.AccountNumber, accountnumbers.AccountType, concat(customer.FirstName,' ',customer.MiddleName,' ',customer.LastName) as AccountName, accountshistory.PostTrxnBalance from accountnumbers inner join customer on accountnumbers.AccountNumberID = customer.AccountNumberID inner join accountshistory on customer.AccountNumberID = accountshistory.AccountNumberID where accountnumbers.AccountNumber = '$accountnumber'";
	$result = $conn->query($sql);

	if($result->num_rows>0){
		while($rows = $result->fetch_assoc()){
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
		<td><?php echo $accountname. " <span style = 'font-style:italic'>(".$type.")</span>"; ?></td>
	</tr>
	<tr>
		<th>Account Balance Before Deposit</th>
		<td><?php echo $accountbalance ?></td>
	</tr>
	<tr>
		<th>Account Balance After Deposit</th>
		<td id="balafterdep"></td>
	</tr>
</table>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<p>Amount To Deposit</p>
		</div>
		<div class="col-md-6 col-sm-12">
			<input type="text" name="amount" id="amount">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<p>Name of Depositor</p>
		</div>
		<div class="col-md-6 col-sm-12">
			<input type="text" name="depositor" id="depositor">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<p>Narration</p>
		</div>
		<div class="col-md-6 col-sm-12">
			<textarea name="narration" id="narration" rows="5" cols="50"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<button id="depositcash" class="btn btn-primary" onclick="processTrxn(id)">
				Deposit
			</button>
		</div>
	</div>
</div>
