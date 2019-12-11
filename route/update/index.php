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

	$stmt = $db->prepare("UPDATE route SET status = :status WHERE routeID = :routeID");
	$stmt->bindValue(':status', $_POST['status']);
	$stmt->bindValue(':routeID', $_POST['routeID']);

	echo json_encode(array('succes' => $stmt->execute()));
	
?>