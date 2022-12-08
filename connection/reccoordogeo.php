<?php
require_once("/contodb.php");

class register{   
    function startInsert() {
         $connection = new Connection1();
         $conn1 = $connection->getConnection1();
         $response1=array();
         $respect= array();
        
        $idAdresse =$_POST['idAdresse'];
        $longitude =$_POST['longitude'];
        $latitude  =$_POST ['latutide'];
    
        try{
            if(isset($idAdresse) 
                && isset($latitude)
                && isset($longitude)){
                $result = "INSERT INTO coordogeo (longitude, latitude, idAdresse) VALUES ('$longitude','$latitude','$idAdresse')";
                $conn1->exec($result);
               }

        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
 
        if ($result) {
        $req = $conn1->prepare("SELECT idCoordoGeo,longitude, latitude FROM coordogeo WHERE idAdresse = :idAdresse ");
        $req->bindValue(':idAdresse',$idAdresse, PDO::PARAM_STR);
        $req->execute();
        $user=$req->fetchAll(PDO ::FETCH_ASSOC);
        $req->closeCursor();

         if ($user==0)
        {
       $response1['error'] = $user ;
       }  
      else {
       
            $response1 = $user ;
      
       }  

            echo json_encode($response1);
        
        } 

        else{}

}
}
$insert1 = new register();
$insert1->startInsert();;


 

