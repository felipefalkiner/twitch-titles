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
<h1>List of Registered Channels</h1>
<h2>(It may takes sometime to update<br>the title here, this is Twitch API's cache!)</h2>
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

        $channels = [];

        foreach($array['data'] as $data)
        {   
            if(in_array($data['user_login'], $userLogins)){
                $addToArray = [$data['user_login'] => $data['title']];
                $channels += $addToArray;
            }
        }

        startTable();
        createTableRow3("Channel Name", "Stream Title", "Control");

        foreach($userLogins as $user) {
            
            $userLink = "<a href='https://twitch.tv/$user'>$user</a>";
            if(array_key_exists($user, $channels)){
                $apiTitle = $channels[$user];
                compareTitlesByUserLogin($user, $apiTitle);
                $editUrl = createEditButton($user, true);
            } else {
                $apiTitle = "Could not retrieve title, maybe channel is offline.";
                $editUrl = createEditButton($user, false);
            }      
            
            createTableRow3($userLink, $apiTitle, $editUrl);
        }

        

        stopTable();

    ?>
</body>
</html>