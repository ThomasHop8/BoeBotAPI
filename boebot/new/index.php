<?php

	/*
		Deze api functie zorgt ervoor dat er een nieuwe Boebot in de database toegevoegd kan worden. De api stuurt een json bericht terug naar de java applicatie met de mededeling of het toevoegen wel of niet gelukt is.
	*/
	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	
	if (!isset($_POST['name'])) {
		echo 'Error, no name set';
		return;
	}

	$stmt = $db->prepare("INSERT INTO `boebot` (`name`) VALUES (:name)");
	$stmt->bindParam(':name', $_POST['name']);

	echo json_encode(array('succes' => $stmt->execute()));
?>
