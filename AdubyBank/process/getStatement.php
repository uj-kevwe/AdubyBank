<?php
	include("../Assets/database/setup.php");
	$acctnum = $_GET["acctnum"];
	$from = $_GET["from"];
	$to = $_GET["to"];

	$sql = "select concat(customer.FirstName,' ',customer.MiddleName,' ',customer.LastName) as AccountName, accountnumbers.AccountNumber, accountnumbers.AccountNumberID, accountshistory.TrxnDate,accountshistory.Amount,accountshistory.PostTrxnBalance,accountshistory.TransactionType,accountshistory.Narration from accountnumbers inner join customer on accountnumbers.AccountNumberID = customer.AccountNumberID inner join accountshistory on customer.AccountNumberID = accountshistory.AccountNumberID where accountnumbers.AccountNumber = '$acctnum' and accountshistory.TrxnDate between '$from' and '$to'";
	$result = $conn->query($sql);
	echo "<table id = 'statementtable' style = 'border-style:solid;border-width:1px;'>";
	if($result->num_rows > 0){
		while($rows = $result->fetch_assoc()){
			$accountname = $rows["AccountName"];
		}
	}
	echo "<tr>";
	echo "<th colspan = '5' style = 'text-align:center'>Account Name: ".$accountname."</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th style = 'width:15%'>Transaction Date</th>";
	echo "<th style = 'width:45%'>Narration</th>";
	echo "<th style = 'width:12.5%'>Deposit</th>";
	echo "<th style = 'width:12.5%'>Withdrawal</th>";
	echo "<th style = 'width:15%'>Balance</th>";
	echo "</tr>";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($rows = $result->fetch_assoc()){
			$accountname = $rows["AccountName"];
			$trxntype = $rows["TransactionType"];
			echo "<tr>";
			echo "<td>".$rows["TrxnDate"]."</td>";
			echo "<td>".$rows["Narration"]."</td>";
			if($trxntype == 0 || $trxntype == 1){
				echo "<td>".$rows["Amount"]."</td>";
				echo "<td> - </td>";
			}
			else{
				echo "<td> - </td>";
				echo "<td>".$rows["Amount"]."</td>";
			}
			echo "<td>".$rows["PostTrxnBalance"]."</td>";
			echo "</tr>";
		}
	}
	else{
		echo "<tr>
				<td colspan = '5'>
					No transaction for this customer with account number '$acctnum' for the selected date range '$from' to '$to'
				</td>
			</tr>";
	}
	echo "</table>";
	echo "<hr>";
?>
<div style='margin-left:25%; margin-bottom:50px;width:50%'>
	<input type = 'button' id='downloadpdf' value = 'Download Pdf Statement' style = 'margin:5px'>
	<input type = 'button' id='downloadxls' value = 'Download Excel Statement' style = 'margin:5px' onclick = 'convertToExcel("xlsx")'>
</div>
<script  type = "text/javascript" src = "Assets/JS/table2xls.js"></script>
