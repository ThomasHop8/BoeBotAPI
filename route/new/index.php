<?php
	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	$postValues = array('routeID', 'route', 'boebotID', 'status');

	foreach ($postValues as $postValue) {
		if (!isset($_POST[$postValue])) {
			echo "Error, no " . $postValue . ' value set';
			return;
		}
	}

	$stmt = $db->prepare('INSERT INTO route VALUES(:routeID, :route, :boebotID, :status)');
	$stmt->bindParam(':routeID', $_POST['routeID']);
	$stmt->bindParam(':route', $_POST['route']);
	$stmt->bindParam(':boebotID', $_POST['boebotID']);
	$stmt->bindParam(':status', $_POST['status']);

	echo json_encode(array('succes' => $stmt->execute()));
?>
