<?php
	require_once("sitewide/opener.php");
?>
	<title>Login to TPE Members</title>

<?php
$loginFailed = false; 

if ($_SESSION['loggedIn'] == true) {
	header('Location: members');
}

if (!isset($_SESSION['loginRetries'])) {
  	$_SESSION['loginRetries'] = 0;
}

if (!empty($_POST)) {

    ob_end_clean();

	  $query = "SELECT * FROM Profiles";
	  $result = mysqli_query($mysqli, $query); 
	  $num_rows = mysqli_affected_rows($mysqli); 

	  if ($result && $num_rows > 0) {

	    $success = false; 
	    $username = htmlentities(strip_tags(trim($_POST["username"])));
        $username = mysqli_real_escape_string($mysqli, $username);

        $password = htmlentities(strip_tags(trim($_POST["password"])));
        $password = mysqli_real_escape_string($mysqli, $password);
        $password = sha1($password);

	    while ($row = mysqli_fetch_assoc($result)) {

	        if((($row["username"] == $username) || ($row["email"] == $username)) &&  ($row["password"] == $password)) {
	          $success = true; 
	          $_SESSION['userid'] = $row["id"];
	          $_SESSION['username'] = $row["username"]; 
	          $_SESSION['userfirstname'] = $row["firstname"]; 
	          $_SESSION['userlastname'] = $row["lastname"]; 
	          $_SESSION['useremail'] = $row["email"];
	          $_SESSION['userpermission'] = $row["permission"]; 
	          $_SESSION['memberstatus'] = $row["status"]; 
	          $_SESSION['coastercount'] = $row["coastercount"]; 
	          $_SESSION['creationdate'] = $row["creationdate"];
	          $_SESSION['picPath'] = $row['propic'];
	        } 
	    }

	    if ($success == true) {
	        $_SESSION['loggedIn'] = TRUE;
	        $_SESSION['loginRetries'] = 0;
	        $timestamp = date('Y-m-d H:i:s');
	        mysqli_query($mysqli, "UPDATE Profiles SET lastlogin = \"".$timestamp."\" WHERE id = \"".$_SESSION['userid']."\"");

	        if (!isset($_SESSION['redirect'])) {
		  		$_SESSION['redirect'] = "members"; 
			} 

	        header('Location: '.$_SESSION['redirect'].'');
	    }
	    else {
	    	 $loginFailed = true;
			 $_SESSION['loginRetries']++;
	    	 if ($_SESSION['loginRetries'] >= 5) {
	    	 	echo '<script>;
				      alert("Please contact an Eboard member if you do not know your username or password.");
				      </script>';
	    	 	//header('Location: index');
	    	}	
	    }

	  }

	}

?>

<?php
	require_once("sitewide/header.php"); 
?>

<div class="membersHeader"> 
	<h1 class="membersTitle">TPE Members</h1>
	<button type="button" onclick="window.location.href='.'" class="infoSiteButton">Exit Members</button>
</div>


<div id="loginDiv">
	<h1 id="loginTitle">Login to TPE Members</h1>

	<?php
		if ($loginFailed == true) {
			echo"<p id=\"loginError\">Incorrect username or password.</p>";
		}
	?>
	<form method = "post" style="clear:both;">
	  <input name = "username" placeholder="Enter your username or email." id="userField" class="loginField"/><br/>
	  <input type = "password" name="password" placeholder="Enter your password." id="passField" class="loginField"/><br/>
	  <p class="forgot">Forgot username or password?<br>Contact an Eboard member.</p>
	  <input type="submit" value="Login" id="loginButton"/>
    </form>
</div>


<a id="githubLink" href="https://github.com/msweet168/rittpe">Website on Github <img src="media/icons/GithubLogo.png" alt="github" style="width: 15px;"></a>


<script src="scripts.js"></script>
