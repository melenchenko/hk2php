<?php
require_once 'config.php';
	header('Access-Control-Allow-Origin: *');
	$vk_id = $_GET['vk_id'];
	if_create_user($vk_id, $dblink);
	$gender = $_GET['gender'];
	$sql = "UPDATE ivd_user SET gender='$gender' WHERE vk_id='$vk_id'";
	if ($gender !== '') mysqli_query($dblink,$sql);
	$speak_english = $_GET['speak_english'];
	$sql = "UPDATE ivd_user SET speak_english='$speak_english' WHERE vk_id='$vk_id'";
	if ($speak_english !== '') mysqli_query($dblink,$sql);
	$cloth_size = $_GET['cloth_size'];
	$sql = "UPDATE ivd_user SET cloth_size='$cloth_size' WHERE vk_id='$vk_id'";
	if ($cloth_size !== '') mysqli_query($dblink,$sql);
