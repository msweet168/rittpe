<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Members</title>
<?php
	require_once("sitewide/header.php"); 
	require_once("sitewide/membersnav.php");

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
  		echo "Hello ".$_SESSION["userfirstname"]."! Everything is good.";
	}

?>




<?php 
    // require_once("sitewide/footer.php");
?>