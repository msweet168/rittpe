<?php
	require_once("sitewide/opener.php");
?>
	<title>Theme Park Enthusiasts</title>
<?php
	require_once("sitewide/header.php"); 
	require_once("sitewide/nav.php");

?>

<div class="imageDiv">
	<img src="media/headerPhotos/canadaAlpha.png" alt="Canada Group" class="headerPic"> 
	<h1 class="pageTitle">RIT Theme Park Enthusiasts</h1>
</div>


<?php
  $infoQuery = "SELECT * FROM ClubInfo";
  $infoResult = mysqli_query($mysqli, $infoQuery); 
  $infoNumrows = mysqli_affected_rows($mysqli); 

  if ($infoResult && $infoNumrows > 0) {
    while ($row = mysqli_fetch_assoc($infoResult)) {
      $intro = $row["Intro"];
      $activities = $row["Activities"];

    }
  }
?>

<h1 class="contentHeading">Who We Are:</h1>
<p class="contentDesc"><?= $intro ?></p>

<button onclick="window.location.href='index.php#eboard'" type="button" class="detailButton">Our E-Board</button>

<h1 class="contentHeading">What We Do:</h1>
<p class="contentDesc"><?= $activities?></p>

<button onclick="window.location.href='exhibits.php'" type="button" class="detailButton">Past Exhibits</button>

<h1 class="contentHeading">Our E-Board:</h1>
<a name='eboard'>
<div id="eboardDiv">

	<?php
		$positions = array("President", "Vice President", "Treasurer", "Secretary", "Public Relations", "Faculty Advisor");

		for ($i=0; $i<count($positions); $i++) { 
			$eboardQuery = "SELECT Eboard.Position, Eboard.bio, Profiles.propic, Profiles.firstname, Profiles.lastname, Profiles.email
							FROM Eboard 
							JOIN Profiles
							ON Eboard.username = Profiles.username
							WHERE Eboard.Position = \"".$positions[$i]."\";"; 
			$eboardResult = mysqli_query($mysqli, $eboardQuery);

			while ($row = mysqli_fetch_assoc($eboardResult)) {


				$fullname = "".$row['firstname']." ".$row['lastname']; 
				echo "
					<div class=\"eboardProfile\">
					<img src=\"".$row["propic"]."\" alt=\"Profile Picture\" class=\"ePhoto\">
					<p class=\"eName\">".$fullname."</p>
					<p class=\"ePosition\">".$row["Position"]."</p>
					<p class=\"eBio\">".$row["bio"]."</p>
					<hr>
					<button type=\"button\" class=\"eLink\" onclick=\"window.location.href='mailto:".$row["email"]."'\">@</button>
					</div>
					";

		    }
			
		}
	?>

</div>




<?php 
    require_once("sitewide/footer.php");
?>

