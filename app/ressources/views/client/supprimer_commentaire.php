<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/classes/commentaire.php';

if (!isset($_SESSION['id_user'])) {
    die("Accès interdit");
}

$id_commentaire = $_GET['id'] ?? 0;

if (!$id_commentaire) {
    die("ID invalide");
}


$commentaireData = Commentaire::supprimerCommentaire($conn,$id_commentaire);

if (!$commentaireData) {
    die("supperition faild");
}

     header("Location: articles.php?id=".$_GET['id_theme'].'&nom_theme='.$_GET['nom_theme']);
       ?>