<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	//$vk_id = $_GET['vk_id'];
	$sql = "SELECT * FROM ivd_quest";
	$raw = mysqli_query($dblink,$sql);
	while($row = mysqli_fetch_assoc($raw)){
		//if (is_quest_available($row['id'], $vk_id, $dblink)) {
			$result[] = [
				'id' => $row['id'],
				'title' => $row['title'],
			];
		//}
	}
	echo json_encode($result);