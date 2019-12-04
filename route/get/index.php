<?php
	require_once 'Database.php';
  
	$database = new Database();
	$db = $database->getConnection();
  
	if (!isset($_POST['boebotID'])) {
		echo 'Error, no boebotID set';
		return;
	}
  
	$boebotID = $_POST['boebotID'];
  
	$stmt = $db->prepare('SELECT * FROM Route WHERE boebotID = :boebotID && status = :status');
	$stmt->bindParam(':boebotID', $boebotID);
	$stmt->bindParam(':status', 'start');
	$stmt->execute();
  
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
	if($result){
		echo json_encode($result);
	}else{
		echo "{'route' : 'null'}";
	}
  
?>
