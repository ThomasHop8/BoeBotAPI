<?php
	require_once '../../Database.php';

	$dbInstance = Database::getInstance();
	$db = $dbInstance->getConnection();

	if (!isset($_POST['boebotID'])) {
		echo 'Error, no boebotID set';
		return;
	}

	$boebotID = $_POST['boebotID'];


	$stmt = $db->prepare('SELECT * FROM route WHERE boebotID = :boebotID AND status = :status');
	$stmt->bindValue(':boebotID', $boebotID);
	$stmt->bindValue(':status', 'START');
	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

	if($result){
		echo json_encode($result);
	}else{
		echo '{"route" : "null"}';
	}

?>
