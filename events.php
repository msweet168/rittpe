<?php
	require_once("sitewide/opener.php");
?>
	<title>Theme Park Enthusiasts - Events</title>
<?php
	require_once("sitewide/header.php"); 
	require_once("sitewide/nav.php");

?>

<div class="imageDiv">
	<img src="media/headerPhotos/jungle.jpg" alt="Coaster Lift" class="headerPic"> 
	<h1 class="pageTitleWhite">Future Events</h1>
</div>

<iframe id="calendar" src="https://calendar.google.com/calendar/embed?src=g.rit.edu_d76ki9svr7m7mba13sohsdgu54%40group.calendar.google.com&ctz=America%2FNew_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>


<?php 
    require_once("sitewide/footer.php");
?>

