<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	$id = $_GET['id'];
	$vk_id = $_GET['vk_id'];
	$uid = if_create_user($vk_id, $dblink);
	$sql = "SELECT q.*,u.vk_id FROM ivd_quest q inner join ivd_user u on (u.id=q.created_by_id) where q.`id`=$id";
	$raw = mysqli_query($dblink,$sql);
	while($row = mysqli_fetch_assoc($raw)){
		$v = get_from_vk($row['vk_id']);
		$result = [
			'created_by' => $v[0],
			'title' => $row['title'],
			'description' => $row['description'],
			'id' => $row['id'],
			'created_by_id' => $row['created_by_id'],
		];
	}
	$admin_mode = $result['created_by_id'] == $uid ? 1 : 0;
	$sql = "SELECT * FROM ivd_user u LEFT JOIN ivd_userquest uq ON (u.id=uq.user_id) WHERE uq.quest_id='$id'";
	$users = [];
	$raw = mysqli_query($dblink,$sql);
	while($row = mysqli_fetch_assoc($raw)){
		$v = get_from_vk($row['vk_id']);
		$users[] = [
			'vk_id' => $row['vk_id'],
			'_vk' => $v[0],
		];
	}
	$sql = "SELECT r.* FROM ivd_role r WHERE r.quest_id='$id'";
	$roles = [];
	$raw = mysqli_query($dblink,$sql);
	while($row = mysqli_fetch_assoc($raw)){
		$title = $row['title'];
		if (!isset($roles[$title])) {
			$roles[$title] = [
				'desc' => $row['description'], 
				'need' => $row['need_users'],
				'users' => [],
			];
		}
		$sql1 = "SELECT DISTINCT u.vk_id FROM ivd_userquest uq INNER JOIN ivd_user u ON (uq.user_id=u.id) WHERE uq.role_id=" . $row['id'];
		$raw1 = mysqli_query($dblink,$sql1);
		while ($row1 = mysqli_fetch_assoc($raw1)) {
			$v = get_from_vk($row1['vk_id']);
			$roles[$title]['users'][] = [
				'vk_id' => $row1['vk_id'],
				'_vk' => $v[0],
			];
		}
	}
	$result = ['quest' => $result, 'users' => $users, 'admin_mode' => $admin_mode, 'roles' => $roles];
	echo json_encode($result);