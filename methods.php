<?php
require_once 'config.php';
function startQuest($id, $quest_id, $dblink) {
	$sql = "INSERT INTO ivd_userquest (`status`,`user_id`,`quest_id`) VALUES (1,'$id','$quest_id')";
	mysqli_query($dblink,$sql);
}

function finishQuest($id, $quest_id, $dblink) {
	if check_access($id, $quest_id, $dblink) {
		$sql = "SELECT reward FROM ivd_quest WHERE id='$quest_id'";
		$raw = mysqli_query($dblink,$sql);
		$row = mysqli_fetch_assoc($raw);
		$reward = $row['reward'];
		$sql = "UPDATE ivd_userquest uq INNER JOIN ivd_user u ON (u.id=uq.user_id) SET uq.status=2, u.level=u.level+1, u.balance=u.balace+$reward WHERE uq.quest_id='$quest_id'";
		mysqli_query($dblink,$sql);
	}
}

header('Access-Control-Allow-Origin: *');
$vk_id = $_GET['vk_id'];
$id = if_create_user(($vk_id, $dblink);
$method = $_GET['method'];

if ($method == 'startQuest') {
	$result = startQuest($id, $quest_id, $dblink);
}
if ($method == 'finishQuest') {
	$result = finishQuest($id, $quest_id, $dblink);
}
	
echo json_encode($result);