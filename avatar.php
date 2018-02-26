<!DOCTYPE html>

<?php
	require_once 'config.php';
?>

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
        <a href="index.html" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-purple w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange">Login</a>
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
						$query = "select * from wbproj.users where userid='1'";
						$result = pg_query($db, $query);
						while ($row = pg_fetch_row($result)) {
							echo '<image id="sprite" src="images/sprite'.$row[4].'.png" alt="Your sprite"/>'."\n";
							echo '<image id="bg" src="images/bg'.$row[5].'.png" alt="Your background"/>'."\n";
							echo '<image id="pet" src="images/pet'.$row[6].'.png" alt="Your avatar"/>'."\n";
						}
					?>
                </div>
                <br>
                <a id="cus_button" href="customize.php" class="w3-button w3-purple">Customize</a>
            </section>
        </div>
        <div id="level_info">
            <div class="top-bottom-space">
                <h3 class="w3-purple">Level 1<br></h3>
            </div>
            <div class="top-bottom-space">
                <meter min="0" max="100" value="70"></meter>
                <a>70/100 XP</a>
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