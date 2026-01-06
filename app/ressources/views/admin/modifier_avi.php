<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/Avis.php';


$id = $_GET['id'] ?? 0;
if ($id == 0) {
    die("ID de l'avis introuvable");
}


$avi = Avis::getAvisParId($conn, $id);
if (!$avi) {
    die("Avis non trouvé");
}


if (isset($_POST['modifier'])) {
    $note       = $_POST['note'];
    $content    = $_POST['content'];
    $deleted_at = $_POST['deleted_at']; 

   
   $avie=new Avis($note,$content,$deleted_at);
   if($avie->modifierAvis($conn,$id)){
    header("Location: avis.php");
       exit;
   }

  
 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Avis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

<form method="POST" class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

    

  
    <div class="mb-4">
        <label class="block text-sm font-bold text-slate-700 mb-1">Note globale</label>
        <select name="note" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
            <option value="5" <?= $avi['note']==5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐ (Excellent)</option>
            <option value="4" <?= $avi['note']==4 ? 'selected' : '' ?>>⭐⭐⭐⭐ (Très bien)</option>
            <option value="3" <?= $avi['note']==3 ? 'selected' : '' ?>>⭐⭐⭐ (Moyen)</option>
            <option value="2" <?= $avi['note']==2 ? 'selected' : '' ?>>⭐⭐ (Mauvais)</option>
            <option value="1" <?= $avi['note']==1 ? 'selected' : '' ?>>⭐ (Très mauvais)</option>
        </select>
    </div>

   
    <div class="mb-4">
        <label class="block text-sm font-bold text-slate-700 mb-1">Commentaire</label>
        <textarea name="content" rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"><?= htmlspecialchars($avi['content']) ?></textarea>
    </div>

  
    <div class="mb-6">
        <label class="block text-sm font-bold text-slate-700 mb-1">Statut</label>
        <select name="deleted_at" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
            <option value="1" <?= $avi['deleted_at']==1 ? 'selected' : '' ?>>Visible</option>
            <option value="0" <?= $avi['deleted_at']==0 ? 'selected' : '' ?>>Masqué</option>
        </select>
    </div>

  
    <div class="flex gap-3">
        <a href="avis.php" class="w-1/2 text-center bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300">
            Annuler
        </a>
        <button type="submit" name="modifier" class="w-1/2 bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700">
            Enregistrer
        </button>
    </div>

</form>

</body>
</html>
