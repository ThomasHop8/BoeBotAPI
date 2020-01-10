<?php

	/*
		Deze api functie zorgt ervoor dat er een nieuwe route vanuit de java applicatie in de database toegevoegd kan worden. 
		Een nieuwe route in de database krijgt de status 'READY'. De api stuurt een json bericht terug naar de java applicatie met de mededeling of het toevoegen wel of niet gelukt is.
	*/
	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	$postValues = array('route', 'boebotID');

	foreach ($postValues as $postValue) {
		if (!isset($_POST[$postValue])) {
			echo "Error, no " . $postValue . ' value set';
			return;
		}
	}

	$stmt = $db->prepare('INSERT INTO route VALUES(null, :route, :boebotID, "READY")');
	$stmt->bindParam(':route', $_POST['route']);
	$stmt->bindParam(':boebotID', $_POST['boebotID']);

	echo json_encode(array('success' => $stmt->execute(), 'routeID' => $db->lastInsertId()));
?>
