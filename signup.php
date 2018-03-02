<?php
	$conn_string = include_once 'config.php';
	$conn = pg_connect($conn_string);		
	$username = $password = $confirm_password = $email = "";
	$username_err = $password_err = $confirm_password_err = $email_err = "";
	
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		if (empty(trim($_POST["username"]))) {
			$username_err = "Please enter a username.";
		} else {
			$param_username = trim($_POST["username"]);
			$query = sprintf("SELECT userid FROM wbproj.users WHERE username='%s';",$param_username);
			$result = pg_query($conn, $query);
			if (pg_num_rows($result) == 1) {
				$username_err = "Username already in use.";
			} else {
				$username = trim($_POST["username"]);
			}
		}
		
		if (empty(trim($_POST["email"]))) {
			$email_err = "Please enter an email address.";
		} else {
			$param_email = trim($_POST["email"]);
			$query = sprintf("SELECT email FROM wbproj.users WHERE email='%s';",$param_email);
			if (pg_num_rows($result) == 1) {
				$email_err = "Email address already in use.";
			} else {
				$email = trim($_POST["email"]);
			}
		}
		
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter a password.";
		} elseif (strlen(trim($_POST["password"])) < 7) {
			$password_err = "Password must have at least 7 characters.";
		} else {
			$password = trim($_POST["password"]);
		}
		
		if (empty(trim($_POST["confirm_password"]))) {
			$confirm_password_err = "Please confirm password.";
		} else {
			$confirm_password = trim($_POST["confirm_password"]);
			if ($password != $confirm_password) {
				$confirm_password_err = "Passwords do not match.";
			}
		}
		
		if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
			$param_username = $username;
			$param_password = password_hash($password,PASSWORD_DEFAULT);
			$param_email = $email;
			$query = sprintf("INSERT INTO wbproj.users(username, email, pwd) VALUES('%s','%s','%s');",$param_username,$param_email,$param_password);
			$results= pg_query($conn, $query);
			header("location: login.php");
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
	<link rel="stylesheet" href="style/signup.css">
</head>

<body>

    <nav class="w3-bar w3-black">
        <a href="index.html" class="w3-button w3-bar-item w3-hover-orange">Home</a>
        <a href="avatar.html" class="w3-button w3-bar-item w3-hover-orange">My Avatar</a>
        <a href="levels.html" class="w3-button w3-bar-item w3-hover-orange">Levels</a>
        <a href="login.html" class="w3-button w3-bar-item w3-right w3-hover-orange">Login</a>
    </nav>
	
	<section id="main_header" class="w3-container w3-center">
      <h1 class="w3-text-purple shadow"><b>Register</b></h1>
    </section>
	
	<section  id="mainbox" class="w3-container w3-content w3-center w3-padding-large">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<img src="images/pet3.png" class="cute_img" alt="One of the game's pets"/>
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : '';?>">
				<label>Username: </label><input type="text" class="input_margin" name="username" value="<?php echo $username; ?>">
				<span class="help-block"><?php echo $username_err?></span></div>
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : '';?>">
				<label>Email address: </label><input type="email" class="input_margin" name="email" value="<?php echo $email; ?>">
				<span class="help-block"><?php echo $email_err?></span></div>
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : '';?>">
				<label>Password: </label><input type="password" class="input_margin" name="password" value="<?php echo $password; ?>">
				<span class="help-block"><?php echo $password_err?></span></div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : '';?>">
				<label>Confirm: </label><input type="password" class="input_margin" name="confirm_password" value="<?php echo $confirm_password; ?>">
				<span class="help-block"><?php echo $confirm_password_err?></span></div>
			<div class="input_margin"><input type="submit" class="w3-button w3-purple"></div>
		</form>
		<div><p>Already have an account? <a href="login.php">Login here.</a></p></div>
	</section>
	
	<footer class="w3-center w3-black w3-padding-16">
        <p>&copy; Maxime Taylor</p>
    </footer>

</body>
</html>