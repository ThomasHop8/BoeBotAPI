<?php
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
