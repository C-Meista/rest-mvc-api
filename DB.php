<?php
    class DB{
        public static $connection;

        public static function connect(){
            try{
                static::$connection = new PDO("mysql:host=127.0.0.1;port=3306;dbname=db_MVC", "root", "");
            } catch (PDOException $e){
                die("DB-ERROR: " . $e->getMessage());
            }
        }
    }
?>