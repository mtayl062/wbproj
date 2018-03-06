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
	$level = null;
	if (isset($_POST['lvl1'])) {
		$level = 1;
	} elseif (isset($_POST['lvl2'])) {
		$level = 2;
	} elseif (isset($_POST['lvl3'])) {
		$level = 3;
	} elseif (isset($_POST['lvl4'])) {
		$level = 4;
	}
	$question_value = 10;
	$add_score = 0;
	$unlock = $level;
	if (isset($_POST['score'])) {
		$add_score = intval($_POST['score']);
		if ($_POST['score'] >= 3*$question_value) {
			$unlock = ($level < 5) ? ($level + 1) : $level;
		}
	}
	$_SESSION["score"] = (string)((intval($_SESSION["score"])) + $add_score);

	$conn_string = include_once 'config.php';
	$conn = pg_connect($conn_string);
	$query = sprintf("select score,unlock from wbproj.users WHERE userid='%s';",$userid);
	$result = pg_query($conn, $query);
	$row = pg_fetch_row($result);
	$old_score = $row[0];
	$old_unlock = $row[1];
	$new_score = $old_score + $add_score;
	$query = sprintf("update wbproj.users set score='%s' where userid='%s';",$new_score,$userid);
	pg_query($conn, $query);
	if ($unlock > $old_unlock) {
		$query = sprintf("update wbproj.users set unlock='%d' where userid='%s';",$unlock,$userid);
		pg_query($conn, $query);
	}
	
	$score_string = null;
	$success_string = null;
	if ($add_score > 0) {
		$score_string = "Well done, you have earned ".$add_score." XP.";
		$success_string = "Congratulations!";
	} else {
		$score_string = "You have not earned any XP.";
		$success_string = "Try again, you can do better!";
	}
	if ($unlock > $level && $old_unlock < $unlock && $unlock < 5) {
		$success_string = "Congratulations! You have unlocked level ".$unlock."!";
	} elseif ($level != 4 && $old_unlock == $unlock) {
		$q_missing = 3 - $add_score/$question_value;
		$plural = ($q_missing != 1) ? "s" : "";
		$success_string = "You need to answer ".$q_missing." more question".$plural." correctly to unlock level ".($unlock+1).".";
	}
	
	$player_level = 1;
	$rest_score = $new_score;
	$level_max = 100;
	if ($new_score > 500) {
		$player_level = 3;
		$rest_score = 500;
		$level_max = 500;
	} elseif ($new_score > 200) {
		$player_level = 3;
		$rest_score = $rest_score - 200;
		$level_max = 500;
	} elseif ($new_score > 100) {
		$player_level = 2;
		$rest_score = $rest_score - 100;
		$level_max = 200;
	} else {
		$rest_score = 100 - $rest_score;
	}
	$level_name = "Novice";
	if ($player_level == 2) {
		$level_name = "Apprentice";
	} elseif ($player_level == 3) {
		$level_name = "Adept";
	}
	$_POST = array();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="pragma" content="no-cache" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/play.css">
	<script src="scripts/play.js"></script>
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.php" class="w3-button w3-bar-item w3-purple w3-hover-orange">Home</a>
        <a href="avatar.php" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.php" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="logout.php" class="w3-button w3-bar-item w3-right w3-hover-orange">Logout</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Level <?php echo $level?></b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<div>
			<p class="w3-center w3-purple"><?php echo $score_string ?><br><?php echo $success_string?></p>
			<image src="/images/sprite2.png" alt="A sprite."/><br>
			<p class="w3-purple w3-padding-medium">Fractions Mastery: <?php echo $level_name ?></p>
			<span>Your progress: </span>	
			<meter min="0" max="<?php echo $level_max ?>" value="<?php echo $rest_score ?>"></meter>
			<a><?php echo $rest_score ?>/<?php echo $level_max ?> XP</a>
			<p><a class="w3-button w3-purple" href="levels.php">Return to Level Select</a></p>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p id="debug">&copy; Maxime Taylor</p>
    </footer>

</body>
</html>