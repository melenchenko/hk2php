<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	$vk_id = $_GET['vk_id'];
	$id = if_create_user($vk_id, $dblink);
	$title = $_GET['title'];
	$description = $_GET['description'];
	$reward = $_GET['reward'];
	$sql = "INSERT INTO ivd_quest (`created_by_id`, `title`, `description`, `reward`) VALUES ('$id', '$title', '$description', '$reward')";
	$role1 = $_GET['role1'];
	$roledesc1 = $_GET['roledesc1'];
	$rolecount1 = $_GET['rolecount1'];
	$role2 = $_GET['role2'];
	$roledesc2 = $_GET['roledesc2'];
	$rolecount2 = $_GET['rolecount2'];
	$role3 = $_GET['role3'];
	$roledesc3 = $_GET['roledesc3'];
	$rolecount3 = $_GET['rolecount3'];
	mysqli_query($dblink,$sql);
	$quest_id = mysqli_insert_id($dblink);
	if ($role1 !== '') {
		$sql = "INSERT INTO ivd_role (`title`, `description`, `quest_id`, `need_users`) VALUES ('$role1', '$roledesc1', '$quest_id', '$rolecount1')";
		mysqli_query($dblink,$sql);
	}
	if ($role2 !== '') {
		$sql = "INSERT INTO ivd_role (`title`, `description`, `quest_id`, `need_users`) VALUES ('$role2', '$roledesc2', '$quest_id', '$rolecount2')";
		mysqli_query($dblink,$sql);
	}
	if ($role3 !== '') {
		$sql = "INSERT INTO ivd_role (`title`, `description`, `quest_id`, `need_users`) VALUES ('$role3', '$roledesc3', '$quest_id', '$rolecount3')";
		mysqli_query($dblink,$sql);
	}
	echo json_encode(['id' => $quest_id]);