<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Eboard</title>
<?php

	$positionMap = array(
  		"president" => "President",
  		"vicepresident" => "Vice President",
  		"treasurer" => "Treasurer",
  		"secretary" => "Secretary",
  		"pr" => "Public Relations",
  		"advisor" => "Faculty Advisor"
  	);

  	$successMessage = "";

	if (!empty($_POST)) {

		$query = "SELECT * FROM Eboard";
  		$result = mysqli_query($mysqli, $query);
  		$num_rows = mysqli_affected_rows($mysqli);

  		$unchangedEboard = array();
  		if ($result && $num_rows > 0) {
  			while ($row = mysqli_fetch_assoc($result)) {
  				$unchangedEboard[$row['Position']] = array("username" => $row["username"], "bio" => $row["Bio"]);
  			}
  		} else {
  			header('Location: servererr');
  		}

  		$purgeArray = array();
  		$newArray = array();

  		foreach($positionMap as $simpleName => $databaseName) {
  			if ($_POST[$simpleName] != $unchangedEboard[$databaseName]["username"]) {
  				$query = "UPDATE Eboard SET username = '".$_POST[$simpleName]."' WHERE Position = '".$databaseName."'";
  				mysqli_query($mysqli, $query);

  				array_push($purgeArray, $unchangedEboard[$databaseName]["username"]);
  			}
  			array_push($newArray, $_POST[$simpleName]);
  		}

  		$bios = array(
  			"presBio" => "President",
  			"vpBio" => "Vice President", 
  			"treasurerBio" => "Treasurer", 
  			"secretaryBio" => "Secretary", 
  			"prBio" => "Public Relations", 
  			"advisorBio" => "Faculty Advisor"
  		);

  		foreach ($bios as $bio => $position) {
  			if ($_POST[$bio] != $unchangedEboard[$position]["bio"]) {
  				$sanBio = htmlentities(strip_tags(trim($_POST["bio"])));
	        	$sanBio = mysqli_real_escape_string($mysqli, $sanBio);

  				$query = "UPDATE Eboard SET bio = '".$sanBio."' WHERE Position = '".$position."'";
  				mysqli_query($mysqli, $query); 
  			}
  		}

  		// Purge old admins and eboard members and turn them into active members with member permissions.
  		foreach ($purgeArray as $user) {

  			$logout = false; 
  			if(in_array($_SESSION['username'], $purgeArray) && !(in_array($_SESSION['username'], $newArray))) {
  				$logout = true;
  			}

  			$query = "UPDATE Profiles SET status = 'activemember', permission = 'member' WHERE username = '".$user."'";
  			mysqli_query($mysqli, $query);

  			if ($logout) {
  				header('Location: logout');
  			}

  		}

  		// Ensure all of eboard have eboard statuses and are admins. 
  		foreach ($newArray as $user) {
  			$query = "UPDATE Profiles SET status = 'eboard', permission = 'admin' WHERE username = '".$user."'";
  			mysqli_query($mysqli, $query);
  		}

  		$successMessage = "<h2 class=\"eboardSuccessMsg\"> Eboard has been updated. "; 
  		$purged = ""; 
  		foreach ($purgeArray as $usrs) {
  			if (!(in_array($usrs, $newArray))) {
  				$purged .= $usrs." ";
  			}
  		}
  		if ($purged != "") {
  			$successMessage .= "These users are no longer admins: ".$purged; 
  		}
  		$successMessage .= "</h2>";

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
	<span class="orangeTitle">Eboard Settings</span>
	<h2 class="memPageDesc">Edit the current TPE eboard</h2>
	<?=$successMessage?>
</div>

<?php
  $query = "SELECT firstname, lastname, username FROM Profiles ORDER BY firstname ASC";
  $result = mysqli_query($mysqli, $query); 
  $num_rows = mysqli_affected_rows($mysqli); 
  $allUsers = array();

  if ($result && $num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    	$fullname = "".$row['firstname']." ".$row['lastname'];
    	$allUsers[$fullname] = $row["username"];
    }
  } else {
  	header('Location: servererr');
  }

  $query = "SELECT * FROM Eboard";
  $result = mysqli_query($mysqli, $query);
  $num_rows = mysqli_affected_rows($mysqli);  
  $currentEboard = array();
  if ($result && $num_rows > 0) {
  	while ($row = mysqli_fetch_assoc($result)) {
  		$currentEboard[$row['Position']] = array($row['username'], $row['Bio']);
  	}
  } else {
  	header('Location: servererr');
  }


  function getUserOptions($allUsers, $position, $currentEboard) {

  	$positionMap = array(
  		"president" => "President",
  		"vicepresident" => "Vice President",
  		"treasurer" => "Treasurer",
  		"secretary" => "Secretary",
  		"pr" => "Public Relations",
  		"advisor" => "Faculty Advisor"
  	);

  	$userOptions = "";
  	foreach($allUsers as $name => $username) {
  		if ($username == "admin" || $username == "guest") {
  			continue;
  		}

  		$userOptions .= "<option value=\"$username\"";
  		if ($currentEboard[$positionMap["$position"]][0] == $username) {
  			$userOptions .= " selected";
  		}
  		$userOptions .= ">$name ($username)</option>";

  	}
  	return $userOptions;
  }

  function createPositionUserSelect($position, $allUsers, $currentEboard) {
  	$options = getUserOptions($allUsers, $position, $currentEboard);
  	echo "<select class=\"positionSelect\"name=\"$position\">".$options."</select></br>";
  }

?>

<form class="eboardForm" method="post">

	<h1 class="positionTitle">President</h1>
	<?php createPositionUserSelect("president", $allUsers, $currentEboard)?>
	<textarea class="bioTextArea" name="presBio" placeholder="Enter bio..."><?=$currentEboard["President"][1]?></textarea>
	
	<h1 class="positionTitle">Vice President</h1>
	<?php createPositionUserSelect("vicepresident", $allUsers, $currentEboard)?>
	<textarea class="bioTextArea" name="vpBio" placeholder="Enter bio..."><?=$currentEboard["Vice President"][1]?></textarea>

	<h1 class="positionTitle">Treasurer</h1>
	<?php createPositionUserSelect("treasurer", $allUsers, $currentEboard)?>
	<textarea class="bioTextArea" name="treasurerBio" placeholder="Enter bio..."><?=$currentEboard["Treasurer"][1]?></textarea>

	<h1 class="positionTitle">Secretary</h1>
	<?php createPositionUserSelect("secretary", $allUsers, $currentEboard)?>
	<textarea class="bioTextArea" name="secretaryBio" placeholder="Enter bio..."><?=$currentEboard["Secretary"][1]?></textarea>

	<h1 class="positionTitle">Public Relations</h1>
	<?php createPositionUserSelect("pr", $allUsers, $currentEboard)?>
	<textarea class="bioTextArea" name="prBio" placeholder="Enter bio..."><?=$currentEboard["Public Relations"][1]?></textarea>

	<h1 class="positionTitle">Faculty Advisor</h1>
	<?php createPositionUserSelect("advisor", $allUsers, $currentEboard)?>
	<textarea class="bioTextArea" name="advisorBio" placeholder="Enter bio..."><?=$currentEboard["Faculty Advisor"][1]?></textarea>
	</br>
	<input class="infoSubmit eboardSubmit" type="submit" value="Update">

</form>


</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>