<div class="acct_details">
	<h3>Cash Deposit Module</h3>
	<div class="formgroup">
		<label>Account Number</label>
		<input type="text" name="acctnum" id="acctnum" oninput = "activateBtn(id,'getdepositor')">
		<button type="button" class="btn  btn-primary" id="getdepositor" onclick="getTrxnDetails(id)"disabled>
			Continue
		</button>
	</div>
	<div class="formgroup">
		<div id="cusdetails"></div>	
	</div>
	
</div>