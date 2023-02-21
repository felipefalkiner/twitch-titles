<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stream Title</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Edit Stream Title</h1>
<?php
    $userId = isset($_GET['userId']) ? $_GET['userId'] : '';
    require_once 'functions.php';
    require_once 'database.php';
    $connect = Database::createConnection();
    if($userId == '')
        error();
    else
        $query = "SELECT * FROM `twitch-titles` WHERE `user_id` = '$userId'";
    
    $doQuery = mysqli_query($connect, $query);
    $result = mysqli_fetch_array($doQuery);

    $userLogin = $result['user_login'];
    $userId = $result['user_id'];
    $title = $result['title'];
?>
    <div class="matchBox">
    <form action="edit-title-save.php" method="post">

    <?php
        echo "<p>User: $userLogin</p>";
        echo "<span>User ID:</span> <input name='user_id' type='text' value='$userId' readonly><br><br>";
        echo "<span>Title:</span> <br> <input name='title' type='text' maxlength='140' size='140' value='$title'><br><br>";
    ?>

    <input type="submit" value="Save Match">
</form>
</div>

</body>
</html>