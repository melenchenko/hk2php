<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	$sql = "SELECT vk_id, balance, level FROM ivd_user ORDER BY level DESC, balance DESC";
	$raw = mysqli_query($dblink,$sql);
	$i = 0;
	while($row = mysqli_fetch_assoc($raw)){
		$i++;
		$v = get_from_vk($row['vk_id']);
		$result[] = [
			'place' => $i,
			'vk_id' => $row['vk_id'],
			'balance' => $row['balance'],
			'level' => $row['level'],
			'_vk' => $v[0],
		];
	}
	echo json_encode($result);