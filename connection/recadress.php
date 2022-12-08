
<?php
require_once("/contodb.php");

class register{   
    function startInsert() {
         $connection = new Connection1();
         $conn1 = $connection->getConnection1();
         $response1=array();
         $respect= array();
        
        $idCitoyen = $_POST['idCitoyen'];
        $commune   = $_POST['commune'];
        $quartier   =$_POST ['quartier'];
        $avenue =$_POST['avenue'];
        $numero =$_POST['numero'];
    
        try{
            if(isset($commune) 
                && isset($quartier)
                && isset($avenue)
                && isset($numero)
                && isset($idCitoyen)){
                $result = "INSERT INTO adresse
                 (commune, quartier ,avenue,numero,idCitoyen)
                 VALUES ('$commune','$quartier ','$avenue', '$numero','$idCitoyen')";
                $conn1->exec($result);
               }

        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
 
        if ($result) {
          

$req = $conn1->prepare("SELECT idAdresse,commune, quartier ,avenue,numero FROM adresse WHERE idCitoyen = :idCitoyen ");

   $req->bindValue(':idCitoyen',$idCitoyen, PDO::PARAM_STR);
        $req->execute();
        $user=$req->fetchAll(PDO ::FETCH_ASSOC);
        $req->closeCursor();

         if ($user==0)
     {
       $response1['error'] = $g ;
       // $response1['error'] = false;
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


 

