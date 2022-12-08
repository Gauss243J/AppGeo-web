<?php

require_once dirname(__FILE__) . '/connection/DbConnect.php';

$db = new DbConnect();
$con = $db->connect();
//$_GET['idAlerte']=29;
if (isset($_GET['idAlerte'])) {
       $accuseReception=1;
       $idAlerte=$_GET['idAlerte'];
       $stmt = $con->prepare("UPDATE alerte SET accuseReception = ? WHERE idAlerte = ? ");
       $stmt->bind_param("ii", $accuseReception ,$idAlerte);
       $stmt->execute();

    }
        ?>

       
