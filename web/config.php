<?php
	$pdo = null;
	try {
		$pdo = new PDO('pgsql:dbname=postgres;host=/cloudsql/wbproj-csi3540:us-central1:wbprojdb','postgres','postgres');
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	return $pdo;
?>