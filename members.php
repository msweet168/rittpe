<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Members</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "members.php"; 
  		header('Location: login.php');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "members.php"; 
		header('Location: login.php');
	}
	else {
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
  		echo "Hello ".$_SESSION["userfirstname"]."! Everything is good.";
	}

?>

<h1>Stuff here</h1>

</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>