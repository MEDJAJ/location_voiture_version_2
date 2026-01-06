<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/vehicule.php';
require_once '../../../includes/classes/Categorie.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: vehicules.php');
    exit;
}

$id = (int) $_GET['id'];


$vehicule = Vehicle::getById($conn, $id);
$categories = Categorie::getNamesC($conn);

if (!$vehicule) {
    echo "Véhicule introuvable";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modele = $_POST['modele'];
    $marque = $_POST['marque'];
    $prix = $_POST['prix'];
    $disponibilite = $_POST['disponible'];
    $id_categorie = $_POST['categorie'];

   
    $imageName = $vehicule['image'];

  
    if (!empty($_FILES['image']['name'])) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . '.' . $extension;
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../../../assets/uploads/" . $imageName
        );
    }


    Vehicle::modifierVehicule( 
        $conn,
        $id,
        $modele,
        $marque,
        $disponibilite,
        $id_categorie,
        $imageName,
        $prix
    );

    header('Location: vehicules.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Véhicule</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-3xl p-8 rounded-2xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6 text-slate-800">
        Modifier le véhicule
    </h2>

    <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">

  
        <div>
            <label class="text-sm font-semibold">Modèle</label>
            <input name="modele" value="<?= htmlspecialchars($vehicule['modele']) ?>"
                   class="w-full border p-3 rounded-xl">
        </div>

     
        <div>
            <label class="text-sm font-semibold">Marque</label>
            <input name="marque" value="<?= htmlspecialchars($vehicule['marque']) ?>"
                   class="w-full border p-3 rounded-xl">
        </div>

    
        <div>
            <label class="text-sm font-semibold">Prix journalier (€)</label>
            <input name="prix" type="number" value="<?= $vehicule['prix'] ?>"
                   class="w-full border p-3 rounded-xl">
        </div>

      
        <div>
            <label class="text-sm font-semibold">Disponibilité</label>
            <select name="disponible" class="w-full border p-3 rounded-xl">
                <option value="1" <?= $vehicule['disponibilite'] == 1 ? 'selected' : '' ?>>
                    Disponible
                </option>
                <option value="0" <?= $vehicule['disponibilite'] == 0 ? 'selected' : '' ?>>
                    Indisponible
                </option>
            </select>
        </div>

      
        <div>
            <label class="text-sm font-semibold">Catégorie</label>
            <select name="categorie" class="w-full border p-3 rounded-xl">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id_categorie'] ?>"
                        <?= $cat['id_categorie'] == $vehicule['id_categorie'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

   
        <div>
            <label class="text-sm font-semibold">Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded-xl">
        </div>

       
        <div class="md:col-span-2 flex justify-between mt-6">
            <a href="vehicules.php"
               class="bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-bold">
                Annuler
            </a>

            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700">
                Enregistrer
            </button>
        </div>

    </form>
</div>

</body>
</html>
