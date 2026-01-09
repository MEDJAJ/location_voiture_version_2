<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/tag.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;

if($id==0){
    die("cette id introvable");
}

if(Tag::supprimerTag($conn,$id)){
    header('Location: gestion_tags.php');
    exit;
}

?>