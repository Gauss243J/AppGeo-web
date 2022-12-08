<?php

require_once("/Contodb.php");
class login{   
    function startlogin() {
         $connection4 = new Connection1();
         $conn1 = $connection4->getConnection1();
         $response1=array();
         $user = array();
        
        $nom =$_POST ['name'];
        $motdePass =$_POST['password'];

       $req = $conn1->prepare("SELECT nom FROM citoyen WHERE nom = :nom And motdePass = :motdePass");
     
       $req->bindValue(':nom',$nom, PDO::PARAM_STR);
       $req->bindValue(':motdePass',$motdePass, PDO::PARAM_STR);
       $req->execute();
       $user=$req->fetchAll(PDO ::FETCH_ASSOC);
       
       //$req->closeCursor();

      if (count($user)==0)
     {
        $response1['error']=TRUE;
     
       }  
      else {
        $response1['error']=FALSE;
     //   array_push($response1,$response2);
      
       }

            echo json_encode($response1);

        }
 }





$insert12 = new login();
$insert12->startlogin();;

 

