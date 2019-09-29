<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	$vk_id = $_GET['vk_id'];
	if_create_user($vk_id, $dblink);
	$sql = "SELECT * FROM ivd_user where vk_id='$vk_id'";
	$raw = mysqli_query($dblink,$sql);
	while($row = mysqli_fetch_assoc($raw)){
		$result = [
			'balance' => $row['balance'],
			'level' => $row['level'],
		];
	}
	echo json_encode($result);