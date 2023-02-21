<?php 
require_once("config.php");

class Database
{
    const HOST = MYSQL_HOST;
    const USER = MYSQL_USER;
    const PASSWORD = MYSQL_PASSWORD;
    const NAME = MYSQL_DATABASE;

    public static function checkIfMatchAlreadyExists($matchId)
    {
        $connect = self::createConnection();
        $strCount = "SELECT COUNT(*) AS 'total' FROM `registrokills` where `matchID` = '$matchId'";
        $query2    = mysqli_query($connect, $strCount);
        $row2      = mysqli_fetch_array($query2);
        $total    = $row2["total"];

        if ($total == 0)
            return false;
        else
            return true;
    }

    public static function createConnection()
    {
        $con = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::NAME);
        mysqli_set_charset($con, "utf8");

        return $con;
    }
}