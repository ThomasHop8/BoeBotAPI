<?php
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
