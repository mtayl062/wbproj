<?php
	
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
      <h1 class="w3-text-purple shadow"><b>Login</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<form>
			<img src="images/pet4.png" class="cute_img" alt="One of the game's pets"/>
			<div><input type="text" class="input_margin" placeholder="username"></div>
			<div><input type="password" class="input_margin" placeholder="password"></div>
			<div><input type="submit" class="input_margin w3-button w3-purple"></div>
			<div class="input_margin">Not a member? Click <a href="signup.html">here</a> to sign up.</div>
		</form>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>