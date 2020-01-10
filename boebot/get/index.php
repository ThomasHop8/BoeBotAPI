<?php
	
	/*
	Deze api functie zorgt voor het ophalen en versturen van de Boebots die in de 'boebot' tabel staan. De resultaten worden in json formaat 
	naar de java applicatie gestuurd. Zijn er geen resultaten, dan wordt de json 'boebot':'null' verstuurd.
	*/

	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	$stmt = $db->prepare("SELECT * FROM boebot");
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($result) {
		echo json_encode($result);
	}else{
		echo "{'boebot': 'null'}";
	}

?>