<?php
	if (isset($_POST['submit_login'])){
		checkLogin($_POST['username'], $_POST['password']);
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
						<div style="color:#fff;">Username: </div>
						<input name="username" id="user-pwd" type="text"/><br><br>
						<div style="color:#fff;">Password: </div>
						<input name="password" id="user-pwd" type="password"/><br><br>
						<input type="submit" name="submit_login" value="Login">
					</form>
					</center>
				</td></tr>
			</table>
			</center>
	    </div>

	    <div>
	    	<center>
		    <a href="#" style="margin-top:15px;">Forgot your username?</a><br>
		    <a href="#" style="margin-top:15px; margin-bottom:30px;">Forgot your password?</a>
		    </center>
	    </div>
	   </div>



	</body>


</html>

<?php

	function checkLogin($username, $password) {
		require_once "../connect.php";	

		$username = sha1($username);
		$password = sha1($password);

		// Make the query and execute it
		$command = "SELECT * FROM login_credentials WHERE username = '".$username."' and password = '".$password."'";
		$query_result = mysqli_query($connect, $command) or die (mysqli_error());
		// header("refresh:0; url=../unsuccessful_checkout.php");
		// If there is one result the user can be logged in
		if (mysqli_num_rows($query_result)==1){
			header("refresh:0; url=../members.php");
		}else{
			header("refresh:0; url=../unsuccessful_checkout.php");
		}
	    
	}
?>