<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/commentaire.php';

if (!isset($_GET['id'])) {
    die('ID manquant');
}

$id = (int) $_GET['id'];
$commentaire = Commentaire::getCommentaireById($conn, $id);

if (!$commentaire) {
    die('Commentaire introuvable');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu']);

    if (!empty($contenu)) {
        $com=new Commentaire($contenu,$id);
       $com->modifierCommentaire($conn, $id, $contenu);
        header('Location: gestion_commentaire.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Commentaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 flex items-center justify-center min-h-screen">

<form method="POST" class="bg-white p-8 rounded-2xl shadow-md w-full max-w-xl space-y-6">

    <h2 class="text-xl font-bold text-slate-800">Modifier le commentaire</h2>

    <textarea
        name="contenu"
        rows="6"
        class="w-full border border-slate-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-500 outline-none"
        required><?= htmlspecialchars($commentaire['contenu']) ?></textarea>

    <div class="flex justify-end gap-3">
        <a href="gestion_commentaire.php"
           class="px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-semibold">
           Annuler
        </a>

        <button type="submit"
                class="px-6 py-2 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700">
            Modifier
        </button>
    </div>

</form>

</body>
</html>
