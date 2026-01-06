<?php


require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/reservation.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    echo "probleme de id introvable";
    exit;
}
$change=Reservation::changerStatusReservation($conn,$id);

header('Location: reservations.php');
exit;


?>