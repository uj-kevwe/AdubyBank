<div>
	<form action="process/createAccount.php" method="post">
		<div class="formgroup">
			<label>KYC Status</label>
			<select id="kyc" name="kyc" onchange="confirmKYC()">
				<option>Select KYC Status</option>
				<option>KYC Okay</option>
				<option>KYC Not Okay</option>
			</select>
		</div>
		<div id="fgroup">
			<div class="formgroup">
				<label>KYC Conducted By:</label>
				<select name="kycStaffID">
					<option>Select a Teller ID</option>
					<?php
						include("../Assets/database/setup.php");
						$sql = "select * from tellers";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							while($rows = $result->fetch_assoc()){
								echo "<option>".$rows["tellerID"]."</option>";
							}
						}
						else{
							echo "<option>No Teller ID</option>";
						}
					?>
				</select>
			</div>
			<div class="formgroup">
				<label>Account Type</label>
				<select name="acctType">
					<option>Select An Account Type</option>
					<option>Current Account</option>
					<option>Savings Account</option>
					<option>Corporate Account</option>
					<option>Fixed Deposit Account</option>
				</select>
			</div>
			<div style="text-align: center; font-style: italic; margin: 1px 50px;">
				<hr>
				<span>Customer Details</span>

			</div>
			<div class="formgroup">
				<label>Salutation</label>
				<select name="salute">
					<option>Select Salutation</option>
					<option>Not Applicable</option>
					<option>Mr.</option>
					<option>Mrs.</option>
					<option>Miss.</option>
					<option>Chief</option>
					<option>Engr.</option>
					<option>Dr.</option>
					<option>Prof.</option>
					<option>Barr.</option>
					<option>Alhaji</option>
					<option>Alhaja</option>
					<option>Sir</option>
				</select>
			</div>
			<div class="formgroup">
				<label>Customer First Name</label>
				<input type="text" name="firstname" required>
			</div>
			<div class="formgroup">
				<label>Customer Middle Name</label>
				<input type="text" name="midname" required>
			</div>
			<div class="formgroup">
				<label>Customer Last Name</label>
				<input type="text" name="lastname" required>
			</div>
			<div class="formgroup">
				<label>Gender</label>
				<select name="gender">
					<option>Select Gender</option>
					<option>Not Applicable</option>
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>
			<div class="formgroup">
				<label>Date of Birth</label>
				<input type="date" name="dob" required>
			</div>
			<div class="formgroup">
				<label>Email</label>
				<input type="email" name="email" required>
			</div>
			<div class="formgroup">
				<label>Phone</label>
				<input type="tel" name="phone" required>
			</div>
			<div class="formgroup">
				<button id="genacct" type="button" onclick="getAccountNumber()">
					Generate Account Number
				</button>
				<input type="text" name="acct_number" id="acct_number" readonly required>
			</div>
			<div class="formgroup" style="margin-bottom:20px">
				<input type="submit" name="submit" value="Create Account">
			</div>
			<hr>
			<hr>
		</div>

	</form>
</div>