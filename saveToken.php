<?php
require_once 'config.php';
header('Access-Control-Allow-Origin: *');
$vk_id = $_GET['vk_id'];
$id = if_create_user($vk_id, $dblink);
$access_token = $_GET['access_token'];
$sql = "UPDATE ivd_user SET access_token='$access_token' WHERE id=$id";
mysqli_query($dblink,$sql);
