<?php
	$conn = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=csi3540');
	$query = "SELECT unlock FROM wbproj.users WHERE userid = '1'";
	$result = pg_query($conn, $query);
	$row = pg_fetch_row($result);
	$level_unlock = intval($row[0]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/levels.css">
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.html" class="w3-button w3-bar-item w3-purple w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange">Login</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Level Selection</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<div name="lvl1"><a href="play.html"><img id = "lvlbutton" src="images/level1.png" alt="Level 1"></a></div>
		<div name="lvl2" <?php if ($level_unlock < 2) {echo 'class="locked" ';} ?>><a href="play.html"><img id = "lvlbutton" src="images/level2.png" alt="Level 2"></a></div>
		<div name="lvl3" <?php if ($level_unlock < 3) {echo 'class="locked" ';} ?>><a href="play.html"><img id = "lvlbutton" src="images/level3.png" alt="Level 3" title="Locked"/></a></div>
		<div name="lvl4" <?php if ($level_unlock < 4) {echo 'class="locked" ';} ?>><a href="play.html"><img id = "lvlbutton" src="images/level4.png" alt="Level 4" title="Locked"/></a></div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>