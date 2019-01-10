<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Event Settings</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "eventset"; 
  		header('Location: login');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "eventset"; 
		header('Location: login');
	}
	else {
		if ($_SESSION['userpermission'] != "admin") {
			header('Location: members');
		}
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
	}

?>

<div class="membersPageTitle"> 
	<span class="orangeTitle">Events</span>
	<h2 class="memPageDesc">Edit events on the TPE info site</h2>
</div>



</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>
