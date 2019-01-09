<?php
	require_once("sitewide/opener.php");
?>
	<title>Theme Park Enthusiasts - Exhibits</title>
<?php
	require_once("sitewide/header.php"); 
	require_once("sitewide/nav.php");

?>

<div class="imageDiv">
	<img src="media/headerPhotos/coaster2.jpg" alt="Coaster Lift" class="headerPic"> 
	<h1 class="pageTitleWhite">Our Exhibits</h1>
</div>


<h1 class="contentHeading">Imagine RIT</h1>
<p class="contentDesc">Imagine RIT is an innovation and creativity festival held campus-wide at RIT annually. Each year, our club returns with an enormous themed exhibit. These have included jungle, space, and “A Ride Through Time.” Imagine RIT is our largest exhibit of the year so be sure to stop by!</p>

<?php 
	function createExhibitGallery($imagePaths) {
		echo "<div class=\"gallery cf\">";
		for ($i = 0; $i < sizeof($imagePaths); $i++) {
			echo "<div>";
			echo "<img src=\"".$imagePaths[$i]."\"/>";
			echo "</div>";
		}
		echo "</div>";
	}

	$cshPath = "https://www.csh.rit.edu/~mitchell/tpe/media/exhibitPhotos/";
	$cshPathImag = $cshPath."imagine/";
	$imaginePhotos = array("$cshPathImag"."imag1", "$cshPathImag"."imag2","$cshPathImag"."imag3","$cshPathImag"."imag4","$cshPathImag"."imag5","$cshPathImag"."imag6");
	createExhibitGallery($imaginePhotos);
?>

<video class="videoPlayer" width="400" controls>
  <source src="https://www.csh.rit.edu/~mitchell/tpe/media/exhibitPhotos/povs/pov1.mp4" type="video/mp4">
</video>

<h1 class="contentHeading">Rochester Maker Faire</h1>
<p class="contentDesc">The Rochester Maker Faire is a gathering of fascinating and curious people who enjoy learning and who love sharing what they can do. The RIT Theme Park Enthusiasts attend annually with model theme park rides and VR experiences!</p>

<?php
	$cshPathMk = $cshPath."makerfaire/";
	$makerFairePhotos = array("$cshPathMk"."mk1", "$cshPathMk"."mk2","$cshPathMk"."mk3","$cshPathMk"."mk4","$cshPathMk"."mk5","$cshPathMk"."mk6");
	createExhibitGallery($makerFairePhotos);
?>

<video class="videoPlayer" width="400" controls>
  <source src="https://www.csh.rit.edu/~mitchell/tpe/media/exhibitPhotos/povs/pov3.mp4" type="video/mp4">
</video>


<h1 class="contentHeading">President's Alumni Ball</h1>
<p class="contentDesc">Held yearly, the President's Alumni Ball brings together RIT alumni from a wide spectrum of classes. The RIT Theme Park Enthusiasts have been invited to the event multiple years to present a special exhibit in the dark lit up by multi-colored lights.</p>

<?php
	$cshPathPres = $cshPath."presidentsball/";
	$makerFairePhotos = array("$cshPathPres"."pres1", "$cshPathPres"."pres2","$cshPathPres"."pres3","$cshPathPres"."pres4","$cshPathPres"."pres5","$cshPathPres"."pres6");
	createExhibitGallery($makerFairePhotos);
?>

<h2 class="textCentered exhibitsFooter">TPE exhibits are even more exciting when experienced in person. Check out our upcoming events!</h1>

<button onclick="window.location.href='events'" type="button" class="detailButton centered" style="margin-left: auto;">Future Events</button>

<?php 
    require_once("sitewide/footer.php");
?>

