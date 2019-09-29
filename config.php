<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
require_once 'vk.php';

$dbname = 'django';
$dbuser = 'django';
$dbip = '84.201.140.173';
$dbpass = '58lYS0ayAqs7W';

$dblink = mysqli_connect($dbip, $dbuser, $dbpass, $dbname);
$result = [];
mysqli_query($dblink, "set names utf8");

function if_create_user($vk_id, $dblink) {
	$sql = "SELECT * FROM ivd_user WHERE vk_id='$vk_id'";
	$raw = mysqli_query($dblink, $sql);
	if (!mysqli_num_rows($raw)) {
		mysqli_query($dblink, "INSERT INTO ivd_user (`vk_id`) VALUES ('$vk_id')");
		return mysqli_insert_id($dblink);
	} else {
		if ($row = mysqli_fetch_assoc($raw)) {
			return $row['id'];
		}
	}
}

function is_quest_available($quest_id, $vk_id, $dblink) {
	$uid = if_create_user($vk_id, $dblink);
	$sql = "SELECT * FROM ivd_userquest WHERE quest_id='$quest_id' AND user_id='$uid'";
	$raw = mysqli_query($dblink, $sql);
	return !mysqli_num_rows($raw);
}

function check_access($id, $quest_id, $dblink) {
	$sql = "SELECT * FROM ivd_quest WHERE created_by_id='$id' AND id='$quest_id'";
	$raw = mysqli_query($dblink, $sql);
	return !mysqli_num_rows($raw);
}