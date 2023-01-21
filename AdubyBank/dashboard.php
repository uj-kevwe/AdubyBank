<?php
	session_start();
	if(!isset($_SESSION["tellername"])){
		echo "<script>
				alert('No Teller Logged on');
				window.location.replace('index.php');
			  </script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Assets/CSS/style.css">

	<!-- Add Bootstraps and Font Awesome -->
	<link rel="stylesheet"  href="Assets/Bootstrap/CSS/bootstrap.min.css">
	<link rel="stylesheet" href="Assets/fontawesome/fontawesome.css">
	<script src="Assets/Bootstrap/JS/bootstrap.min.js"></script>
	<script src="Assets/JS/script.js"></script>
	<title>ADUBYBANK PLC</title>
</head>
<body id="body">
	<?php
		include("include_files/header.php");
	?>
	<div id="dashboard">
		<div id="mobile_menu" onclick="toggleMenu()">
			<i class="fa fa-bars"></i>
		</div>
		<section class="desktop_modules">
			<ul id="desktop_view"> 
				<li>
					<span id="1" onclick = "dropMenu(id)">Account</span>
					<ul id="acct_module">
						<?php
							if($_SESSION["tellerType"] == 1 || $_SESSION["tellerType"] == 3){ // Admin and Customer care
								echo "<li id='acctopen' onclick = 'openPage(id)'>Account Onboarding</li>";
								echo "<li id='acctdet' onclick = 'openPage(id)'>Check Balance</li>";
								echo "<li id='acctstat' onclick = 'openPage(id)'>Account Statement</li>";
								echo "<li id='acctclose' onclick = 'openPage(id)'>Close Account</li>";
							}
							else { // Admin and Cash Teller
								echo "<li id='acctdet' onclick = 'openPage(id)'>Check Balance</li>";
								echo "<li id='acctstat' onclick = 'openPage(id)'>Account Statement</li>";
							}
						?>
					</ul>
				</li>
				<?php
			/*		if($_SESSION["tellerType"] == 1 || $_SESSION["tellerType"] == 2){ */
				?>
					<li>
						<span id="2" onclick = "dropMenu(id)">Transactions</span>
						<ul id="trxns">
							<li id="acctdep" onclick = "openPage(id)">Cash Deposit</li>
							<li id="acctwith" onclick = "openPage(id)">Cash Withdrawal</li>
							<li id="accttrsf" onclick = "openPage(id)">Internal Transfer</li>
						</ul>
					</li>
				<?php
/*					}
					if($_SESSION["tellerType"] == 1){ */
				?>
					<li>
						<span id="3" onclick = "dropMenu(id)">Administrative</span>
						<ul id="admin">
							<li id="acctcreate" onclick = "openPage(id)">Create Staff/Teller</li>
							<li id="acctman" onclick = "openPage(id)">Manage Teller Access</li>
							<li id="acctdel" onclick = "openPage(id)">Delete Staff/Teller</li>
						</ul>
					</li>
				<?php
			//		}
				?>
				<li onclick = "logout();">Logout</li>
			</ul>
		</section>
		<section class="contents">
			<div id="dashboard_content">
				
			</div>
		</section>
	</div>
</body>
</html>