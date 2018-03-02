<?php
	$conn_string = include_once 'config.php';
	session_start();
	if (!isset($_SESSION["username"]) || empty($_SESSION['username'])) {
		header("location: index.html");
		exit;
	}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/index.css">
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.php" class="w3-button w3-bar-item w3-purple w3-hover-orange">Home</a>
        <a href="avatar.php" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.php" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="logout.php" class="w3-button w3-bar-item w3-right w3-hover-orange">Logout</a>
    </nav>
	
	<section  id="main_header" class="w3-container w3-center">
      <h1><b>All talk and no FRACTION</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<div>
			<p>Hello there, <?php echo $_SESSION["username"] ?>! "All talk and no fraction" is an interactive learning experience that's all about mastering fractions. A variety of levels will 
				guide you through mathematical operations such as summation and substraction. You'll also earn experience points, medals and cool unlockables along the way!</p>
		</div>
		<div>
			<img src="images/pet1.png" alt="One of the game's pets"/>
			<img src="images/pet2.png" alt="One of the game's pets"/>
			<img src="images/pet3.png" alt="One of the game's pets"/>
			<img src="images/pet4.png" alt="One of the game's pets"/>
		</div>
		<div>
			<p><a href="logout.php" class="w3-button w3-purple">Sign Out of Your Account</a></p>
		</div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>