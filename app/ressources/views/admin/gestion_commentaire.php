<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/commentaire.php';

$commentaires=Commentaire::afficherCommentaires($conn);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Pro - Gestion Commentaires</title>
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

                <a href="approver_article.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-file-signature w-5 text-slate-400 group-hover:text-indigo-400"></i>
                    <span class="font-medium">Approuver Articles</span>
                </a>

                <a href="gestion_tags.php" class="flex items-center gap-4 p-3 rounded-xl transition-all hover:bg-white/10 group">
                    <i class="fas fa-hashtag w-5 text-white"></i>
                    <span>Gestion des Tags</span>
                </a>

                <a href="gestion_commentaire.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-bold italic">
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
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Gestion des Commentaires</h2>
            <p class="text-slate-500 mt-1">Modérez les échanges entre vos lecteurs.</p>
        </div>
        <div class="flex items-center gap-4">
            <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold uppercase">AD</button>
        </div>
    </header>

    <div class="space-y-6">
        <?php  if(count($commentaires)>0){   
            foreach($commentaires as $commentaire){ 
            ?>
        
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex flex-col md:flex-row justify-between gap-6">
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-bold text-slate-800"><?= $commentaire['nom']  ?></h4>

                        </div>
                        <p class="text-xs text-indigo-500 font-medium mb-3">Sur l'article : <span class="italic font-semibold text-slate-600"><?= $commentaire['titre'] ?></span></p>
                        <p class="text-slate-600 text-sm leading-relaxed max-w-2xl">
                            "<?= $commentaire['contenu'] ?>"
                        </p>
                    </div>
                </div>

                <div class="flex md:flex-col justify-end gap-2 shrink-0">
                  <a href="modifier_commentaire.php?id=<?= $commentaire['id_commentaire'] ?>">
                      <button class="flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all font-bold text-xs uppercase">
                        <i class="fas fa-pen"></i> Modifier
                    </button>
                  </a>
                  <a href="supprimer_commentaire.php?id=<?= $commentaire['id_commentaire'] ?>">
                      <button class="flex items-center gap-2 px-4 py-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all font-bold text-xs uppercase">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                  </a>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Publié le <?= $commentaire['date_creation'] ?></span>
                
            </div>
        </div>

<?php  }  } ?>


      

    </div>
</main>

</body>
</html>