<?php
	
	/*
		Deze api functie zorgt voor het updaten van een bestaande route. De route die geupdate moet worden, wordt geidentificeerd door de routeID in de POST. De status en de route kunnen aangepast worden. Als er geen route is meegegeven en alleen de status geupdate moet worden, dan wordt de route die nu in de database staat gebonden aan de parameter. De api stuurt een json bericht terug naar de java applicatie met de mededeling of het updaten wel of niet gelukt is.
	*/

	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	$postValues = array('routeID', 'status');

	foreach ($postValues as $postValue) {
		if (!isset($_POST[$postValue])) {
			echo 'Error, no ' . $postValue . ' set';
			return;
		}
	}

	$stmt = $db->prepare("UPDATE route SET status = :status, route = COALESCE(NULLIF(:route, ''), route) WHERE routeID = :routeID");
	$stmt->bindValue(':status', $_POST['status']);
	$stmt->bindValue(':routeID', $_POST['routeID']);
	$stmt->bindValue(':route', $_POST['route']);

	if(isset($_POST['route']))
		$stmt->bindValue(':route', $_POST['route']);

	echo json_encode(array('success' => $stmt->execute()));

?>
