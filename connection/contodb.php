<?php

class Connection1{
    function getConnection1(){
        $host       = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "AppGeo";
        try{
            $conn1    = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn1->exec("SET CHARACTER SET ut8");
            $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn1;
        }catch (PDOException $e){
            echo "ERROR CONNECTIONF : " . $e->getMessage();
        }
    }
}

