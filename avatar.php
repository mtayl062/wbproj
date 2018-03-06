<?php
	session_start();
	$userid = null;
	$username = null;
	if (!isset($_SESSION["userid"]) || empty($_SESSION['userid'])) {
		header("location: avatar.html");
		exit;
	} else {
		$userid = $_SESSION["userid"];
		$username = $_SESSION["username"];
	}
	$conn_string = include_once 'config.php';
	$db = pg_connect($conn_string);
	$query = sprintf("select score, unlock from wbproj.users where userid='%s'",$userid);
	$result = pg_query($db, $query);
	$row = pg_fetch_row($result);
	$score = $row[0];
	$unlock = $row[1];
	$player_level = 1;
	$rest_score = $score;
	$level_max = 100;
	$level_name = "Novice";
	$progress_string = "You only need <strong>".($level_max - $rest_score)."</strong> more XP to <br>reach Mastery Level: Apprentice.";
	if ($score > 500) {
		$player_level = 3;
		$rest_score = 500;
		$level_max = 500;
		$level_name = "Expert";
		$progress_string = "You have reached the maximum amount of XP. <br>You are truly a master of fractions.";
	} elseif ($score > 200) {
		$player_level = 3;
		$rest_score = $rest_score - 200;
		$level_max = 500;
		$level_name = "Adept";
		$progress_string = "You only need <strong>".($level_max - $rest_score)."</strong> more XP <br>to reach Mastery Level: Expert.";
	} elseif ($score > 100) {
		$player_level = 2;
		$rest_score = $rest_score - 100;
		$level_max = 200;
		$level_name = "Apprentice";
		$progress_string = "You only need <strong>".($level_max - $rest_score)."</strong> more XP <br>to reach Mastery Level: Adept.";
	}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/avatar.css">
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.php" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.php" class="w3-button w3-bar-item w3-purple w3-hover-orange">My Avatar</a>
        <a href="levels.php" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="logout.php" class="w3-button w3-bar-item w3-right w3-hover-orange">Logout</a>
    </nav>

    <section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>My Avatar</b></h1>
    </section>
	
    <section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
        <div id="avatar_outer">
            <section id="avatar_section" class="w3-container w3-content w3-center">
                <div id="avatar_inner">
					<?php
						$db = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=csi3540');
						$query = sprintf("select spriteid, bgid, petid, score from wbproj.users where userid='%s'",$userid);
						$result = pg_query($db, $query);
						$score = null;
						while ($row = pg_fetch_row($result)) {
							echo '<image id="sprite" src="images/sprite'.$row[0].'.png" alt="Your sprite"/>'."\n";
							echo '<image id="bg" src="images/bg'.$row[1].'.png" alt="Your background"/>'."\n";
							echo '<image id="pet" src="images/pet'.$row[2].'.png" alt="Your avatar"/>'."\n";
							$score = $row[3];
						}
					?>
                </div>
                <br>
                <a id="cus_button" href="customize.php" class="w3-button w3-purple">Customize</a>
            </section>
        </div>
        <div id="level_info">
            <div class="top-bottom-space">
                <h3 class="w3-purple">Fractions Mastery: <?php echo $level_name ?><br></h3>
            </div>
            <div class="top-bottom-space">
				<meter min="0" max="<?php echo $level_max ?>" value="<?php echo $rest_score ?>"></meter>
                <a><?php echo $rest_score ?>/<?php echo $level_max ?> XP</a>
            </div>
            <div class="top-bottom-space">
                <p>Last level unlocked: <?php echo $unlock?></p>
                <p><?php echo $progress_string?></p>
            </div>
        </div>
    </section>

    <footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>