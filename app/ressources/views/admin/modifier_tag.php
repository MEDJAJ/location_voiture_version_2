



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
    <h2 class="text-2xl font-bold mb-6">Modifier Tag</h2>

    <label class="block mb-2 font-semibold">Nom</label>
    <input type="text" name="nom" value="<?= $tag->getNomTag() ?>" required class="w-full p-3 rounded-xl border border-gray-300 mb-4">

   
    <button name="modifier" type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition">Enregistrer les modifications</button>
</form>

</body>
</html>
