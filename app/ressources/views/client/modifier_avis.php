<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/classes/Avis.php';

if (!isset($_GET['id'])) {
    echo "Avis introuvable";
    exit;
}

$id_avis = $_GET['id'];


$avis = Avis::getAvisParId($conn, $id_avis);

if (!$avis) {
    echo "Accès interdit ou avis inexistant";
    exit;
}

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['note']);
    $description = trim($_POST['description']);
$avis=new Avis($note,$description,"1");
    if ($avis->modifierAvis($conn, $id_avis)) {
        header('Location: mes_avis.php');
        exit;
    } else {
        $success = "Erreur lors de la modification";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier avis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">

<main class="max-w-xl mx-auto px-6 py-20">
    <div class="bg-white p-10 rounded-[2rem] shadow border">

        <h1 class="text-3xl font-black mb-6">Modifier votre avis</h1>

        <?php if ($success): ?>
            <p class="text-red-500 mb-4 font-bold"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST" class="space-y-6">

    
            <div>
                <label class="block font-bold text-gray-600 mb-2">Note (1 à 5)</label>
                <input type="number"
                       name="note"
                       min="1"
                       max="5"
                       value="<?= $avis['note'] ?>"
                       class="w-24 p-3 rounded-xl border bg-gray-50 font-bold text-center">
            </div>

            <div>
                <label class="block font-bold text-gray-600 mb-2">Description</label>
                <textarea name="description"
                          rows="4"
                          class="w-full p-4 rounded-xl border bg-gray-50 focus:ring-2 focus:ring-indigo-500"><?= $avis['content'] ?></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold hover:bg-indigo-500 transition">
                Modifier l’avis
            </button>

        </form>
    </div>
</main>

</body>
</html>
