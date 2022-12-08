<?php

define('UPLOAD_PATH', '/uploads/');

class Connection2{
    function getConnection2(){
        $host       = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "image";
        try{
            $conn2    = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn2;
        }catch (PDOException $e){
            echo "ERROR CONNECTIONF : " . $e->getMessage();
        }
    }
}






