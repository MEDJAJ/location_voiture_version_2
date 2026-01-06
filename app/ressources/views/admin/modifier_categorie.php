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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $imageName = $cat['image']; 

    if (!empty($_FILES['image']['name'])) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . '.' . $extension;
        move_uploaded_file($_FILES['image']['tmp_name'], "../../../assets/uploads/".$imageName);

       
        if (!empty($cat['image']) && file_exists('../../../assets/uploads/'.$cat['image'])) {
            unlink('../../../assets/uploads/'.$cat['image']);
        }
    }
$categorie=new  Categorie($nom,$description,$status,$imageName);
    $categorie->modifierCategorie($conn, $id, $nom, $description, $status, $imageName);
    header('Location: categories.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<form method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Modifier Catégorie</h2>

    <label class="block mb-2 font-semibold">Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($cat['nom']) ?>" required class="w-full p-3 rounded-xl border border-gray-300 mb-4">

    <label class="block mb-2 font-semibold">Description</label>
    <textarea name="description" rows="3" class="w-full p-3 rounded-xl border border-gray-300 mb-4"><?= htmlspecialchars($cat['description']) ?></textarea>

    <label class="block mb-2 font-semibold">Statut</label>
    <select name="status" class="w-full p-3 rounded-xl border border-gray-300 mb-4">
        <option value="1" <?= $cat['status'] == 1 ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= $cat['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
    </select>

    <label class="block mb-2 font-semibold">Image</label>
    <?php if(!empty($cat['image'])): ?>
        <img src="<?= '../../../assets/uploads/'.$cat['image'] ?>" class="mb-4 w-32 h-32 object-cover rounded-xl">
    <?php endif; ?>
    <input type="file" name="image" class="mb-6">

    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition">Enregistrer les modifications</button>
</form>

</body>
</html>
