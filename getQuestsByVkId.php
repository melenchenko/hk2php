<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	$vk_id = $_GET['vk_id'];
	$user_id = if_create_user($vk_id, $dblink);
	$sql = "SELECT q.*, uq.status FROM ivd_quest q INNER JOIN ivd_userquest uq ON (q.id=uq.quest_id) INNER JOIN ivd_user u ON (u.id=uq.user_id) WHERE u.vk_id='$vk_id' OR q.created_by_id='$vk_id'";
	$raw = mysqli_query($dblink,$sql);
	while($row = mysqli_fetch_assoc($raw)){
		$result[] = [
			'id' => $row['id'],
			'title' => $row['title'],
			'is_own' => $row['created_by_id'] == $user_id ? 1 : 0,
			'status' => $row['status'],
		];
	}
	echo json_encode($result);