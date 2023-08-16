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
    $userLogin = isset($_GET['userLogin']) ? $_GET['userLogin'] : '';
    $online = isset($_GET['online']) ? filter_var($_GET['online'], FILTER_VALIDATE_BOOLEAN) : '';
    require_once 'functions.php';
    require_once 'database.php';
    $connect = Database::createConnection();
    if($userLogin == '')
        error();
    else
        $query = "SELECT * FROM `twitch-titles` WHERE `user_login` = '$userLogin'";
    
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
        echo "<span>Title:</span> <br>";
        echo "<input name='title' type='text' maxlength='140' size='140' value='$title'><br>";
        
        if($online == false)
            echo "Couldn't retreive title from Twitch, the information above may not be the current Channel Title!";
        
        echo "<br><br>";
    ?>
    
    <input type="submit" value="Change Title">
</form>
</div>

</body>
</html>