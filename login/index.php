<?php
	
	if (isset($_POST['submit_login'])) {

		session_start();
	    $_SESSION['GRANTED'] = true;

		checkLogin($_POST['username'], $_POST['password']);
	}

	// If user forgot their username
	if (isset($_POST['retrieve_username_submit'])) {

		retrieveUsername($_POST['username_retrieve']);
	}

	// If user forgot their password
	if (isset($_POST['retrieve_password_submit'])) {

		retrievePassword($_POST['password_retrieve']);
	}
?>

<!DOCTYPE HTML>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0"> <!-- maximum-scale=1, user-scalable=0 -->
		<link rel="stylesheet" href="../css/style.css" />

		<title>The Zen Picks</title>
		<link rel="icon" type="image/gif" href="../images/fav_icon.png">
	</head>


	<body>


	   <header class="zenPicks_title">
	   		The Zen Picks
	   		<!-- <a href="http://thezenpicks.com/login.php"><span class="smallText" >Login</span></a> -->
	   </header>
		<ul class="navigation">
		    <li class="nav-item"><a href="#"></a></li>
		    <br>
			<div style="width: 200px;">
				<a href="https://twitter.com/thezenpicks" ><img src="../images/twitter.png" align="left" class="social"/></a>
				<a href="https://www.facebook.com/TheZenPicks" ><img src="../images/facebook.png" align="left" class="social"/></a>
				<a href="https://instagram.com/thezenpicks/" ><img src="../images/instagram.png" align="left" class="social"/></a>
		    </div>
		    <br>
		    <br>
		    <br>
		    <br>
		    <li class="nav-item"><a href="http://thezenpicks.com/">Home</a></li>
		    <li class="nav-item"><a href="http://thezenpicks.com/philosophy.php">Philosophy</a></li>
		    <li class="nav-item"><a href="http://thezenpicks.com/performance.php">Performance</a></li>
		    <li class="nav-item"><a href="http://thezenpicks.com/subscribe.php">Subscribe</a></li>
		    <hr>
		    <li class="nav-item"><a href="http://thezenpicks.com/admin">Admin</a></li>
		</ul>

		<input type="checkbox" id="nav-trigger" class="nav-trigger" />
		<label for="nav-trigger"></label>

		<div class="site-wrap">
	    <div>
			<center>
			<table width="50%">
				<tr height="auto"><td>
					<center>
					<form method="post" style="margin-top:20px;"> <!-- action="check_login.php" -->
						<div style="color:#fff; font-size:22px;">Username: </div>
						<input name="username" id="user-pwd" type="text"/><br><br>
						<div style="color:#fff; font-size:22px;">Password: </div>
						<input name="password" id="user-pwd" type="password"/><br><br>
						<input type="submit" name="submit_login" value="Login">
					</form>
					</center>
				</td></tr>
			</table>
			</center>
	    </div>

	    <div>

	    	<!-- Forgot password and/or username.  -->
	    	<center>
		    <a href="#" onclick="document.getElementById('forgot_username').style.display='block';document.getElementById('fade').style.display='block'; return false; " style="margin-top:15px;">Forgot your username?</a><br>
		    <a href="#" onclick="document.getElementById('forgot_password').style.display='block';document.getElementById('fade').style.display='block'; return false; " style="margin-top:15px; margin-bottom:30px;">Forgot your password?</a>

		    <!-- <p>
		     	This is the main content. To display a lightbox click 
		     	<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'; return false; ">here</a>
		     </p> -->

		    <!-- USED FOR FORGETTING USERNAME -->
	        <div id="forgot_username" class="white_content">
				<form method="post" style="margin-top:20px;"> <!-- action="check_login.php" -->
					<br>
					<img src="../images/spiral.png" align="left" style="height: auto; max-width: 50px; margin-top:-7%;">
					<img src="../images/spiral.png" align="right" style="height: auto; max-width: 50px; margin-top:-7%;">
					<br>
					<div style="color:#000; font-size:22px; margin-top:10%;">Enter your password: </div>
					<input name="username_retrieve" id="user-pwd" type="text"/><br><br>
					<input type="submit" name="retrieve_username_submit" value="Login">
				</form>
				<br>
	        	<a href = "javascript:void(0)" onclick = "document.getElementById('forgot_username').style.display='none';document.getElementById('fade').style.display='none'">
	        		Close
	        	</a>
	        </div>

		    <!-- USED FOR FORGETTING PASSWORD -->
	        <div id="forgot_password" class="white_content">
				<form method="post" style="margin-top:20px;"> <!-- action="check_login.php" -->
					<br>
					<img src="../images/spiral.png" align="left" style="height: auto; max-width: 50px; margin-top:-7%;">
					<img src="../images/spiral.png" align="right" style="height: auto; max-width: 50px; margin-top:-7%;">
					<br>
					<div style="color:#000; font-size:22px; margin-top:10%;">Enter your username: </div>
					<input name="password_retrieve" id="user-pwd" type="text"/><br><br>
					<input type="submit" name="retrieve_password_submit" value="Login">
				</form>
				<br>
	        	<a href = "javascript:void(0)" onclick = "document.getElementById('forgot_password').style.display='none';document.getElementById('fade').style.display='none'">
	        		Close
	        	</a>
	        </div>
	        <div id="fade" class="black_overlay"></div>
		   </div>

		    </center>
	    </div>
	   </div>



	</body>


</html>

<?php

	function checkLogin($username, $password) {
		require_once "../connect.php";	

		// Make the query and execute it
		$command = "SELECT * FROM login_credentials WHERE username = '".$username."' and password = '".$password."'";
		$query_result = mysqli_query($connect, $command) or die (mysqli_error());
		// header("refresh:0; url=../unsuccessful_checkout.php");
		// If there is one result the user can be logged in
		if (mysqli_num_rows($query_result)==1) {
			header("refresh:0; url=../members.php");
		} else {
			header("refresh:0; url=../unsuccessful_checkout.php");
		}
	    
	}

	/**
	 *	Retrieve the username for the user.
	 *	User must enter their password in order to retrieve username
	 */
	function retrieveUsername($password) {
		require_once "../connect.php";	

		// $password = sha1($password);

		// Select a single username form db
		$command = "SELECT * FROM login_credentials WHERE password = '".$password."'";
		$query = mysqli_query($connect, $command) or die (mysqli_error());

		// If there was a match, show them the username
		if (mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
					echo '<script type="text/javascript">alert("Your username is: ' . $row[username] . '")</script>';
					break;
			}
		} 
		// If there was no match, show them this message.
		else {
			echo '<script type="text/javascript">alert("No usernames match the given password...")</script>';
		}
	}

	/**
	 *	Retrieve the password for the user.
	 *	User must enter their username in order to retrieve password
	 */
	function retrievePassword($username) {
		require_once "../connect.php";	

		// Select a single password form db
		$command = "SELECT * FROM login_credentials WHERE username = '".$username."'";
		$query = mysqli_query($connect, $command) or die (mysqli_error());

		// If there was a match, show them the password
		if (mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
					echo '<script type="text/javascript">alert("Your password is: ' . $row[password] . '")</script>';
					break;
			}
		} 
		// If there was no match, show them this message.
		else {
			echo '<script type="text/javascript">alert("No passwords match the given username...")</script>';
		}
	}
?>