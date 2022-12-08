<?php


require_once dirname(__FILE__).'/updeteavatarP.php';
/*$upload = new FileHandler1();
$file=1;
$extension=2;
$desc=12;
$id2=22;
echo json_encode($upload->saveFile($file, $extension,$desc,$id2));*/
$response = array();

if (isset($_GET['apicall'])) {
    switch ($_GET['apicall']) {
        case 'upload':

            if (isset($_POST['desc']) && strlen($_POST['desc']) > 0 && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload = new FileHandler1();

                $file = $_FILES['image']['tmp_name'];
                $id2=$_GET['id'];
                $desc = $_POST['desc'];
                

               if ($upload->saveFile($file, getFileExtension($_FILES['image']['name']), $desc,$id2)) {
                    $response=$upload->saveFile($file, getFileExtension($_FILES['image']['name']), $desc,$id2);
                }

            } else {
                $response;
   
            }

            break;

        case 'getallimages':
            $upload = new FileHandler1();
           $id22 = $_GET['id'];
            $response = $upload->getAllFiles($id22);

            break;
    }
}

else{
           //$id212 = 28;
           
          //$upload  =  new  FileHandler1();
         //$response=$upload->getAllFiles($id212);
        // $response['error']=false;

}

echo json_encode($response);

function getFileExtension($file)
{
    $path_parts = pathinfo($file);
    return $path_parts['extension'];
}