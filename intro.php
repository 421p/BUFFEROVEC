<?php
	session_start();
	if(!isset($_SESSION["user_going_crazy"])) {
   header("location:login.php");
	} else {
	?>
	
	<div id="welcome">
	<h2>Nu zdarova, <span><?php echo $_SESSION['user_going_crazy'];?>! </span></h2>
   <p><a href="logout.php">vidoh</a> iz sistemi</p>
	</div>

	<?php
	}
	?>