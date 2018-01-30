<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Quotevault</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "quotes.php"; 
  		header('Location: login.php');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "quotes.php"; 
		header('Location: login.php');
	}
	else {
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
  		echo "Hello ".$_SESSION["userfirstname"]."! Everything is good, let's read some quotes!<br>";.
	}

?>

<?php

  $query = "SELECT * FROM Quotes";
  $result = mysqli_query($mysqli, $query); 
  $num_rows = mysqli_affected_rows($mysqli); 

  if ($result && $num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
       echo"There are ".$num_rows." quotes in the vault.";


    }

  }


?>

<div class="quoteDiv">


</div>



</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>