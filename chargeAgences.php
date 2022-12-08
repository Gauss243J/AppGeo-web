<?php
// On autorise les requêtes Ajax pour toutes les sources
require_once("connection/Contodb.php");
header('Access-Control-Allow-Origin: *');

// On vérifie qu'on utilise la méthode GET
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Ici on utilise la méthode GET
    // On se connecte à la base
    $connection7 = new Connection1();
    $db = $connection7->getConnection1();
    // // On récupère les données dans la base
    
    $sql = "SELECT id, nom, lat, lon, ( 6371 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(:lon) ) + sin( radians(:lat) ) * sin( radians( lat ) ) ) ) AS distance FROM `agences` HAVING distance < :distance ORDER BY distance";

    $query = $db->prepare($sql);

    $query->bindValue(':lat', $_GET['lat'], PDO::PARAM_STR);
    $query->bindValue(':lon', $_GET['lon'], PDO::PARAM_STR);
    $query->bindValue(':distance', $_GET['distance'], PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll();

    // // On envoie le code de confirmation
    http_response_code(200);

    // // On envoie les données en json
    echo json_encode($result);

    // On se déconnecte de la base
   // require_once('close.php');
}else{
    http_response_code(405);
    echo 'La méthode n\'est pas autorisée';
}