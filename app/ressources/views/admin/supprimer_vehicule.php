<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/vehicule.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: vehicules.php');
    exit;
}

$id = (int) $_GET['id'];

Vehicle::supprimerVehicule($conn, $id);

header('Location: vehicules.php');
exit;
?>