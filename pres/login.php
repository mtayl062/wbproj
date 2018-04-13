<?php
	$pdo = include_once 'config.php';
	$username = $password = "";
	$username_err = $password_err = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty(trim($_POST["username"]))) {
			$username_err = "Please enter username.";
		} else {
			$username = trim($_POST["username"]);
		}
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter password.";
		} else {
			$password = trim($_POST["password"]);
		}
		
		if (empty($username_err) && empty($password_err)) {
			$param_username = $username;
			$query = $pdo->prepare(sprintf("SELECT username, pwd, userid FROM wbproj.users WHERE username='%s';",$username));
			$query->execute();
			if ($query->rowCount() == 1) {
				$row = $query->fetch(PDO::FETCH_ASSOC);
				$stored_password = trim($row['pwd']);
				$correct_login = password_verify($password,$stored_password);
				if ($correct_login) {
					session_start();
					$_SESSION["username"] = $username;
					$_SESSION["userid"] = $row['userid'];
					$_SESSION["score"] = "0";
					header('location: index.php');
				} else {
					$password_err = "Password invalid.";
				}
			} else {
				$username_err = "No such username.";
			}
		}
	}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="style/main.css">
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.php" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.php" class="w3-button w3-bar-item w3-right w3-hover-orange w3-purple">Login</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Login</b></h1>
    </section>
	
	<section id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="top-bottom-space">
				<img src="images/title.png" alt="ALL TALK AND NO FRACTION"/><br>
			</div>
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
				<input type="text" class="input_margin form-control" placeholder="username" name="username" value="<?php echo $username; ?>" autofocus>
				<span class="help-block"><?php echo $username_err; ?></span></div>
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
				<input type="password" class="input_margin form-control" placeholder="password" name="password">
				<span class="help-block"><?php echo $password_err; ?></span></div>
			<div><input type="submit" class="input_margin w3-button w3-purple"></div>
			<img src="images/pet4.png" class="cute_img" alt="One of the game's pets"/>
			<div class="input_margin">Not a member? Click <a href="signup.php">here</a> to sign up.</div>
		</form>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>