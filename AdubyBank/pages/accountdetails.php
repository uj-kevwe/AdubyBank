<div class="acct_details">
	<h3>Account Details</h3>
	<div class="formgroup">
		<label>Account Number</label>
		<input type="text" name="acct_num" id="acct_num" onkeyup = "activateBtn(id,'getbal')" onmouseup = "activateBtn()" oninput = "activateBtn()">
	</div>
	<div class="formgroup">
		<button type="button" class="btn btn-primary" name="getbal" id = "getbal" onclick="getAcctDet()" disabled>
			Retrieve Account Balance
		</button>
	</div>
	<div id="details"></div>
</div>