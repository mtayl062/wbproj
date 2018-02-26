<?php
	session_start();
	$_SESSION = array();
	session_destroy();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.html" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange w3-purple">Login</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Goodbye, friend!</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<div class="top-bottom-space">
			<p>Logout successful.<p>
			<p>Not done yet? Click <a href="login.php">here</a> if you'd like to log in again.</p>
		</div>
		<div class="top-bottom-space">
			<img src="images/pet1.png" alt="One of the game's pets" id="pet-banner"/>
			<img src="images/pet2.png" alt="One of the game's pets" id="pet-banner"/>
			<img src="images/pet3.png" alt="One of the game's pets" id="pet-banner"/>
			<img src="images/pet4.png" alt="One of the game's pets" id="pet-banner"/>
		</div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>