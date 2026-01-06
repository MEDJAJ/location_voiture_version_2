<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/reservation.php';


$id = $_GET['id'] ?? 0;
if ($id == 0) {
    die("ID de réservation introuvable");
}


$reservation = Reservation::getReservationParId($conn, $id);
if (!$reservation) {
    die("Réservation non trouvée");
}


if (isset($_POST['modifier'])) {
    $date_debut = $_POST['date_debut'];
    $date_fin   = $_POST['date_fin'];
    $lieu_prise = $_POST['lieu_prise'];
    $status     = $_POST['status'];

    $res = new Reservation($date_debut, $date_fin, $lieu_prise, $status);
    $res->modifierReservation($conn, $id);

    header("Location: reservations.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Réservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <form method="POST" class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-extrabold text-center mb-6 text-slate-800">
            Modifier la réservation
        </h2>

   
        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Date de début
            </label>
            <input type="date" name="date_debut"
                   value="<?= $reservation['dateDebut'] ?>"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

 
        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Date de fin
            </label>
            <input type="date" name="date_fin"
                   value="<?= $reservation['dateFin'] ?>"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

  
        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Lieu de prise
            </label>
            <input type="text" name="lieu_prise"
                   value="<?= $reservation['lieuPrise'] ?>"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

    
        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Statut
            </label>
            <select name="status"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="en attente"
                    <?= $reservation['status'] === 'en attente' ? 'selected' : '' ?>>
                    En attente
                </option>
                <option value="confirmée"
                    <?= $reservation['status'] === 'confirmée' ? 'selected' : '' ?>>
                    Confirmée
                </option>
            </select>
        </div>

   
        <div class="flex gap-3">
            <a href="reservations.php"
               class="w-1/2 text-center bg-slate-200 text-slate-700 py-2 rounded-lg font-semibold hover:bg-slate-300">
                Annuler
            </a>
            <button type="submit" name="modifier"
                class="w-1/2 bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700">
                Enregistrer
            </button>
        </div>

    </form>

</body>
</html>
