<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Newsfeed</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "newsfeed"; 
  		header('Location: login');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "newsfeed"; 
		header('Location: login');
	}
	else {
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
	}

?>

<div class="membersPageTitle"> 
	<span class="orangeTitle">Newsfeed</span>
	<h2 class="memPageDesc">Today is <?=date("F d, Y")?></h2>
</div>

</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>