<nav id="desktopNav">
    <ul class="topnav deskNav">
		<li class="hide">
            <a class="<?= thisPage("members") ?>" href="members.php" id="lastIndex">Members</a>
        </li>

        <li class="hide">
            <a class="<?= thisPage("events") ?>" href="events.php">Events</a>
        </li>

        <li class="hide">
            <a class="<?= thisPage("exhibits") ?>" href="exhibits.php">Exhibits</a>
        </li>

        <li class="hide">
            <a class="<?= thisPage("feed") ?>" href="feed.php">Feed</a>
        </li>

        <li class = "hide">
            <a class="<?= thisPage("index") ?>" href="index.php">About</a>
        </li>

        <a href="index.php">
            <li style="float:left"><img src="media/logos/Site_Titlesml.png" alt="Site Logo" id="logo">
            </li>
        </a> 

        <li class="icon">
            <a onclick="menuFunction()">☰</a>
       </li>
    </ul>
</nav>



<nav id="mobileNav">
    <ul class="topnav" id="mytopnav">

        <a href="index.php">
            <li id="logoli"><img src="media/logos/Site_Titlesml.png" alt="Site Logo" id="logo">
            </li>
        </a> 

        <li class="hide"><a href="index.php">About</a></li>
        <li class="hide"><a href="feed.php">Feed</a></li>
        <li class="hide"><a href="exhibits.php">Exhibits</a></li>
        <li class="hide"><a href="events.php">Events</a></li>
        <li class="hide"><a href="members.php">Members</a></li>
        
        <li class="icon">
            <a id="menuIcon" onclick="menuFunction()">☰</a>
       </li>
    </ul>
</nav>

<div class="spacerDiv"></div>

<?php
    echo $msg;
?>