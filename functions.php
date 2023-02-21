<?php

require_once 'config.php';

function getUserTokens($code) {

    $clientId = TWITCH_CLIENT_ID;
    $clientSecret = TWITCH_CLIENT_SECRET;
    $redirectUri = TWITCH_REDIRECT_URI;

	$url = "https://id.twitch.tv/oauth2/token";
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, "client_id=$clientId&client_secret=$clientSecret&code=$code&grant_type=authorization_code&redirect_uri=$redirectUri");
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $ch );
	$response = json_decode($response, true);
	
	return $response;
}

function getChannelInformation($accessToken){
    
    $clientId = TWITCH_CLIENT_ID;
	
	$url = "https://api.twitch.tv/helix/users";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $clientId","Authorization: Bearer $accessToken"));
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	$array = json_decode($result, true);
	return $array;
}

function returnChannelData($broadcasterId, $accessToken) {

    $clientId = TWITCH_CLIENT_ID;
	
	$url = "https://api.twitch.tv/helix/channels?broadcaster_id=$broadcasterId";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $clientId","Authorization: Bearer $accessToken"));
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	$array = json_decode($result, true);
	return $array;

}