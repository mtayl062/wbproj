<?php
	session_start();
	$userid = null;
	if (!isset($_SESSION["userid"]) || empty($_SESSION['userid'])) {
		header("location: customize.html");
		exit;
	} else {
		$userid = $_SESSION["userid"];
	}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/customize.css">
    <script src="scripts/customize.js"></script>
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.php" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.php" class="w3-button w3-bar-item w3-purple w3-hover-orange">My Avatar</a>
        <a href="levels.php" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="logout.php" class="w3-button w3-bar-item w3-right w3-hover-orange">Logout</a>
    </nav>
    
    <section id="main_header" class="w3-container w3-center">
        <h1 class="w3-text-purple shadow"><b>Customize My Avatar</b></h1>
    </section>
    
    <section id="mainbox" class="w3-container w3-content w3-center">
        <div>
            <?php
				$pdo = include_once 'config.php';
				$query = $pdo->prepare(sprintf("select spriteid, bgid, petid from wbproj.users where userid='%s';", $userid));
				$query->execute();
				$row = $query->fetch(PDO::FETCH_ASSOC);
				echo '<image id="sprite" src="images/sprite'.$row['spriteid'].'.png" alt="Your sprite"/>'."\n";
				echo '<image id="bg" src="images/bg'.$row['bgid'].'.png" alt="Your background"/>'."\n";
				echo '<image id="pet" src="images/pet'.$row['petid'].'.png" alt="Your avatar"/>'."\n";
				echo '</div>'."\n";
				echo '<p class="top-bottom-space"><form method="POST" action="/update_avatar.php" id="avatarForm">';
				echo '<input type="hidden" id="sprite_choice" name="sprite_choice" value="'.$row['spriteid'].'"/>';
				echo '<input type="hidden" id="bg_choice" name="bg_choice" value="'.$row['bgid'].'"/>';
				echo '<input type="hidden" id="pet_choice" name="pet_choice" value="'.$row['petid'].'"/>';
				echo '<input id="submission" type="submit" value="Submit Changes" class="w3-button w3-purple">';
				echo '</form></p>'."\n";
			?>
        <p class="w3-text w3-large"><button onclick="changeImageLeft('sprite',6,5)">&lt;</button>  Avatar Color  <button onclick="changeImageRight('sprite',6,5)">&gt;</button></p>
        <p class="w3-text w3-large"><button onclick="changeImageLeft('bg',2,5)">&lt;</button>  Background  <button onclick="changeImageRight('bg',2,5)">&gt;</button ></p>
        <p class="w3-text w3-large"><button onclick="changeImageLeft('pet',3,4);">&lt;</button>  Companion  <button onclick="changeImageRight('pet',3,4);">&gt;</button></p>
    </section>
    
    <footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>