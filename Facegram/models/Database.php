<?php
class Database{
    private static $connection;
    public static function getConnection()
    {

        if (self::$connection === null) {
            $host = 'localhost';
            $username = 'franci';
            $password = 'franci1999';
            $database = 'exampleDB';
            
            self::$connection = new mysqli($host, $username, $password, $database);
            
            if(self::$connection->connect_errno){
                die('Database connection error: ' . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
    public static function query($sql) 
    {
        $connection = self::getConnection();
        return $connection->query($sql);
    }
   

}