<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Site Info</title>
<?php

	if (!empty($_POST)) {
		$query = "UPDATE ClubInfo SET Intro = '".$_POST["info"]."', Activities = '".$_POST["activities"]."'";
		mysqli_query($mysqli, $query);
	}
	
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
	<span class="orangeTitle">Introduction Settings</span>
	<h2 class="memPageDesc">Edit introduction on the about page</h2>
</div>

<?php
  $query = "SELECT * FROM ClubInfo";
  $result = mysqli_query($mysqli, $query); 
  $num_rows = mysqli_affected_rows($mysqli); 

  $intro = "";
  $activities = "";

  if ($result && $num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    	$intro = $row["Intro"]; 
    	$activities = $row["Activities"];
    }

  }

?>



<form class="infoForm" method="post">
<h1 class="infoHeading">Club Intro:</h1>
	<textarea name="info" class="infoTextBox"><?= $intro ?></textarea>
<h1 class="infoHeading">What We Do:</h1>
	<textarea name="activities" class="infoTextBox"><?= $activities ?></textarea></br>
	<input type="submit" value="Save" class="infoSubmit"/>
</form>



</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>