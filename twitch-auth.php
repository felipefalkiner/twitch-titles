<?php

    function error(){
        echo "Something went wrong, try again :(<br>";
        echo "<a href='index.php'>Return</a>";
        die();
    }

    $code = isset($_GET['code']) ? $_GET['code'] : error();

    // TO-DOS
    // POST -> https://id.twitch.tv/oauth2/token -> get user access token and refresh token
    // GET ->  https://api.twitch.tv/helix/users -> get user information (channel name, id, etc)
    // Save to the database all the info we need it