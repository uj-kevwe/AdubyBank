<header>
	<div id="logo"><img src="Assets/images/banking.jpg" alt="Banking Hall"></div>
	<div id="welcome">
		<h1>Welcome to Aduby<span style="color:blue">Bank</span></h1>
		<h3>
			<?php 
				if(isset($_SESSION["tellername"])){
					echo $_SESSION["tellername"];
				}
			?>
		</h3>
	</div>
</header>