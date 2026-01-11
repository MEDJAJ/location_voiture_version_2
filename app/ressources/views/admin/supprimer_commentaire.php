<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/commentaire.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;

if($id==0){
    die("cette id introvable");
}

if(Commentaire::supprimerCommentaire($conn,$id)){
    header('Location: gestion_commentaire.php');
    exit;
}

?>