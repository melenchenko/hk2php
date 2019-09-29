<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
require_once 'vendor/autoload.php';

const SERVICE_KEY = "af89d42baf89d42baf89d42b80afe4c884aaf89af89d42bf207b15e7147c82b4206cf3d";

function get_from_vk($id) {
	$vk = new VK\Client\VKApiClient();
	$response = $vk->users()->get(SERVICE_KEY, [
		'user_ids'  => [$id], 'fields' => ['city', 'photo'],
	]);
	return $response;
}

function get_token($from_id) {
	$oauth = new VK\OAuth\VKOAuth();
	$client_id = '7150767';
	$redirect_uri = 'https://lastweb.ru/stubs/hk2/vk.php';
	$display = VK\OAuth\VKOAuthDisplay::PAGE;
	$scope = [VK\OAuth\Scopes\VKOAuthUserScope::WALL, VK\OAuth\Scopes\VKOAuthUserScope::GROUPS];
	$state = 'secret_state_code';
	$revoke_auth = true;

	$browser_url = $oauth->getAuthorizeUrl(VK\OAuth\VKOAuthResponseType::TOKEN, $client_id, $redirect_uri, $display, $scope, $state, null, $revoke_auth);
	return $browser_url;
}
//echo get_token(455172878);
function create_chat($ids, $from_id, $access_token) {
	$vk = new VK\Client\VKApiClient();
	$response = $vk->messages()->createChat($access_token, [
		'user_ids'  => $ids, 'title' => 'Chat',
	]);
	return $response;
}

function send_message($ids, $from_id, $message, $access_token) {
	foreach ($ids as $id) {
		$vk = new VK\Client\VKApiClient();
		$response = $vk->messages()->send($access_token, [
			'user_id'  => $id, 'message' => $message
		]);
	}
	return $response;
}
