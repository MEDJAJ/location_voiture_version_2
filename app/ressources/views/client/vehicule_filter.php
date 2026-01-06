<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/vehicule.php';

$id     = (int)($_GET['id'] ?? 0);
$page   = max((int)($_GET['page'] ?? 1), 1);
$limit  = 3;
$offset = ($page - 1) * $limit;

$marque = trim($_GET['marque'] ?? '');
$dispo  = $_GET['disponibilite'] ?? '';

if ($id === 0) exit;


$total = Vehicle::countVehiculesFilter($conn, $id, $marque, $dispo);
$totalPages = ceil($total / $limit);


$vehicules = Vehicle::getVehiculesFilterPaginated(
    $conn,
    $id,
    $marque,
    $dispo,
    $limit,
    $offset
);
?>

<?php foreach ($vehicules as $vehicule): ?>
    <?php if ($vehicule['disponibilite'] == 1): ?>
        <div class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500">
            <div class="relative h-60 overflow-hidden">
                <img src="<?= '../../../assets/uploads/'.$vehicule['image'] ?>"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                <span class="absolute top-5 right-5 bg-green-500 text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full shadow-lg">
                    Disponible
                </span>
            </div>

            <div class="p-8">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-2xl font-bold text-gray-800 tracking-tight">
                        <?= $vehicule['marque'] ?> --- <?= $vehicule['modele'] ?>
                    </h3>

                    <span class="text-xl font-black text-indigo-600 italic">
                        <?= $vehicule['prix'] ?>€
                        <span class="text-xs text-gray-400 font-normal">/j</span>
                    </span>
                </div>

                <a href="details.php?id=<?= $vehicule['id_vehicule'] ?>&id_c=<?= $id ?>"
                   class="block w-full text-center bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-indigo-600 transition-colors shadow-lg shadow-slate-200">
                    Détails & Réservation
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm opacity-75 grayscale">
            <div class="relative h-60 overflow-hidden">
                <img src="<?= '../../../assets/uploads/'.$vehicule['image'] ?>"
                     class="w-full h-full object-cover">

                <span class="absolute top-5 right-5 bg-red-500 text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full shadow-lg">
                    Indisponible
                </span>
            </div>

            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-800 tracking-tight mb-8">
                    <?= $vehicule['marque'] ?> --- <?= $vehicule['modele'] ?>
                </h3>

                <span class="text-xl font-black text-indigo-600 italic">
                    <?= $vehicule['prix'] ?>€
                    <span class="text-xs text-gray-400 font-normal">/j</span>
                </span>

                <button disabled
                        class="w-full mt-4 bg-gray-200 text-gray-500 py-4 rounded-2xl font-bold cursor-not-allowed">
                    Non disponible
                </button>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>


<div class="col-span-full flex justify-center mt-10 gap-2">
<?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <button onclick="loadVehicules(<?= $i ?>)"
        class="px-4 py-2 rounded-xl font-bold
        <?= $i == $page ? 'bg-indigo-600 text-white' : 'bg-gray-200 hover:bg-indigo-500 hover:text-white' ?>">
        <?= $i ?>
    </button>
<?php endfor; ?>
</div>
