<?php
	$conn_string = include_once 'config.php';
	session_start();
	$userid = null;
	if (!isset($_SESSION["userid"]) || empty($_SESSION['userid'])) {
		header("location: levels.html");
		exit;
	} else {
		$userid = $_SESSION["userid"];
	}
	$conn = pg_connect($conn_string);
	$query = sprintf("SELECT unlock FROM wbproj.users WHERE userid = '%s'",$userid);
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
        <a href="index.php" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.php" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.php" class="w3-button w3-bar-item w3-purple w3-hover-orange">Levels</a>
        <a href="logout.php" class="w3-button w3-bar-item w3-right w3-hover-orange">Logout</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Level Selection</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<form action="/play.php" method="POST" class="top-bottom-space">
			<h3 class="w3-purple">NORMAL PLAY</h3>
			<div><input type="image" id = "lvlbutton" name="lvl1" value="lvl1" src="images/level1.png" alt="Level 1">
			<div name="lvl2" <?php if ($level_unlock < 2) {echo 'class="locked" ';} ?>><input type="image" id = "lvlbutton" name="lvl2" value="lvl2" src="images/level2.png" alt="Level 2"></div>
			<div name="lvl3" <?php if ($level_unlock < 3) {echo 'class="locked" ';} ?>><input type="image" id = "lvlbutton" name="lvl3" value="lvl3" src="images/level3.png" alt="Level 3" title="Locked"/></div>
			<div name="lvl4" <?php if ($level_unlock < 4) {echo 'class="locked" ';} ?>><input type= "image" id = "lvlbutton" name="lvl4" value="lvl4" src="images/level4.png" alt="Level 4" title="Locked"/></div>
		</form>
		<form action="/play.php" method="POST" class="top-bottom-space">
			<h3 class="w3-purple">TIME CHALLENGE</h3>
			<p>Obtain bonus XP for a level by completing the time challenge!</p>
			<input type="image" <?php if ($level_unlock < 2) {echo 'class="locked"';}?> id="timebutton" name="lvl1challenge" value="lvl1challenge" src="images/time1.png" alt="Level 1 Time Challenge">
			<input type="image" <?php if ($level_unlock < 3) {echo 'class="locked"';}?> id="timebutton" name="lvl2challenge" value="lvl2challenge" src="images/time2.png" alt="Level 1 Time Challenge">
			<input type="image" <?php if ($level_unlock < 4) {echo 'class="locked"';}?> id="timebutton" name="lvl3challenge" value="lvl3challenge" src="images/time3.png" alt="Level 1 Time Challenge">
			<input type="image" <?php if ($level_unlock == 4) {echo 'class="locked"';}?> id="timebutton" name="lvl4challenge" value="lvl4challenge" src="images/time4.png" alt="Level 1 Time Challenge">
			<p id="note">You must complete a level in normal play before the time challenge is unlocked.</p>
		</form>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>