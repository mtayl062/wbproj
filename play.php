<?php
	$lvl = null;
	if (isset($_POST['lvl1'])) {
		$lvl = 1;
	} elseif (isset($_POST['lvl2'])) {
		$lvl = 2;
	} elseif (isset($_POST['lvl3'])) {
		$lvl = 3;
	} elseif (isset($_POST['lvl4'])) {
		$lvl = 4;
	}
	$question = 1;
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
        <a href="index.html" class="w3-button w3-bar-item w3-purple w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange">Login</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Level 1</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<img src="images/pet2.png" align="right"/>
		<h3 class="w3-text-purple small_shadow"><b>Question 1:  </b><span id="f1">1/3</span> + <span id="f2">1/2</span> = ?</h3>
			<ul>
				<li class="rect l1"></li><li class="rect r1"></li><span id="plus"> + </span>
				<li class="rect l2"></li><li class="rect r2"></li>
			</ul>
		<div>
			<button id="A" onclick="showAnswer(this.id);">A) 2/5</button>
			<button id="B" onclick="showAnswer(this.id);">B) 4/5</button>
			<button id="C" onclick="showAnswer(this.id);">C) 5/6</button>
			<button id="D" onclick="showAnswer(this.id);">D) 4/6</button>
		</div>
		<div id="answer">
			<h4 id="answer_text" class="w3-text-purple"></h4>
			<ul id="answer_bar">
				<li class="rect lans"></li><li class="rect lans"></li><li class="rect rans"></li><li class="rect rans"></li><li class="rect rans"></li><li class="rect rest"></li>
			</ul>
		<div>
		<div>
			<button id="next">Next</button>
		<div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>