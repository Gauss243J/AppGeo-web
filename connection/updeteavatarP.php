<?php

class FileHandler1
{

    private $con;

    public function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';

        $db = new DbConnect();
        $this->con = $db->connect();
    }


    public function saveFile($file, $extension, $desc,$id2)
    {
        $name =round(microtime(true) * 1000) . '.' . $extension;
        $filedest = dirname(__FILE__) . UPLOAD_PATH . $name;
       move_uploaded_file($file, $filedest);
        $absurl ='http://'.gethostbyname(gethostname()).'/AppGeo'.'/connection'.UPLOAD_PATH.$name;
       $stmt = $this->con->prepare("UPDATE citoyen SET photo = ? WHERE idCitoyen = ? ");
       $stmt->bind_param("si", $absurl ,$id2);
       $stmt->execute();
       
        if ($stmt)
        {

           return $this->getAllFiles($id2);
        }

    }

    public function getAllFiles($id21)
    {
        $stmt = $this->con->prepare("SELECT idCitoyen , photo FROM citoyen WHERE idCitoyen = ?");
        $stmt->bind_param("i",$id21);
        $stmt->execute();
        $stmt->bind_result($id,$image);

        $images1 = array();

        while ($stmt->fetch()) {
          $temp = array();
          $temp['idCitoyen'] = $id;
           $temp['photo'] = $image;
          array_push($images1, $temp);
        }

        return $images1;
    }

}
