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
  		// echo "Hello ".$_SESSION["userfirstname"]."! Everything is good.";
	}

?>

<div class="membersPageTitle"> 
	<span class="orangeTitle">Profiles</span>
	<h2 class="memPageDesc">Welcome back <?=$_SESSION["userfirstname"]?>!</h2>
</div>

<div id="editPopup">
	<h1 id="editTitle">Edit Profile</h1>
	<form method="post" style="text-align: center;"> 
	 	<p class="forgot">Edit your information and click "update."</p>

	 	<div id="editHeader">
	 		<p class="editFieldTitle">Email</p>
	 		<p class="editFieldTitle">Coaster Count</p>
	 	</div>

		<input name="email" class="editField" value="<?= $_SESSION["useremail"]?>"/>
		<input name="coasters" class="editField" value="<?= $_SESSION["coastercount"]?>"/><br/>

		<input name="pass" type="password" class="editField" placeholder="Enter new password..."/>
		<input name="passconf" type="password" class="editField" placeholder="Confirm new password..."/><br/>

		<input type="submit" value="Update" class="editSubmitButton"/>
		<button class="editSubmitButton" onclick="showEdit()" />Cancel</button>

	</form>


</div>


<div class="infoPanels"> 
	<div class="namePanel">
		<img class="proPic" src="media/icons/profileOrange.svg" alt="Profile Picture">

		<div class="memName">
			<h1 class="memberName"><?=$_SESSION['userfirstname'].' '.$_SESSION['userlastname']?></h1>

			<?php
				$memberStatus = $_SESSION['memberstatus'];
				if ($memberStatus == "inactivemember") {
					$memberStatus = "Inactive Member";
				}
				else if ($memberStatus == "activemember") {
					$memberStatus = "Active Member";
				}

			?>

			<h2 class="memberStatus"><?=$memberStatus?></h2>
		</div>

		<?php
			if ($_SESSION["userpermission"] != "guest") {
				echo "
					<button type=\"button\" class=\"editButton\" onclick=\"showEdit()\">Edit Profile</button>
				";
			}
		?>

	</div>
	<div class="stdInfoPanel"> 
		<div class="panelTitleSec">
			<p class="panelTitle">Personal Info</p>
		</div>
		<p class="panelInfo"><strong>Name:</strong> <?=$_SESSION['userfirstname'].' '.$_SESSION['userlastname']?></p>
		<p class="panelInfo"><strong>Username:</strong> <?=$_SESSION['username']?></p>
		<p class="panelInfo"><strong>Email:</strong> <?=$_SESSION['useremail']?></p>
	</div>
	<div class="stdInfoPanel"> 
		<div class="panelTitleSec">
			<p class="panelTitle">Membership Info</p>
		</div>
		<p class="panelInfo"><strong>Status:</strong> <?=$memberStatus?></p>
		<p class="panelInfo"><strong>Account Created:</strong> <?=$_SESSION['creationdate']?></p>

	</div>
	<div class="stdInfoPanel"> 
		<div class="panelTitleSec">
			<p class="panelTitle">Other Info</p>
		</div>
		<p class="panelInfo"><strong>Coaster Count:</strong> <?=$_SESSION['coastercount']?></p>
		<p class="panelInfo"><strong>Site Permissions:</strong> <?=$_SESSION['userpermission']?></p>
	</div>
</div>

<hr>


<?php
	$query = "SELECT firstname, lastname, status, username, email, coastercount, propic FROM Profiles";
	$result = mysqli_query($mysqli, $query); 
  	$num_rows = mysqli_affected_rows($mysqli);

  	if ($result && $num_rows > 0) {

  		$memberNum = $num_rows-1;

  		echo "<h2 style=\"margin-left: 25px;\">All members:</h2>";
  		echo "<div class=\"allMemPanels\">";

    while ($row = mysqli_fetch_assoc($result)) {
    	if ($row['username'] != $_SESSION['username'] && $row['username'] != "admin" && $row['username'] != "guest") {

    		$fullname = $row['firstname']." ".$row['lastname'];
    		echo "
				
					<div class=\"memberPanels\"> 
						<div class=\"panelTitleSec\">
							<img class=\"miniProPic\" src=\"media/icons/profileOrange.svg\" alt=\"profile\">
							<p class=\"panelTitle\">".$fullname."</p>
						</div>
						<p class=\"panelInfo\"><strong> ".$row['status']."</strong></p>
						<p class=\"panelInfo\"><strong>Username: </strong>".$row['username']."</p>
						<p class=\"panelInfo\"><strong>Email: </strong>".$row['email']."</p>
						<p class=\"panelInfo\"><strong>Coastercount: </strong>".$row['coastercount']."</p>
					</div>
    		";

    	}
    }

    echo"</div>";

   }

?>



</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>