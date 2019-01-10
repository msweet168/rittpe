<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Accounts</title>
<?php
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "accountset"; 
  		header('Location: login');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "accountset"; 
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
	<span class="orangeTitle">Account Settings</span>
	<h2 class="memPageDesc">Edit TPE Profiles</h2>
</div>

<!-- 	<div class="fullAccountDiv">
		<h3 class="allAccountInfo">Mitchell Sweet (msweet168)</h3>
		<p class="allAccountInfo">mas6700@rit.edu</p>
		<p class="allAccountInfo">Status: activemember, Permissions: admin</p>
		<p class="allAccountInfo">Last Login: 000000000</p>
		<p class="allAccountInfo">Created: 00000000 by msweet168</p>
		<button name="edit" value="1000" class="accountInfoButton"/>Edit Account</button>
	</div> -->




<?php

  $query = "SELECT * FROM Profiles ORDER BY firstname ASC";
  $result = mysqli_query($mysqli, $query); 
  $num_rows = mysqli_affected_rows($mysqli); 

  echo "<h3 class=\"accountTotal\">".$num_rows." accounts</h3>"

 ?>

 <button class="editSubmitButton" style="margin-left: 25px; ">New Account</button>

 <?php

  if ($result && $num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
		
		echo "

			<div class=\"fullAccountDiv\">
				<h3 class=\"allAccountInfo\">".$row['firstname']." ".$row['lastname']."</h3>
				<p class=\"allAccountInfo\">".$row['email']."</p>
				<p class=\"allAccountInfo\">Status: ".$row['status'].", Permission: ".$row['permission']."</p>
				<p class=\"allAccountInfo\">Last Login: ".$row['lastlogin']."</p>
				<p class=\"allAccountInfo\">Created: ".$row['creationdate']." by ".$row['creator']."</p>
				<button name=\"edit\" value=\"".$row['id']."\" class=\"accountInfoButton\"/>Edit Account</button>
			</div>

		";

    }

  }

?>




</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>
