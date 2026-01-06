<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/classes/reservation.php';
require_once '../../../includes/classes/vehicule.php';
require_once '../../../includes/classes/Categorie.php';
require_once '../../../includes/classes/client.php';

$coun_v=Vehicle::countVehicule($conn);
$coun_v_disp=Vehicle::countVehiculeDisponble($conn);
$coun_v_indisp=Vehicle::countVehiculeIndisponible($conn);

$count_client=Client::countClient($conn);

$count_reservations=Reservation::countReservations($conn);
$count_reser_conf=Reservation::countReservationsConfirme($conn);
$count_reser_atten=Reservation::countReservationsEnAttente($conn);

$count_categories=Categorie::countCategorie($conn);
$count_cat_dis=Categorie::countCategorieDisponble($conn);
$count_cat_ind=Categorie::countCategorieIndisponible($conn);


$nom=$_SESSION['nom'];
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);
        }
        .stat-card:hover { transform: translateY(-5px); transition: all 0.3s ease; }
    </style>
</head>

<body class="bg-[#f8fafc] flex min-h-screen text-slate-900">

<aside class="w-72 sidebar-gradient text-white flex flex-col shadow-2xl overflow-hidden sticky top-0 h-screen">
    <div class="p-8">
        <div class="flex items-center gap-3 mb-10">
            <div class="bg-indigo-500 p-2 rounded-xl shadow-lg shadow-indigo-500/50">
                <i class="fas fa-car-side text-2xl"></i>
            </div>
            <span class="text-xl font-bold tracking-tight">MaBagnole <span class="text-indigo-400">Pro</span></span>
        </div>

        <nav class="space-y-2">
            <a href="Statistiques.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-semibold">
                <i class="fas fa-chart-pie text-white"></i>
                <span>statistiques</span>
            </a>
            <a href="vehicules.php" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-car text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Gestion Véhicules</span>
            </a>
            <a href="categories.php" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-tags text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Catégories</span>
            </a>
            <a href="reservations.php" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-calendar-check text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Réservations</span>
            </a>
            <a href="avis.php" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-star text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Avis Clients</span>
            </a>
        </nav>
    </div>

    <div class="mt-auto p-6 border-t border-white/10">
        <a href="../auth/logout.php">
               <button class="flex items-center gap-4 w-full p-3 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all duration-300">
            <i class="fas fa-sign-out-alt"></i>
            <span class="font-bold uppercase text-xs tracking-widest">Déconnexion</span>
        </button>
        </a>
    </div>
</aside>

<main class="flex-1 p-10 overflow-y-auto">

    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Statistiques</h2>
            <p class="text-slate-500 mt-1">Aperçu global de votre activité et statistiques.</p>
        </div>
        <div class="flex items-center gap-4">
       <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold"><?= $nom[0].$nom[1]  ?></button>
    </header>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

        <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                <i class="fas fa-car text-lg"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Véhicules</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $coun_v ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-arrow-up mr-1"></i>+ nombre totale véhicule</p>
        </div>

        <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                <i class="fas fa-calendar-check text-lg"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Réservations</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $count_reservations ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-chart-line mr-1"></i>+ nombre totale reservations</p>
        </div>

        <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                <i class="fas fa-users text-lg"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Clients</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $count_client ?></p>
            <p class="text-blue-500 text-xs font-bold mt-1">Utilisateurs actifs</p>
        </div>

        <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                <i class="fas fa-car text-lg text-green-500"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Vehicule Disponible</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $coun_v_disp ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-caret-up mr-1"></i>+ nombre totale vehicule disponible</p>
        </div>

         <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                <i class="fas fa-car text-lg text-red-500"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Vehicule Indisponible</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $coun_v_indisp ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-caret-up mr-1"></i>+ nombre totale vehicule indisponible</p>
        </div>



         <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
            <i class="fas fa-th-large text-lg text-blue-500"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Categories</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $count_categories ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-caret-up mr-1"></i>+ nombre totale categories</p>
        </div>


        <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
            <i class="fas fa-th-large text-lg text-green-500"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Categories Disponible</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $count_cat_dis ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-caret-up mr-1"></i>+ nombre categories disponible</p>
        </div>


         <div class="glass-card stat-card p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
            <i class="fas fa-th-large text-lg text-red-500"></i>
            </div>
            <h4 class="text-slate-400 text-xs font-black uppercase tracking-widest">Categories Indisponible</h4>
            <p class="text-3xl font-black text-slate-800 mt-2"><?=  $count_cat_ind ?></p>
            <p class="text-emerald-500 text-xs font-bold mt-1"><i class="fas fa-caret-up mr-1"></i>+ nombre categories indisponible</p>
        </div>
       

    </section>

  

    <section class="glass-card p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-3">
            <i class="fas fa-chart-pie text-blue-500"></i> État des Réservations
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 rounded-[2rem] bg-emerald-50 border border-emerald-100 text-center">
                <p class="text-4xl font-black text-emerald-600"><?= $count_reser_conf ?></p>
                <p class="text-emerald-700 font-bold text-sm uppercase mt-1">Validées</p>
                <div class="mt-4 text-xs text-emerald-500">Contrats signés</div>
            </div>
            <div class="p-6 rounded-[2rem] bg-yellow-50 border border-yellow-100 text-center">
                <p class="text-4xl font-black text-yellow-600"><?= $count_reser_atten ?></p>
                <p class="text-yellow-700 font-bold text-sm uppercase mt-1">En attente</p>
                <div class="mt-4 text-xs text-yellow-500">À vérifier</div>
            </div>
          
        </div>
    </section>

</main>
</body>
</html>