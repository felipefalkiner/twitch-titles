<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitch Login - User Added</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        require_once "database.php";
        require_once "functions.php";
        
        $userId = isset($_GET['userId']) ? $_GET['userId'] : error();

        $connect = Database::createConnection();
        $query = "SELECT `user_login` FROM `twitch-titles` where `user_id` = '$userId';";
        $query = mysqli_query($connect, $query);
        $result = mysqli_fetch_array($query);
        $userLogin = $result['user_login'];

        echo "<h1>User Added:<br>";
        echo "$userLogin</h1><br>";
        echo "<a href='index.php'>Return</a>";
    ?>
</body>
</html>