
<?php
require_once("/contodb.php");

class register{   
    function startInsert() {
         $connection = new Connection1();
         $conn1 = $connection->getConnection1();
         $response1=array();
         $respect= array();
        
        $name    =  $_POST['name'];
        $email   =  $_POST ['email'];
        $numerophone = $_POST['numerophone'];
        $password = $_POST['password'];
        $numcarte =$_POST['numcarte'];
    
        try{
            if(isset($name) 
                && isset($email)
                && isset($numerophone)
                && isset($password)  
                && isset($numcarte) ){
                $result = "INSERT INTO Citoyen
                 (nom, adresseMail,numeroPhone, motdePass,numeroCarte)
                 VALUES ('$name', '$email','$numerophone','$password','$numcarte')";
                $conn1->exec($result);
               }

        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
 
        if ($result) {
          

$req = $conn1->prepare("SELECT idCitoyen, nom, adresseMail,numeroPhone, motdePass,photo,numeroCarte FROM citoyen WHERE nom = :nom And motdePass = :motdePass ");

$req->bindValue(':nom',$name, PDO::PARAM_STR);
$req->bindValue(':motdePass',$password, PDO::PARAM_STR);

        $req->execute();
        $user=$req->fetchAll(PDO ::FETCH_ASSOC);
        $req->closeCursor();

         if ($user==0)
     {
       $response1['error'] = $user ;
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


 

