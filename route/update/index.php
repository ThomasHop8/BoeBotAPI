<?php

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
