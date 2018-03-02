<?php
	$conn_string = include_once 'config.php';
	$conn = pg_connect($conn_string);
	$sprite = $_POST['sprite_choice'];
	$bg = $_POST['bg_choice'];
	$pet = $_POST['pet_choice'];
	$query = "update wbproj.users set spriteid='".$sprite."', bgid='".$bg."', petid='".$pet."' WHERE userid = '1';";
	pg_query($conn, $query);
	header("Location:avatar.php");
?>