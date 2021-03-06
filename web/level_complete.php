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
	$challenge = false;
	$multiplier = 0;
	$start_time = 0;
	if (isset($_POST['lvl1_x'])) {
		$level = 1;
	} elseif (isset($_POST['lvl2_x'])) {
		$level = 2;
	} elseif (isset($_POST['lvl3_x'])) {
		$level = 3;
	} elseif (isset($_POST['lvl4_x'])) {
		$level = 4;
	} elseif (isset($_POST['lvl1challenge_x'])) {
		$level = 1;
		$challenge = true;
		$multiplier = 0.2;
		$start_time = 15;
	} elseif (isset($_POST['lvl2challenge_x'])) {
		$level = 2;
		$challenge = true;
		$multiplier = 0.4;
		$start_time = 30;
	} elseif (isset($_POST['lvl3challenge_x'])) {
		$level = 3;
		$challenge = true;
		$multiplier = 0.4;
		$start_time = 35;
	} elseif (isset($_POST['lvl4challenge_x'])) {
		$level = 4;
		$challenge = true;
		$multiplier = 0.8;
		$start_time = 40;
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
	$time = null;
	if (isset($_POST['time'])) {
		$time = intval($_POST['time']);
	}

	$pdo = include_once 'config.php';
	$query = $pdo->prepare(sprintf("select score,unlock from wbproj.users WHERE userid='%s';",$userid));
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$old_score = $row['score'];
	$old_unlock = $row['unlock'];
	$new_score = $old_score + $add_score;
	$leaderboard_score = $add_score;
	if ($challenge) {
		if ($time > 0) {
			$new_score += $add_score*$multiplier;
			$leaderboard_score += $leaderboard_score/10 * ($start_time - $time + 1);
		}
	}
	$query = $pdo->prepare(sprintf("update wbproj.users set score='%s' where userid='%s';",$new_score,$userid));
	$query->execute();
	if ($unlock > $old_unlock) {
		$query = $pdo->prepare(sprintf("update wbproj.users set unlock='%d' where userid='%s';",$unlock,$userid));
		$query->execute();
	}
	
	$score_string = null;
	$success_string = null;
	if ($add_score > 0) {
		$score_string = "Well done, you have earned ".$add_score." XP.";
		if ($challenge) {
			if ($time > 0) {
				$score_string = $score_string."<br>You also earned a bonus ".($add_score*$multiplier)." XP for completing the time challenge in ".$time." s.";
			}
		}
		$success_string = "Congratulations!";
	} else {
		$score_string = "You have not earned any XP.";
		$success_string = "Try again, you can do better!";
	}
	if ($unlock > $level && $old_unlock < $unlock && $unlock < 5) {
		$success_string = "Congratulations! You have unlocked Level ".$unlock."!";
	} elseif ($level != 4 && $old_unlock == $unlock && !$challenge) {
		$q_missing = 3 - ($add_score)/$question_value;
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
	} elseif ($new_score >= 200) {
		$player_level = 3;
		$rest_score = $rest_score - 200;
		$level_max = 500;
	} elseif ($new_score >= 100) {
		$player_level = 2;
		$rest_score = $rest_score - 100;
		$level_max = 200;
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
			<p class="w3-center w3-purple w3-padding-medium"><?php echo $score_string ?><br><?php echo $success_string?></p>
			<image src="/images/sprite2.png" alt="A sprite."/><br>
			<p class="w3-purple w3-padding-medium">Fractions Mastery: <?php echo $level_name ?></p>
			<span>Your progress: </span>	
			<meter min="0" max="<?php echo $level_max ?>" value="<?php echo $rest_score ?>"></meter>
			<a><?php echo $rest_score; ?>/<?php echo $level_max; ?> XP</a>
			<p class="w3-purple w3-padding-medium">LEADERBOARD</p>
			<?php
				$query = $pdo->prepare("insert into wbproj.leaderboard values (".$level.",'".$username."',".$leaderboard_score.");");
				$query->execute();
				$leaderboard_query = $pdo->prepare("select * from wbproj.leaderboard where lid = '".$level."' order by score desc limit 3");
				$leaderboard_query->execute();
				$result = $leaderboard_query->fetchAll(PDO::FETCH_ASSOC);
				$number = 1;
				foreach ($result as $row) {
					echo "<p>".$number.'. '.$row['username']." = ".$row['score']." XP</p>";
					$number = $number + 1;
				}
			?>
			<p><a class="w3-button w3-purple" href="levels.php">Return to Level Select</a></p>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p id="debug">&copy; Maxime Taylor</p>
    </footer>

</body>
</html>