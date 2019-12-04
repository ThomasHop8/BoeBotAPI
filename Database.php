<?php

	require_once 'Database.php';

	$database = new Database();
	$db = $database->getConnection();

	if (!isset($_POST['routeID'])) {
		echo 'Error, no routeID set';
		return;
	}

	$routeID = $_POST['routeID'];

	$stmt = $db->prepare('SELECT * FROM Route WHERE routeID = ' . $routeID);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if($result){
		echo json_encode($result);
	}else{
		echo 'No route with routID ' . $routeID . ' found';
	}

	

?>