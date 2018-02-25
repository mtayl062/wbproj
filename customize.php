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
        <a href="index.html" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-purple w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange">Login</a>
    </nav>
    
    <section id="main_header" class="w3-container w3-center">
        <h1 class="w3-text-purple shadow"><b>Customize My Avatar</b></h1>
    </section>
    
    <section id="mainbox" class="w3-container w3-content w3-center">
        <div>
            <?php
				$db = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=csi3540');
				$query = "select * from wbproj.user_avatar LIMIT 1";
				$result = pg_query($db, $query);
				while ($row = pg_fetch_row($result)) {
					echo '<image id="sprite" src="images/sprite'.$row[1].'.png" alt="Your sprite"/>'."\n";
					echo '<image id="bg" src="images/bg'.$row[2].'.png" alt="Your background"/>'."\n";
					echo '<image id="pet" src="images/pet'.$row[3].'.png" alt="Your avatar"/>'."\n";
					echo '</div>'."\n";
					echo '<p class="top-bottom-space"><form method="GET" action="/update_avatar.php" id="avatarForm">';
					echo '<input type="hidden" id="sprite_choice" name="sprite_choice" value="'.$row[1].'"/>';
					echo '<input type="hidden" id="bg_choice" name="bg_choice" value="'.$row[2].'"/>';
					echo '<input type="hidden" id="pet_choice" name="pet_choice" value="'.$row[3].'"/>';
					echo '<input id="submission" type="submit" value="Submit Changes" class="w3-button w3-purple">';
					echo '</form></p>'."\n";
				}
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