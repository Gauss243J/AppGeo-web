
<?php
require_once("/contodb.php");

class register{   
    function startInsert() {
         $connection = new Connection1();
         $conn1 = $connection->getConnection1();
         $response1=array();
        
        $idCitoyen =$_GET['idCitoyen'];
        $idAlerte =$_GET['idAlerte'];
       if (isset($idCitoyen) && isset($idAlerte)) {

        $req = $conn1->prepare("SELECT idAlerte,accuseReception FROM alerte WHERE idCitoyen = :idCitoyen and idAlerte = :idAlerte ORDER BY idAlerte DESC");
        $req->bindValue(':idCitoyen',$idCitoyen, PDO::PARAM_STR);
        $req->bindValue(':idAlerte',$idAlerte, PDO::PARAM_STR);
        $req->execute();
        $user=$req->fetchAll(PDO ::FETCH_ASSOC);
        $req->closeCursor();
    }
         if ($user==0)
        {
       $response1 = $user ;
       }  
      else {
       
            $response1 = $user ;
      
       }  

       echo json_encode($response1);
}
}
$insert1 = new register();
$insert1->startInsert();;


 

