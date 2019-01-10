<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Eboard</title>
<?php
	
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

  $query = "SELECT username, position, bio FROM Eboard";
  $result = mysqli_query($mysqli, $query);
  $num_rows = mysqli_affected_rows($mysqli);  
  $currentEboard = array();
  if ($result && $num_rows > 0) {
  	while ($row = mysqli_fetch_assoc($result)) {
  		$currentEboard[$row['position']] = array($row['username'], $row['bio']);
  	}
  } else {
  	header('Location: servererr');
  }

  function getUserOptions($allUsers, $position, $currentEboard) {

  	$userOptions = "";
  	foreach($allUsers as $name => $username) {
  		if ($username == "admin" || $username == "guest") {
  			continue;
  		}

  		$userOptions .= "<option value=\"$username\"";
  		if ($currentEboard["$position"][0] == $username) {
  			$userOptions .= " selected";
  		}
  		$userOptions .= ">$name ($username)</option>";

  	}
  	return $userOptions;
  }

  function createPositionUserSelect($position, $allUsers, $currentEboard) {
  	$options = getUserOptions($allUsers, $position, $currentEboard);
  	echo "<select class=\"positionSelect\"name=\"$position\">".$options."</select>";
  }

?>

<form class="eboardForm" method="post">

	<h1 class="positionTitle">President</h1>
	<?php createPositionUserSelect("President", $allUsers, $currentEboard)?>
	<input type="text" class="bioInput" name="presBio" placeholder="Enter bio..." value="<?=$currentEboard["President"][1]?>">
	
	<h1 class="positionTitle">Vice President</h1>
	<?php createPositionUserSelect("Vice President", $allUsers, $currentEboard)?>
	<input type="text" class="bioInput" name="vpBio" placeholder="Enter bio..." value="<?=$currentEboard["Vice President"][1]?>">

	<h1 class="positionTitle">Treasurer</h1>
	<?php createPositionUserSelect("Treasurer", $allUsers, $currentEboard)?>
	<input type="text" class="bioInput" name="treasurerBio" placeholder="Enter bio..." value="<?=$currentEboard["Treasurer"][1]?>">

	<h1 class="positionTitle">Secretary</h1>
	<?php createPositionUserSelect("Secretary", $allUsers, $currentEboard)?>
	<input type="text" class="bioInput" name="secretaryBio" placeholder="Enter bio..." value="<?=$currentEboard["Secretary"][1]?>">

	<h1 class="positionTitle">Public Relations</h1>
	<?php createPositionUserSelect("Public Relations", $allUsers, $currentEboard)?>
	<input type="text" class="bioInput" name="prBio" placeholder="Enter bio..." value="<?=$currentEboard["Public Relations"][1]?>">

	<h1 class="positionTitle">advisor</h1>
	<?php createPositionUserSelect("Faculty Advisor", $allUsers, $currentEboard)?>
	<input type="text" class="bioInput" name="advisorBio" placeholder="Enter bio..." value="<?=$currentEboard["Faculty Advisor"][1]?>">

	<input class="eboardSubmit" type="submit">

</form>


</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>