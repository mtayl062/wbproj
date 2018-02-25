<?php
	$conn = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=csi3540');
	$sprite = $_GET['sprite_choice'];
	$bg = $_GET['bg_choice'];
	$pet = $_GET['pet_choice'];
	$query = "update wbproj.user_avatar set spriteid='".$sprite."', bgid='".$bg."', petid='".$pet."' WHERE userid = '1';";
	pg_query($conn, $query);
	header("Location:avatar.php");
?>