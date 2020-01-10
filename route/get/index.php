<?php
	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	if (!isset($_POST['boebotID'])) {
		echo 'Error, no boebotID set';
		return;
	}

	$boebotID = $_POST['boebotID'];

	if(isset($_POST['status'])) {
		$stmt = $db->prepare('SELECT * FROM route WHERE boebotID = :boebotID AND status = :status');
		$stmt->bindValue(':status', $_POST['status']);
	} else {
		$stmt = $db->prepare('SELECT * FROM route WHERE boebotID = :boebotID ORDER BY routeID DESC');
	}

	$stmt->bindValue(':boebotID', $boebotID);

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

	if($result){
		echo json_encode($result);
	}else{
		echo '{"route" : "null"}';
	}

?>
