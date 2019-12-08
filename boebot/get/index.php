<?php

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