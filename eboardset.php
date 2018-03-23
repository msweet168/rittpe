<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Eboard</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "accountset.php"; 
  		header('Location: login.php');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "accountset.php"; 
		header('Location: login.php');
	}
	else {
		if ($_SESSION['userpermission'] != "admin") {
			header('Location: members.php');
		}
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
	}

?>

<div class="membersPageTitle"> 
	<span class="orangeTitle">Eboard Settings</span>
	<h2 class="memPageDesc">Edit the current TPE eboard</h2>
</div>

</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>