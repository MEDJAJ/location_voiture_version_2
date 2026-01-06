<?php
require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Categorie.php';

if (!isset($_GET['id'])) {
    header('Location: categories.php');
    exit;
}

$id = (int)$_GET['id'];


$cat = Categorie::getById($conn, $id);
if ($cat && !empty($cat['image']) && file_exists('../../../assets/uploads/'.$cat['image'])) {
    unlink('../../../assets/uploads/'.$cat['image']);
}


Categorie::supprimerCategorie($conn, $id);

header('Location: categories.php');
exit;
