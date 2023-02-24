<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitch Titles - Admin - List Channels</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<h1>List of Registered Online Channels</h1>
<h2>(It may takes sometime to update<br>the title here, this is Twitch API's cache!)</h2>
<h2>(If a channel is not show here, but it's live<br>it's Twitch's API fault! Try <a href="list-channels.php">here</a> to edit!)</h2>
    <?php
        require_once 'functions.php';
        require_once 'database.php';

        $connect = Database::createConnection();
        $userLogins = returnChannelList2();
        $clientId = TWITCH_CLIENT_ID;

        $token = returnServerToken();

        $url = "https://api.twitch.tv/helix/streams?";

        // this will not work for more than 100 channels
        foreach($userLogins as $userLogin) {
            $id = $userLogin;
            if($id != "")
                $url = $url."user_login=$id&";
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $clientId","Authorization: Bearer $token"));
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        $array = json_decode($result, true);

        if(count($array['data']) == 0) {
            echo "<h2>No channels live!</h2>";
            die();
        }

        startTable();
        createTableRow3("Channel Name", "Stream Title", "Control");

        foreach($array['data'] as $user) {
            $userId = $user['user_id'];
            $apiTitle = $user['title'];
            $username = $user['user_name'];
            $userLink = "<a href='https://twitch.tv/$username'>$username</a>";
            $editUrl = createEditButton($userId, true);
            compareTitles($userId, $apiTitle);
            createTableRow3($userLink, $apiTitle, $editUrl);
        }   

        stopTable();

    ?>
</body>
</html>