<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitch Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Grant Channel Access:</h1>
    <?php
        require_once('config.php');
        $clientId = TWITCH_CLIENT_ID;
        $redirectUri = TWITCH_REDIRECT_URI;
        $scopes = TWITCH_SCOPES;
        echo "<a href='https://id.twitch.tv/oauth2/authorize?response_type=code&client_id=$clientId&redirect_uri=$redirectUri&scope=$scopes'><h2>Connect with Twitch</h2></a>";

    ?>
</body>
</html>