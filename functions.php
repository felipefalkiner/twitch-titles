<?php

require_once 'config.php';

function error(){
    echo "Something went wrong, try again :(<br>";
    echo "<a href='index.php'>Return</a>";
    die();
}


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

function returnChannelData($userId, $accessToken) {

    $clientId = TWITCH_CLIENT_ID;
	
	$url = "https://api.twitch.tv/helix/channels?broadcaster_id=$userId";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $clientId","Authorization: Bearer $accessToken"));
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	$array = json_decode($result, true);
	return $array;

}

function checkIfChannelAlreadyExists($userId){
    global $connect;

    $query = "SELECT 1 from `twitch-titles` where user_id = '$userId'";
    $query = mysqli_query($connect, $query);
    $query = mysqli_fetch_array($query);

    if(is_null($query))
        return false;
    else
        return true;

}

function returnChannelList()
{
    global $connect;

    $query = "SELECT user_id FROM `twitch-titles`";
    $doQuerySQL = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $rows = array();
    while ($r = mysqli_fetch_assoc($doQuerySQL)) {
        $rows[] = $r;
    }
    return $rows;
}

function newToken() {

	$clientId = TWITCH_CLIENT_ID;
	$clientSecret = TWITCH_CLIENT_SECRET;

	$url = 'https://id.twitch.tv/oauth2/token';
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, "client_id=$clientId&client_secret=$clientSecret&grant_type=client_credentials");
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $ch );
	$response = json_decode($response, true);
	
	return $response["access_token"];
}

function testToken($token) {
	
	global $client_id;
	
	$testChannel = "gaules";
	
	$url = "https://api.twitch.tv/helix/streams?user_login=$testChannel";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $client_id","Authorization: Bearer $token"));
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	$array = json_decode($result, true);
	return array_key_exists('data', $array);
}

function returnServerToken(){

	global $connect;

	$query = "SELECT `token` FROM `twitch-credentials` where `id` = '1';";
	$query = mysqli_query($connect, $query);
	$result = mysqli_fetch_array($query);
	$token = $result['token'];

	if (!testToken($token)){
		$token = newToken();
		$queryUpdateToken = "UPDATE `twitch-credentials` SET `token` = '$token' WHERE `twitch_credentials`.`id` = 1;";
		mysqli_query($connect, $queryUpdateToken);
	}

	return $token;
}

function compareTitles($userId, $apiTitle) {

	global $connect;

	$query = "SELECT `title` FROM `twitch-titles` where `user_id` = '$userId';";
	$query = mysqli_query($connect, $query);
	$result = mysqli_fetch_array($query);
	$dbTitle = $result['title'];

	if ($apiTitle != $dbTitle) {
		$queryUpdateTitle = "UPDATE `twitch-titles` SET `title` = '$apiTitle' WHERE `twitch-titles`.`user_id` = $userId;";
		mysqli_query($connect, $queryUpdateTitle);
	}
}

function startTable(){
	echo "<table border='1'>";
	echo "<tbody>";
}

function createTableRow3($field1, $field2, $field3) {
	echo "<tr>";
	echo "<td>$field1</td>";
	echo "<td>$field2</td>";
	echo "<td>$field3</td>";
	echo "</tr>";
}

function stopTable(){
	echo "</tbody>";
	echo "</table>";
}