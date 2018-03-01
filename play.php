<?php
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
	$question = 1;
	if (isset($_POST['qid'])) {
		$question = intval($_POST['qid']);
	}
	$score = 0;
	if (isset($_POST['score'])) {
		$score = intval($_POST['score']);
	}
	$conn = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=csi3540');
	$query = sprintf("select n1, d1, n2, d2, a, b, c, d, answer, op from wbproj.questions WHERE lid = '%d' AND qid = '%d'",$level,$question);
	$result = pg_query($conn, $query);
	$row = pg_fetch_row($result);
	$n1 = $row[0];
	$d1 = $row[1];
	$n2 = $row[2];
	$d2 = $row[3];
	$a_choice = $row[4];
	$b_choice = $row[5];
	$c_choice = $row[6];
	$d_choice = $row[7];
	$ans = $row[8];
	$op = $row[9];
	$lans = null;
	$rans = null;
	$rans_style = null;
	if ($op == "+") {
		$lans = $n1*$d2;
		$rans = $n2*$d1;
		$rans_style = "rans";
	} else {
		$lans = $n1*$d2-$n2*$d1;
		$rans = $n2*$d1;
		$rans_style = "rans-minus";
	}
	$rest = $d1*$d2 - $rans - $lans;
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
	<script>window.onload = function(event) {prepareCSS(<?php echo $n1.','.$d1.','.$n2.','.$d2?>)};</script>
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.html" class="w3-button w3-bar-item w3-purple w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange">Login</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Level <?php echo $level?></b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<span id="scoreboard" class="w3-purple" >Your score: <?php echo $score?></span>
		<img src="images/pet2.png" align="right"/>
		<br>
		<h2 class="w3-text-purple small_shadow"><b>Question <?php echo $question?> :  </b> <?php echo $n1.'/'.$d1?> <?php echo $op ?> <?php echo $n2.'/'.$d2?> = ?</h2>
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
			<form method="POST" action="<?php if ($question == 10) {echo 'levelComplete.php';} else {echo 'play.php';}?>">
				<input type="hidden" name="lvl<?php echo $level?>" value="lvl<?php echo $level?>">
				<input type="hidden" name="qid" value="<?php echo($question + 1)?>">
				<input type="hidden" name="score" id="score" value="<?php echo($score)?>">
				<input type="submit" name="next" id="next" value="Next">
			</form>
		<div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>