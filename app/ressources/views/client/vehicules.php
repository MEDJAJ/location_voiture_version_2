<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/vehicule.php';

$id = (int)($_GET['id'] ?? 0);
if ($id === 0) {
    die("ID catégorie invalide");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Véhicules</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50">

<main class="max-w-7xl mx-auto px-6 py-10">

<h2 class="text-3xl font-black mb-6">
    Catégorie : <span class="text-indigo-600"><?= htmlspecialchars($_GET['name'] ?? '') ?></span>
</h2>


<div class="flex gap-3 mb-6">
    <input id="marqueInput" type="text" placeholder="Marque..."
        class="px-4 py-2 border rounded-xl">

    <select id="disponibiliteSelect" class="px-4 py-2 border rounded-xl">
        <option value="">Tous</option>
        <option value="1">Disponible</option>
        <option value="0">Indisponible</option>
    </select>

    <button id="filterBtn"
        class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold">
        Filtrer
    </button>
</div>


<div id="vehiculeGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

</div>

</main>

<script>
let currentPage = 1;

function loadVehicules(page = 1) {
    currentPage = page;

    const marque = document.getElementById('marqueInput').value.trim();
    const dispo  = document.getElementById('disponibiliteSelect').value;
    const id     = <?= $id ?>;

    fetch(`vehicule_filter.php?id=${id}&page=${page}&marque=${marque}&disponibilite=${dispo}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('vehiculeGrid').innerHTML = html;
        });
}


loadVehicules();


document.getElementById('filterBtn').addEventListener('click', () => {
    loadVehicules(1);
});
</script>

</body>
</html>
