<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/article.php';

$articles=Article::afficherArticles($conn);
if(!$articles){
die("Error de Lors de l'affichage de articles");
}




?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Pro - Approbation Articles</title>
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

                <a href="theme.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-palette w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Thèmes</span>
                </a>

                <a href="approver_article.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-bold italic">
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
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Approbation des Articles</h2>
            <p class="text-slate-500 mt-1">Modérez les publications avant leur mise en ligne.</p>
        </div>
        <div class="flex items-center gap-4">
            <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold uppercase">AD</button>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if(count($articles)>0):
            foreach($articles as $article):
            ?>
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden hover:shadow-xl transition-all group">
            <div class="p-8">
                <div class="flex justify-between items-center mb-4">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-lg">
                        Thème : <?= $article['nom_theme'] ?>
                    </span>
                    <span class="flex h-2 w-2 rounded-full bg-amber-400 shadow-[0_0_8px_rgba(251,191,36,0.8)]"></span>
                </div>

                <h4 class="text-xl font-bold text-slate-800 mb-4 tracking-tight leading-snug">
                     <?= $article['titre'] ?>
                </h4>

                <p class="text-slate-500 text-sm leading-relaxed mb-8 line-clamp-4">
                  <?= $article['contenu'] ?>
                </p>
<?php if($article['etat']=="PUBLIE"){
?>

                <div class="flex gap-3 pt-6 border-t border-slate-50">
                    
                        <button class="flex-1 bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle"></i> Approuver
                    </button>
                  
                    <a href="supprimer_article.php?id=<?= $article['id_article'] ?>">
                       <button class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </button> 
                    </a>
                    
                </div>

                <?php }else{ ?>
                    <a href="approver.php?id=<?= $article['id_article'] ?>">
                       <button class="flex-1 w-[200px] bg-red-600 text-white font-bold py-3 rounded-xl hover:bg-red-700 shadow-lg shadow-indigo-100 transition-all flex items-center justify-center gap-2">
                        Desapprover
                    </button>  
                    </a>
        
            <?php    } ?>
            </div>
        </div>

        <?php endforeach;  ?>

        <?php endif; ?>
     

    </div>
</main>

</body>
</html>