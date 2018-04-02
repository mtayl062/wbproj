<?php
	session_start();
	$userid = null;
	if (!isset($_SESSION["userid"]) || empty($_SESSION['userid'])) {
		header("location: index.html");
		exit;
	} else {
		$userid = $_SESSION["userid"];
	}
	$pdo = include_once 'config.php';
	$sprite = $_POST['sprite_choice'];
	$bg = $_POST['bg_choice'];
	$pet = $_POST['pet_choice'];
	$query = $pdo->prepare("update wbproj.users set spriteid='".$sprite."', bgid='".$bg."', petid='".$pet."' WHERE userid = '".$userid."';");
	$query->execute();
	header("Location:avatar.php");
?>