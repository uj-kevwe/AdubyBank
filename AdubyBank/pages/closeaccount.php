<style type="text/css">
	#closethisaccount{
		display: none;
	}
</style>
<div id="accountclosure" style="padding-left:20px">
	<h3>Close Account Module</h3>
	<div class="formgroup">
		<label>Account Number</label>
		<input type="text" name="accountnumber" id="accountnumber" oninput="activateRetrieve()">
	</div>
	<div class="formgroup">
		<input type="button" name="retrievebtn" id="retrievebtn" value="Retrive Account" disabled onclick = "getAccountDetails()">
	</div>
	<div>
		<div id="accountdetails"></div>
	</div>
	<div class="formgroup"  id="closethisaccount">
		<input type="button" name="close" value="Close Account" onclick="closeAccount()">
	</div>
	<div id="closureoutput"></div>
</div>