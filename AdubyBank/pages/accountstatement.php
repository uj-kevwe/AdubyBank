<div class="acct_details">
	<h3>Statement of Account</h3>
	<div class="formgroup">
		<label>Account Number</label>
		<input type="text" name="acct_num" id="acct_num" onkeyup = "activateBtn(id,'getstatement')" onmouseup = "activateBtn()" oninput = "activateBtn()">
	</div>
	<div class="formgroup">
		<div>
			<label>From:
				<input type="date" name="from" id="from">
			</label>
		</div>
		<div style="margin-top: 20px;">
			<label>To:
				<input type="date" name="to" id="to">
			</label>
		</div>
	</div>
	<div class="formgroup">
		<button type="button" class="btn btn-primary" name="getstatement" id = "getstatement" onclick="getStatement()" disabled>
			Retrieve Statement of Account
		</button>
	</div>
	<div id="statement"></div>
</div>