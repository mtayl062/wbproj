<?php
	$conn_string = include_once 'config.php';
	$db = pg_connect($conn_string);
	$query = "select username, score from wbproj.users where userid='1'";
	$result = pg_query($db, $query);
	$row = pg_fetch_row($result);
	$username = $row[0];
	$score = $row[1];
	$player_level = 1;
	$rest_score = $score;
	$level_max = 100;
	if ($score > 500) {
		$player_level = 3;
		$rest_score = 500;
		$level_max = 500;
	} elseif ($score > 200) {
		$player_level = 3;
		$rest_score = $rest_score - 200;
		$level_max = 500;
	} elseif ($score > 100) {
		$player_level = 2;
		$rest_score = $rest_score - 100;
		$level_max = 200;
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
						$query = "select spriteid, bgid, petid, score from wbproj.users where userid='1'";
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
                <h3 class="w3-purple">Level <?php echo $player_level ?><br></h3>
            </div>
            <div class="top-bottom-space">
                <meter min="0" max="<?php echo $level_max ?>" value="<?php echo $rest_score ?>"></meter>
                <a><?php echo $rest_score ?>/<?php echo $level_max ?> XP</a>
            </div>
            <div class="top-bottom-space">
                <p>Latest awards obtained:</p>
                <table>
                    <tr>
                        <th><image src="images/medal1.png" alt="Medal 1" title="Completed World 1.1!"/></th>
                        <th><image src="images/medal2.png" alt="Medal 2" title="Completed a level with no mistakes!"/></th>
                        <th><image src="images/medal3.png" alt="Medal 3" title="Completed World 1.2!"/></th>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>