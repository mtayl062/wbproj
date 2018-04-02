<?php
	function gcd($a,$b) {
		$a = abs($a); $b = abs($b);
		if( $a < $b) list($b,$a) = Array($a,$b);
		if( $b == 0) return $a;
		$r = $a % $b;
		while($r > 0) {
			$a = $b;
			$b = $r;
			$r = $a % $b;
		}
		return $b;
	}

	$level = null;
	$challenge = false;
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
	} elseif (isset($_POST['lvl2challenge_x'])) {
		$level = 2;
		$challenge = true;
	} elseif (isset($_POST['lvl3challenge_x'])) {
		$level = 3;
		$challenge = true;
	} elseif (isset($_POST['lvl4challenge_x'])) {
		$level = 4;
		$challenge = true;
	}
	$question = 1;
	if (isset($_POST['qid'])) {
		$question = intval($_POST['qid']);
	}

	$pdo = include_once 'config.php';
	$score = 0;
	if (isset($_POST['score'])) {
		$score = intval($_POST['score']);
	}
	$query = $pdo->prepare(sprintf("select n1, d1, n2, d2, a, b, c, d, answer, op from wbproj.questions WHERE lid = '%d' AND qid = '%d'",$level,$question));
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$n1_og = $row['n1'];
	$d1_og = $row['d1'];
	$gcd1 = gcd($n1_og,$d1_og);
	$n1 = $n1_og / $gcd1;
	$d1 = $d1_og / $gcd1;
	$n2_og = $row['n2'];
	$d2_og = $row['d2'];
	$gcd2 = gcd($n2_og,$d2_og);
	$n2 = $n2_og / $gcd2;
	$d2 = $d2_og / $gcd2;
	$a_choice = $row['a'];
	$b_choice = $row['b'];
	$c_choice = $row['c'];
	$d_choice = $row['d'];
	$ans = $row['answer'];
	$op = $row['op'];
	$lans = null;
	$rans = null;
	$rans_style = null;
	$gcd = gcd($d1,$d2);
	if ($op == "+") {
		$lans = $n1*$d2/$gcd;
		$rans = $n2*$d1/$gcd;
		$rans_style = "rans";
	} else {
		$lans = ($n1*$d2-$n2*$d1)/$gcd;
		$rans = $n2*$d1/$gcd;
		$rans_style = "rans-minus";
	}
	$rest = $d1*$d2/$gcd - $rans - $lans;
	
	$time = null;
	if ($level == 1) {
		$time = 15;
	} elseif ($level == 2) {
		$time = 30;
	} elseif ($level == 3) {
		$time = 35;
	} elseif ($level == 4) {
		$time = 40;
	}
	if (isset($_POST['time'])) {
		$time = intval($_POST['time']);
	}

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
	<script>window.onload = function(event) {prepareCSS(<?php echo $n1.','.$d1.','.$n2.','.$d2.','.$challenge?>);};</script>
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.php" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.php" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.php" class="w3-button w3-bar-item w3-purple w3-hover-orange">Levels</a>
        <a href="logout.php" class="w3-button w3-bar-item w3-right w3-hover-orange">Logout</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Level <?php echo $level?></b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<span class="scoreboard w3-purple" >LEVEL SCORE: <?php echo $score?></span>
		<?php if ($challenge) {echo '<span id="timebox" class="scoreboard w3-purple" >LEVEL TIME: '.$time.' s</span>';}?>
		<img src="images/pet2.png" align="right"/>
		<h2 class="w3-text-purple small_shadow"><b>Question <?php echo $question?> :  </b> <?php echo $n1_og.'/'.$d1_og?> <?php echo $op ?> <?php echo $n2_og.'/'.$d2_og?> = ?</h2>
		<br>
		<ul>
			<li class="rect" id="l1"></li><li class="rect" id="r1"></li><span id="op"> <?php echo $op ?> </span>
			<li class="rect" id="l2"></li><li class="rect" id="r2"></li>
		</ul>
		<br>
		<div>
			<button id="A" onclick="showAnswer(this.id,'<?php echo $ans?>');">A) <?php echo $a_choice?></button>
			<button id="B" onclick="showAnswer(this.id,'<?php echo $ans?>');">B) <?php echo $b_choice?></button>
			<button id="C" onclick="showAnswer(this.id,'<?php echo $ans?>');">C) <?php echo $c_choice?></button>
			<button id="D" onclick="showAnswer(this.id,'<?php echo $ans?>');">D) <?php echo $d_choice?></button>
		</div>
		<div id="answer">
			<h4 id="answer_text" class="w3-text-purple"></h4>
			<ul id="answer_bar">
				<?php for ($i = 0 ; $i < $lans; $i++) { echo '<li class="rect lans"></li>';} for ($i = 0 ; $i < $rans; $i++) { echo '<li class="rect '.$rans_style.'"></li>';} for ($i = 0 ; $i < $rest; $i++) { echo '<li class="rect rest"></li>';}?>
			</ul>
		<div>
		<div>
			<form method="POST" action="<?php if ($question == 4) {echo 'level_complete.php';} else {echo 'play.php';}?>">
				<input type="hidden" name="lvl<?php if ($challenge) {echo $level."challenge_x";} else {echo $level."_x";}?>" value="lvl<?php if ($challenge) {echo $level."challenge_x";} else {echo $level."_x";}?>">
				<input type="hidden" name="qid" value="<?php echo($question + 1)?>">
				<input type="hidden" name="score" id="score" value="<?php echo($score)?>">
				<?php if ($challenge) {echo '<input type="hidden" name="time" id="time" value="'.$time.'">';}?>
				<input type="submit" name="next" id="next" value="Next">
			</form>
		<div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p id="debug">&copy; Maxime Taylor</p>
    </footer>

</body>
</html>