<?php


require_once '../../../includes/config.php';
require_once '../../../includes/classes/Avis.php';

$id_avis=isset($_GET['id']) ? $_GET['id'] : 0;
if($id_avis==0){
    echo "cette id introvable";
    exit;
}

Avis::modifierdeleteAt($conn,$id_avis);

header('Location: mes_avis.php');
exit;