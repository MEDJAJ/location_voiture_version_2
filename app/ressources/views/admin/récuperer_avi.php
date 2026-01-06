<?php

require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Avis.php';



$id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    echo "probleme de id introvable";
    exit;
}


if(Avis::voirAvi($conn,$id)){
    header('Location: avis.php');
exit;
}
echo "errore de supprimer de avis";





?>