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
    
}