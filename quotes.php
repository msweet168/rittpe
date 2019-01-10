<?php
	require_once("sitewide/opener.php");
?>
	<title>TPE Quotevault</title>
<?php
	
	$quoteSuccess = "";
	if (!empty($_POST)) {

		if(isset($_POST["hide"])) {
			$query = "UPDATE Quotes SET hidden = true where quoteid = '".$_POST["hide"]."'";
			mysqli_query($mysqli, $query);
		}
		else if($_POST["quote"]!="" && $_POST["quotee"]!=""){
			$quote = htmlentities(strip_tags(trim($_POST["quote"])));
	        $quote = mysqli_real_escape_string($mysqli, $quote);

	        $quotee = htmlentities(strip_tags(trim($_POST["quotee"])));
	        $quotee = mysqli_real_escape_string($mysqli, $quotee);

	        $query = "INSERT INTO Quotes
	                  SET poster ='".$_SESSION['userfirstname']."',
	                      posterusername ='".$_SESSION['username']."', 
	                      quotee = '".$quotee."',
	                      quote = '".$quote."'"; 

	        $result = mysqli_query($mysqli, $query); 
	        $num_rows = mysqli_affected_rows($mysqli); 

	        if ($result && $num_rows > 0) {
	        	$quoteSuccess = "<h2 style=\"text-align: center\">Quote added!</h2>";
	        }
    	}
    	else {
    		echo"<p>Database error. Please try again...</p>";
    	}
	}
	
	if (!isset($_SESSION['loggedIn'])) {
  		$_SESSION['loggedIn'] = FALSE;

  		$_SESSION['redirect'] = "quotes.php"; 
  		header('Location: login.php');
	} 
	else if ($_SESSION['loggedIn'] == FALSE) {
		$_SESSION['redirect'] = "quotes.php"; 
		header('Location: login.php');
	}
	else {
		require_once("sitewide/header.php"); 
	    require_once("sitewide/membersnav.php");
  		// echo "Hello ".$_SESSION["userfirstname"]."! Everything is good, let's read some quotes!<br>";
	}

?>

<div class="membersPageTitle"> 
	<span class="orangeTitle">Quotevault</span>
	<h2 class="memPageDesc">If a member says something funny at a TPE event, preserve it here forever.<br>Only members and Eboard can view quotes.</h2>
</div>

<?php
	if($_SESSION['userpermission'] == "guest") {
		echo "<h2 style=\"text-align: center;\">Unfortunately, guests cannot view quotes. </br> Please contact an Eboard member to upgrade your account.</h2>";
		echo "<script src=\"assets/js/scripts.js\"></script>";
	  	exit();
	 }
?>

<form id="quoteForm" method="post" onsubmit="return quoteValidate()">
	<input name="quote" class="quoteTextBox" id="quoteField" placeholder="What was said?"/>
	<input name="quotee" class="quoteTextBox" id="quoteeField" placeholder="Who said it?"/>
	<input type="submit" value="Submit" id="quoteSubmit"/>
</form>


<?php
  echo $quoteSuccess;

  $query = "SELECT * FROM Quotes ORDER BY quoteid DESC";
  $result = mysqli_query($mysqli, $query); 
  $num_rows = mysqli_affected_rows($mysqli); 

  echo "<h3 class=\"quoteTotal\">".$num_rows." quotes</h3>";

  if ($result && $num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    	if ($row["hidden"] == true) {
    		continue;
    	}
		echo "
			<div class=\"quoteDiv\">
				<div class=\"quoteHeader\">
					<p class=\"quote\">\"".$row["quote"]."\"<strong> - ".$row["quotee"]."</strong></p>
				</div>
				<div class=\"quoteFooter\">
					<p class=\"quoteInfo\">Submitted by <strong>".$row["poster"]."</strong> (".$row["posterusername"].") on ".$row["date"].".</p>
				</div>
			</div>
		";

		if($_SESSION['userpermission'] == "admin") {
			echo "
				<form method=\"post\">
					<button name=\"hide\" type=\"submit\" value=\"".$row["quoteid"]."\" class=\"quoteDelete\"/>Delete</button>
				</form>
			";

		}
    }

  }

?>

</div>
<script src="assets/js/scripts.js"></script>
<?php 
    // require_once("sitewide/footer.php");
?>