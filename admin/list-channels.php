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

    <?php
        require_once 'functions.php';
        require_once 'database.php';

        $connect = Database::createConnection();
        $usersIds = returnChannelList();
        $clientId = TWITCH_CLIENT_ID;

        $token = returnServerToken();

        $url = "https://api.twitch.tv/helix/streams?";

        // this will not work for more than 100 channels
        foreach($usersIds as $userId) {
            $id = $userId["user_id"];
            if($id != "")
                $url = $url."user_id=$id&";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $clientId","Authorization: Bearer $token"));
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        $array = json_decode($result, true);

        // var_dump($array);

        if(count($array['data']) == 0) {
            echo "No channels live!";
            die();
        }

        startTable();
        createTableRow3("Channel Name", "Stream Title", "Control");

        foreach($array['data'] as $user) {
            $userId = $user['user_id'];
            $apiTitle = $user['title'];
            $username = $user['user_name'];
            $editUrl = createEditButton($userId);
            compareTitles($userId, $apiTitle);
            createTableRow3($username, $apiTitle, $editUrl);
        }

        stopTable();

    ?>
</body>
</html>