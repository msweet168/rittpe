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
	<h1 class="pageTitle">RIT Theme park Enthusiasts</h1>
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

<button type="button" class="detailButton">Our E-Board</button>

<h1 class="contentHeading">What We Do:</h1>
<p class="contentDesc"><?= $activities?></p>

<button type="button" class="detailButton">Past Events</button>

<h1 class="contentHeading">Our E-Board:</h1>
<div id="eboardDiv">

	<?php
		$positions = array("President", "Vice President", "Treasurer", "Secretary", "Public Relations", "Faculty Advisor");


		for ($i=0; $i<count($positions); $i++) { 
			$eboardQuery = "SELECT * FROM Eboard WHERE Position = \"".$positions[$i]."\""; 
			$eboardResult = mysqli_query($mysqli, $eboardQuery);

			while ($row = mysqli_fetch_assoc($eboardResult)) {

				echo "
					<div class=\"eboardProfile\">
					<img src=\"media/eboardPhotos/mitchell.jpg\" alt=\"Profile Picture\" class=\"ePhoto\">
					<p class=\"eName\">".$row["Name"]."</p>
					<p class=\"ePosition\">".$row["Position"]."</p>
					<p class=\"eBio\">".$row["Bio"]."</p>
					<hr>
					<button type=\"button\" class=\"eLink\" onclick=\"window.location.href=\"mailto:".$row["Email"]."\">@</button>
					</div>
					";


		   	   // echo "
	                // <div class=\"eboardText\">
					// <h1 class=\"eboardPosition\">".$row["Position"]."</h1>
					// <p class=\"eboardName\">".$row["Name"]."</p>
					// <a href=\"mailto:".$row["Email"]."\" class=\"eboardEmail\"><p>".$row["Email"]."</p></a>
					// <p class=\"eboardBio\">".$row["Bio"]."</p>
					// </div>
					// <img src=\"media/logos/black_logo.png\" alt=\"Profile Picture\" class=\"eboardPhoto\">
		   			// ";

		    }
			
		}
	?>

   <!-- <div class="eboardProfile">
		<img src="media/eboardPhotos/mitchell.jpg" alt="Profile Picture" class="ePhoto">
		<p class="eName">Caroline Kruse</p>
		<p class="ePosition">President</p>
		<p class="eBio">Caroline Kruse is a fifth year Mechanical Engineer minoring in Electrical Engineering. She is in the Dual Degree program and will be completing her B.S. and M.Eng. degrees in May. She experienced her first Theme Park Industry co-op  with Universal this summer and loved it! She's looking forward to working full time in the industry soon!</p>
		<hr>
        <button type="button" class="eLink" onclick="window.location.href='http://www.apple.com'">@</button>
	    </div> -->

</div>




<?php 
    require_once("sitewide/footer.php");
?>

