<div class="acct_details">
	<h3>Cash Withdrawal Module</h3>
	<div class="formgroup">
		<label>Account Number</label>
		<input type="text" name="acctnum" id="acctnum" oninput = "activateBtn(id,'getwithdrawer')">
		<button type="button" class="btn  btn-primary" id="getwithdrawer" onclick="getTrxnDetails(id)" disabled>
			Continue
		</button>
	</div>
	<div class="formgroup">
		<div id="cusdetails"></div>	
	</div>
	
</div>