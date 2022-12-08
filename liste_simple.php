<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$db_name = "appgeo";
$username = "root";
$password = "";
try{
    $db = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $db->exec("set names utf8");
}catch(PDOException $exception){
    echo "Erreur de connexion : " . $exception->getMessage();
}

$sql = "SELECT * FROM agences";
$query = $db->prepare("SELECT idCitoyen,
 (SELECT nom FROM citoyen WHERE citoyen.idCitoyen = alerte.idCitoyen) as 'nom',
 (SELECT numeroPhone FROM citoyen WHERE citoyen.idCitoyen = alerte.idCitoyen) as 'numeroPhone',
 (SELECT photo FROM citoyen WHERE citoyen.idCitoyen = alerte.idCitoyen) as 'photo',
 (SELECT idAdresse FROM adresse WHERE adresse.idCitoyen = alerte.idCitoyen) as 'idAdresse',
(SELECT commune FROM adresse WHERE adresse.idCitoyen = alerte.idCitoyen) as 'commune',
(SELECT quartier FROM adresse WHERE adresse.idCitoyen = alerte.idCitoyen) as 'quartier',
(SELECT avenue FROM adresse WHERE adresse.idCitoyen = alerte.idCitoyen) as 'avenue',
(SELECT numero FROM adresse WHERE adresse.idCitoyen = alerte.idCitoyen) as 'numero',
(SELECT idCoordoGeo FROM coordogeo,adresse WHERE coordogeo.idAdresse = adresse.idAdresse and adresse.idCitoyen = alerte.idCitoyen) as 'idCoordoGeo',
(SELECT longitude FROM coordogeo,adresse WHERE coordogeo.idAdresse = adresse.idAdresse and adresse.idCitoyen = alerte.idCitoyen) as 'longitude',
(SELECT latitude FROM coordogeo,adresse WHERE coordogeo.idAdresse = adresse.idAdresse and adresse.idCitoyen = alerte.idCitoyen) as 'latitude',
alerte.idAlerte FROM alerte WHERE alerte.accuseReception = 0 "); 


///$user=$req->fetchAll(PDO ::FETCH_ASSOC);



// On exécute la requête
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $agen = [
        "idCitoyen" => $idCitoyen,
        "nom" => $nom,
        "numeroPhone" => $numeroPhone,
        "photo" => $photo,
        "idAdresse" => $idAdresse,
        "commune" => $commune,
        "quartier" => $quartier,
        "avenue" => $avenue,  
        "numero" => $numero,
        "idCoordoGeo"=> $idCoordoGeo,
        "longitude" => $longitude,
        "latitude"=> $latitude,
        "idAlerte"=> $idAlerte,
    ];

    $tableauAgences['agences'][] = $agen;
}

// On encode en json et on envoie
echo json_encode($tableauAgences);
