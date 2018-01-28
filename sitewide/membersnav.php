
<div class="sideBar" onmouseover="expand()" onmouseout="contract()">
<ul class="memberNav" onmouseover="expand()" onmouseout="contract()" <?php echo($_SESSION['userpermission'] == "admin" ? 'style = "height: 720px;"' : 'style = "height: 425px;"');?>>
	<li><a class="<?= thisPage("members") ?>" href="members.php">
		<div class="navDiv">

			<img src="media/icons/profile.svg" alt="profile" class="navImg">

			<p class="navText">Profile</p>

		</div>
	</a></li>
    <li><a class="<?= thisPage("newsfeed") ?>" href="newsfeed.php">

    	<div class="navDiv">

			<img src="media/icons/newspaper.svg" alt="profile" class="navImg">

			<p class="navText">Newsfeed</p>

		</div>

    </a></li>
    <li><a class="<?= thisPage("chat") ?>" href="chat.php">

    	<div class="navDiv">

			<img src="media/icons/chatbubble.svg" alt="profile" class="navImg">

			<p class="navText">TPE Chat</p>

		</div>

    </a></li>
    <li><a class="<?= thisPage("surveys") ?>" href="surveys.php">

    	<div class="navDiv">

			<img src="media/icons/checked.svg" alt="profile" class="navImg">

			<p class="navText">Surveys</p>

		</div>

    </a></li>
    <li><a class="<?= thisPage("trips") ?>" href="trips.php">

    	<div class="navDiv">

			<img src="media/icons/roller-coaster.svg" alt="profile" class="navImg">

			<p class="navText">Current Trip</p>

		</div>

    </a></li>
    <li><a class="<?= thisPage("quotes") ?>" href="quotes.php">

    	<div class="navDiv">

			<img src="media/icons/quotes.svg" alt="profile" class="navImg">

			<p class="navText">Quotevault</p>

		</div>

    </a></li>

    <?php

    	if ($_SESSION['userpermission'] == "admin") {
    		echo "
    			<hr>

			    <li><a href=\"accountset.php\">

			    	<div class=\"navDiv\">

						<img src=\"media/icons/at.svg\" alt=\"profile\" class=\"navImg\">

						<p class=\"navText\">Accounts</p>

					</div>

			    </a></li>
			    <li><a href=\"infoset.php\">

			    	<div class=\"navDiv\">

						<img src=\"media/icons/info.svg\" alt=\"profile\" class=\"navImg\">

						<p class=\"navText\">Club Info</p>

					</div>

			    </a></li>
			    <li><a href=\"eventset.php\">

			    	<div class=\"navDiv\">

						<img src=\"media/icons/event.svg\" alt=\"profile\" class=\"navImg\">

						<p class=\"navText\">Events</p>

					</div>

			    </a></li>
			    <li><a href=\"eboardset.php\">

			    	<div class=\"navDiv\">

						<img src=\"media/icons/govbuilding.svg\" alt=\"profile\" class=\"navImg\">

						<p class=\"navText\">Eboard</p>

					</div>

			    </a></li>
			    <li><a href=\"adminchat.php\">

			    	<div class=\"navDiv\">

						<img src=\"media/icons/speech-bubble.svg\" alt=\"profile\" class=\"navImg\">

						<p class=\"navText\">Admin Chat</p>

					</div>

			    </a></li>
    		";

    	}

    ?>

</ul>
</div>


<div class="membersHeader"> 
	<h1 class="membersTitle">TPE Members</h1>
	<button type="button" class="infoSiteButton" onclick="window.location.href='logout.php'">Log out</button>
</div>

<div class="memberContent" id="memCont">

