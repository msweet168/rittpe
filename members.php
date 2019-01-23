<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Members</title>
<?php

	if (!empty($_POST)) {

		if ($_SESSION["userpermission"] == "guest") {
			header('Location: ./');
			exit();
		}

		if ($_POST["email"] != $_SESSION['useremail'] && $_POST["email"] != "") {
			if (strpos($_POST["email"], '@') && strpos($_POST["email"], '.')) {
				$newEmail = htmlentities(strip_tags(trim($_POST["email"])));
				$newEmail = mysqli_real_escape_string($mysqli, $newEmail);
				$query = "UPDATE Profiles SET email = '".$newEmail."' WHERE id = '".$_SESSION['userid']."'";
				$result = mysqli_query($mysqli, $query); 
				if ($result > 0) {
					$_SESSION['useremail'] = $newEmail;
				}
			}
			else {
				echo"Server cannot accept email.";
			}
		}

		if ($_POST["coasters"] != $_SESSION['coastercount'] && $_POST["coasters"] != "") {

			$newCount = htmlentities(strip_tags(trim($_POST["coasters"])));
			$newCount = mysqli_real_escape_string($mysqli, $newCount);
			$newIntCount = filter_var($newCount, FILTER_SANITIZE_NUMBER_INT);
			$query = "UPDATE Profiles SET coastercount = '".$newIntCount."' WHERE id = '".$_SESSION['userid']."'";
			$result = mysqli_query($mysqli, $query); 
			if ($result > 0) {
				$_SESSION['coastercount'] = $newCount;
			}

		}


		if ($_POST["pass"] != "") {
			if ($_POST["pass"] != $_POST["passconf"]){return;};
			$newPass = $_POST['pass']; 
			$newPass = htmlentities(strip_tags(trim($newPass)));
			$newPass = mysqli_real_escape_string($mysqli, $newPass);
			if (strlen($newPass) < 6){return;};
			if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $newPass))
			{
			    $newPass = sha1($newPass);
			    $query = "UPDATE Profiles SET password = '".$newPass."' WHERE id = '".$_SESSION['userid']."'";
			    $result = mysqli_query($mysqli, $query); 
				if ($result > 0) {
					header('Location: logout.php');
				}
			}
		}
	}


	
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
	<form method="post" style="text-align: center;" autocomplete="off"> 
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

<?php
	$proPicPath = "media/icons/profileOrange.svg";
	if ($_SESSION['picPath'] != null && $_SESSION['picPath'] != "") {
		$proPicPath = $_SESSION['picPath'];
	}
?>

<div class="infoPanels"> 
	<div class="namePanel">
		<img class="proPic" src="<?=$proPicPath?>" alt="Profile Picture">

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

<hr style="margin-top: 25px;">


<?php
	$query = "SELECT firstname, lastname, status, username, email, coastercount, propic FROM Profiles ORDER BY firstname ASC";
	$result = mysqli_query($mysqli, $query); 
  	$num_rows = mysqli_affected_rows($mysqli);

  	if ($result && $num_rows > 0) {

  		$memberNum = $num_rows-1;

  		echo "<h2 style=\"margin-left: 25px;\">All members:</h2>";
  		echo "<div class=\"allMemPanels\">";

    while ($row = mysqli_fetch_assoc($result)) {
    	if ($row['username'] != $_SESSION['username'] && $row['username'] != "admin" && $row['username'] != "guest") {

    		$fullname = $row['firstname']." ".$row['lastname'];

    		if ($row['propic'] != null) {
				$proPicPath = $row['propic'];
			} else {
				$proPicPath = "media/icons/profileOrange.svg";
			}

			$statusMap = array(
			    "activemember" => "Active Member",
			    "inactivemember" => "Inactive Member",
			    "eboard" => "eboard",
			    "alumni" => "Alumni"
			);

    		echo "
				
					<div class=\"memberPanels\"> 
						<div class=\"panelTitleSec\">
							<img class=\"miniProPic\" src=".$proPicPath." alt=\"profile\">
							<p class=\"panelTitle\">".$fullname."</p>
						</div>
						<p class=\"panelInfo\"><strong> ".$statusMap[$row['status']]."</strong></p>
						<p class=\"panelInfo\"><strong>Username: </strong>".$row['username']."</p>
						<p class=\"panelInfo\"><strong>Email: </strong>".$row['email']."</p>
						<p class=\"panelInfo\"><strong>Coaster Count: </strong>".$row['coastercount']."</p>
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