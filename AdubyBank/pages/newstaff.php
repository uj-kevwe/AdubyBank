<div class="acct_details"  style="overflow: auto;">
	<form action="process/createTellerModule.php" method="post">
		<h3>Create New Teller/Staff Module</h3>
		<div class="formgroup">
			<label>Teller Type</label>
			<select name="tellertype" id="tellertype" onchange = "activateButton(id)">
				<option>Select Teller Type</option>
				<option>Admin</option>
				<option>Cash Processing Teller</option>
				<option>Customer Care</option>
			</select>
		</div>
		<hr>
		<div class="formgroup">
			<label>Salutation</label>
			<select name="salute" id="salute" onchange = "activateButton(id)">
				<option>Select Title</option>
				<option>0. - NA.</option>
				<option>1. - Mr.</option>
				<option>2. - Mrs.</option>
				<option>3. - Miss.</option>
				<option>4. - Chief.</option>
				<option>5. - Engineer</option>
				<option>6. - Doctor.</option>
				<option>7. - Professor.</option>
				<option>8. - Barrister.</option>
			</select>
		</div>
		<div class="formgroup">
			<label>First Name</label>
			<input type="text" name="firstname" id="tfname" required>
		</div>
		<div class="formgroup">
			<label>Middle Name</label>
			<input type="text" name="middlename" id="tmname" required>
		</div>
		<div class="formgroup">
			<label>Last Name</label>
			<input type="text" name="lastname" id="tlname" required>
		</div>
		<div class="formgroup">
			<label>Gender</label>
			<select name="gender" id="tgender" onchange = "activateButton(id)">
				<option>Select a Gender</option>
				<option>0. - NA</option>
				<option>1. - Male</option>
				<option>2. - Female</option>
			</select>
		</div>
		<div class="formgroup">
			<label>Email</label>
			<input type="email" name="email" id="temail" required>
		</div>
		<div class="formgroup">
			<label>Phone Number</label>
			<input type="tel" name="phone" id="tphone" required>
		</div>
		<div class="formgroup">
			<label style="margin-top: 0;">Address</label>
			<textarea name="address" id="taddress" rows="3" cols="100" required></textarea>
		</div>
		<div class="formgroup">
			<input type="submit" name="submit" id = "submitbtn" value="Create Teller" disabled>
		</div>
	</form>	
	<script type="text/javascript">

	</script>
</div>