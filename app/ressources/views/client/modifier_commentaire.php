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


$commentaireData = Commentaire::getCommentaireById($conn,$id_commentaire);

if (!$commentaireData) {
    die("Commentaire introuvable");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu']);

    if (empty($contenu)) {
        $error = "Le commentaire ne peut pas être vide";
    } else {
        $commentaire = new Commentaire($contenu, $id_commentaire);
        if ($commentaire->modifierCommentaire($conn)) {
            header("Location: articles.php?id=".$_GET['id_theme'].'&nom_theme='.$_GET['nom_theme']);
            exit;
        } else {
            $error = "Erreur lors de la modification";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier commentaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-2xl shadow-md w-full max-w-md">
    <h2 class="text-xl font-bold mb-4">Modifier le commentaire</h2>

    <?php if (!empty($error)): ?>
        <p class="text-red-500 text-sm mb-3"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <textarea name="contenu"
                  class="w-full p-4 rounded-xl bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none"
                  rows="4"><?= htmlspecialchars($commentaireData['contenu']) ?></textarea>

        <div class="flex justify-end gap-3 mt-4">
            <a href="javascript:history.back()"
               class="px-4 py-2 bg-gray-200 rounded-xl text-sm font-bold">
                Annuler
            </a>
            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-xl text-sm font-bold">
                Modifier
            </button>
        </div>
    </form>
</div>

</body>
</html>
