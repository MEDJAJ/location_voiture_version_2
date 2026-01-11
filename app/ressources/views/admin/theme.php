<?php

require_once '../../../includes/config.php';
require_once '../../../includes/classes/theme.php';

$message="";
$error="";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nom=trim($_POST["nom"]);
    $description=trim($_POST["description"]);
    if(empty($nom) || empty($description)){
     $message="toutes les champs obligatoire";
     $error="0";
    }else{
        $theme=new Theme($nom,$description);
        if($theme->ajauterTheme($conn)){
            $message="Le Theme Ajauter Avec Sucess";
            $error="1";
        }else{
            $message="Insertion Faild";
              $error="0";
        }
    }
}

$themes=Theme::afficherthemes($conn);



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Pro - Gestion des Thèmes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);
        }
    </style>
</head>

<body class="bg-[#f8fafc] flex min-h-screen text-slate-900">


    <aside class="w-72 sidebar-gradient text-white flex flex-col shadow-2xl sticky top-0 h-screen z-50">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-indigo-500 p-2 rounded-xl shadow-lg shadow-indigo-500/50">
                    <i class="fas fa-car-side text-2xl"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">MaBagnole <span class="text-indigo-400">Pro</span></span>
            </div>

            <nav class="space-y-1.5 custom-scrollbar overflow-y-auto max-h-[calc(100vh-250px)]">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 ml-3">Menu Principal</p>
                
                <a href="Statistiques.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-chart-pie w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Statistiques</span>
                </a>

                <a href="vehicules.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-car w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Véhicules</span>
                </a>

                <a href="categories.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-layer-group w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Catégories</span>
                </a>

                <a href="reservations.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-calendar-check w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Réservations</span>
                </a>

                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mt-8 mb-4 ml-3">Contenu & Blog</p>

                <a href="theme.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-bold italic">
                    <i class="fas fa-palette w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Thèmes</span>
                </a>

                <a href="approver_article.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-file-signature w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Approuver Articles</span>
                </a>

                <a href="gestion_tags.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-hashtag w-5 text-white"></i>
                    <span>Gestion des Tags</span>
                </a>

                <a href="gestion_commentaire.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-comments w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Commentaires</span>
                </a>

                <a href="avis.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-star w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Avis Clients</span>
                </a>
            </nav>
        </div>

        <div class="mt-auto p-6 border-t border-white/10 bg-black/20">
            <a href="../auth/logout.php">
                <button class="flex items-center gap-4 w-full p-3 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all group">
                    <i class="fas fa-sign-out-alt group-hover:rotate-12 transition-transform"></i>
                    <span class="font-bold uppercase text-xs tracking-widest">Déconnexion</span>
                </button>
            </a>
        </div>
    </aside>

<main class="flex-1 p-10 overflow-y-auto">

    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Gestion des Thèmes</h2>
            <p class="text-slate-500 mt-1">Configurez les ambiances visuelles de votre plateforme.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative">
                <i class="fas fa-bell text-slate-400 text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-indigo-500 w-2 h-2 rounded-full border-2 border-white"></span>
            </div>
            <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold uppercase">AD</button>
        </div>
    </header>

    <section class="glass-card p-8 rounded-[2rem] shadow-sm mb-12 relative overflow-hidden transition-all hover:shadow-md">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <i class="fas fa-palette text-9xl"></i>
        </div>
        
        <div class="flex items-center gap-3 mb-8">
            <span class="bg-indigo-100 text-indigo-600 w-8 h-8 rounded-lg flex items-center justify-center">
                <i class="fas fa-plus text-sm"></i>
            </span>
            <h3 class="text-xl font-bold italic">Nouveau Thème</h3>
        </div>

        <form class="grid grid-cols-1 md:grid-cols-12 gap-6 relative z-10" method="POST">
            <div class="md:col-span-4 space-y-2">
                <label class="text-sm font-semibold text-slate-700 ml-1">Nom du thème</label>
                <input  name="nom" type="text" placeholder="Ex: Luxe & Sport" class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all">
            </div>

            <div class="md:col-span-6 space-y-2">
                <label class="text-sm font-semibold text-slate-700 ml-1">Description</label>
                <input name="description"  type="text" placeholder="Description du thème..." class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all">
            </div>

            <div class="md:col-span-2 flex items-end">
                <?php    if($error==""){  ?>
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-1">
                    Ajouter
                </button>
                <?php }elseif($error=="0"){
                 ?>
<button type="submit" class="w-full bg-red-600 text-white font-bold py-3.5 rounded-xl hover:bg-red-700 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-1">
                    Ajouter
                </button>
                 <?php }else{
                         ?>
<button type="submit" class="w-full bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-1">
                    Ajouter
                </button>
                         <?php   } ?>
            </div>
        </form>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
    <?php   if(count($themes)){   
        
        foreach($themes as $theme){

        
        
        ?>
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group relative">
            <div class="flex justify-between items-start mb-6">
                <div class="bg-indigo-50 w-12 h-12 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                    <i class="fas fa-paint-brush text-lg"></i>
                </div>
                <div class="flex gap-2">
                    <a href="modifier_theme.php?id=<?= $theme->getId() ?>">
                        <button title="Modifier" class="w-9 h-9 flex items-center justify-center bg-slate-50 text-slate-400 rounded-xl hover:bg-indigo-100 hover:text-indigo-600 transition-all">
                        <i class="fas fa-edit text-xs"></i>
                    </button>
                    </a>
                    <a href="supprimer_theme.php?id=<?= $theme->getId() ?>">
                         <button title="Supprimer" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    </a>
                   
                </div>
            </div>

            <h4 class="text-xl font-bold text-slate-800 mb-3 tracking-tight"><?= $theme->getNom() ?></h4>
            <p class="text-slate-500 text-sm leading-relaxed mb-6">
                <?= $theme->getDescription() ?>
            </p>

            <div class="flex items-center gap-2 pt-4 border-t border-slate-50">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Status: Actif</span>
            </div>
        </div>


<?php  } }else{
 ?>
<p class="text-center">aucun theme ajauter</p>

      <?php } ?>

    </div>
</main>

</body>
</html>