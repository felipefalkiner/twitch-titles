<?php

    // require_once "mysql.php";
    require_once "functions.php";

    function error(){
        echo "Something went wrong, try again :(<br>";
        echo "<a href='index.php'>Return</a>";
        die();
    }

    $code = isset($_GET['code']) ? $_GET['code'] : error();

    // TO-DOS
    // [X] POST -> https://id.twitch.tv/oauth2/token -> get user access token and refresh token
    // [ ] GET ->  https://api.twitch.tv/helix/users -> get user information (channel name, id, etc)
    // [ ] Save to the database all the info we need it

    $tokens = getUserTokens($code);

    if(array_key_exists('status', $tokens)){
        error();
    }

    $access_token = $tokens['access_token'];
    $refresh_token = $tokens['refresh_token'];
