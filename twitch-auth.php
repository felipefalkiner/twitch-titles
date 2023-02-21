<?php

    require_once "database.php";
    require_once "functions.php";

    $code = isset($_GET['code']) ? $_GET['code'] : error();

    // TO-DOS [COMPLETED]
    // [X] POST -> https://id.twitch.tv/oauth2/token -> get user access token and refresh token
    // [X] GET ->  https://api.twitch.tv/helix/users -> get user information (channel name, id, etc)
    // [X] Save to the database all the info we need it

    $tokens = getUserTokens($code);

    if(array_key_exists('status', $tokens)){
        error();
    }

    $accessToken = $tokens['access_token'];
    $refreshToken = $tokens['refresh_token'];

    $userInformation = getChannelInformation($accessToken);

    $userLogin = $userInformation['data'][0]['login'];
    $userId = $userInformation['data'][0]['id'];

    $channelData = returnChannelData($userId, $accessToken);

    $channelTitle = $channelData['data'][0]['title'];

    $connect = Database::createConnection();

    if (checkIfChannelAlreadyExists($userId)){
        echo "User already exists!<br>";
        echo "<a href='index.php'>Return</a>";
        die();
    }

    $query = "INSERT INTO `twitch-titles` (`id`, `user_login`, `user_id`, `access_token`, `refresh_token`, `title`) VALUES (NULL, '$userLogin', '$userId', '$accessToken', '$refreshToken', '$channelTitle')";

    mysqli_query($connect, $query);

    header("Location: user-added.php?userId=$userId");