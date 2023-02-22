<?php
    require_once 'database.php';
    require_once 'functions.php';
    $connect = Database::createConnection();

    $userId = $_POST['user_id'];
    $title = $_POST['title'];

    $tokens = getUserTokensFromDb($userId);

    $accessToken = $tokens['access_token'];
    $refreshToken = $tokens['refresh_token'];

    if(!validateUserToken($accessToken, $refreshToken)){
        $tokens = getUserTokensFromDb($userId);
        $accessToken = $tokens['access_token'];
        $refreshToken = $tokens['refresh_token'];
        echo "Token invalido - gerando novos";
    } else 
        echo "Token valido!";

    $response = updateTitle($userId, $accessToken, $title);

    if($response == 204)
        header('Location: list-channels.php');
    else
        error();
?>