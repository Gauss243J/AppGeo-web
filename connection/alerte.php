
<?php
require_once("/contodb.php");

class register{   
    function startInsert() {
         $connection = new Connection1();
         $conn1 = $connection->getConnection1();
         $response1=array();
         $respect= array();
        
        $idCitoyen = $_POST['idCitoyen'];
        $accuseReception = 0;
    
        try{
           if(isset($idCitoyen)){
                $result = "INSERT INTO alerte
                (idCitoyen, accuseReception)
                VALUES ('$idCitoyen','$accuseReception')";
                $conn1->exec($result);
              }

        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
 
        if ($result) {
        $req = $conn1->prepare("SELECT idAlerte,accuseReception FROM alerte WHERE idCitoyen = :idCitoyen ORDER BY idAlerte DESC LIMIT 1");
        $req->bindValue(':idCitoyen',$idCitoyen, PDO::PARAM_STR);
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


 

