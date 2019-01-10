<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Chat</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "chat.php"; 
  		header('Location: login.php');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "chat.php"; 
		header('Location: login.php');
	}
	else {
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
	}

?>

<div class="membersPageTitle"> 
	<span class="orangeTitle">TPE Chat</span>
	<h2 class="memPageDesc">Pardon our dust as we are in development...</h2>
</div>

</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>