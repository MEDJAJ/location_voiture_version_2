

<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/theme.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;

if($id==0){
die("cette id not introvable");
}

$theme = Theme::getThemeParId($conn, $id);
if (!$theme) {
    die("Theme non trouvée");
}


if (isset($_POST['modifier'])) {
   $nom=trim($_POST['nom']);
   $description=trim($_POST['description']);
    $res = new Theme($nom,$description,$id);
   if( $res->modifierTheme($conn)){
     header("Location: theme.php");
      exit;
   }else{
die('cette operation echoué pou modifier cette theme');
   }

   
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Theme</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<form method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Modifier Theme</h2>

    <label class="block mb-2 font-semibold">Nom</label>
    <input type="text" name="nom" value="<?= $theme->getNom() ?>" required class="w-full p-3 rounded-xl border border-gray-300 mb-4">

    <label class="block mb-2 font-semibold">Description</label>
    <textarea name="description"  name="description" rows="3" class="w-full p-3 rounded-xl border border-gray-300 mb-4"><?= $theme->getDescription() ?></textarea>

    <button name="modifier" type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition">Enregistrer les modifications</button>
</form>

</body>
</html>
