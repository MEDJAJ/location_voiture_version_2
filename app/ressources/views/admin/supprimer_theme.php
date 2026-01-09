<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/theme.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;

if($id==0){
die("cette id not introvable");
}

if(Theme::supprimerTheme($conn,$id)){
    header('Location: theme.php');
}else{
    die('cette operation pour supprimer cette theme echoué');
}

?>