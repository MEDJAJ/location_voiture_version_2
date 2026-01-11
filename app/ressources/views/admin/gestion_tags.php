

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole Pro - Gestion des Tags</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);
        }

        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

        .tag-glow:hover {
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.2);
            transform: translateY(-2px);
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

                <a href="gestion_tags.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-bold italic">
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
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Gestion des Tags</h2>
                <p class="text-slate-500 mt-1">Créez et organisez les mots-clés de votre plateforme.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-800">Admin Dash</p>
                    <p class="text-[10px] text-indigo-500 font-bold uppercase tracking-tighter">Super Utilisateur</p>
                </div>
                <button class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-indigo-600 shadow-sm flex items-center justify-center font-bold">AD</button>
            </div>
        </header>

        <section class="glass-card p-8 rounded-[2.5rem] shadow-sm mb-12">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <span class="bg-indigo-100 text-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center shadow-inner">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Nouveaux Tags</h3>
                </div>
                <button type="button" id="add-tag-btn" class="bg-slate-50 hover:bg-indigo-50 text-indigo-600 px-4 py-2 rounded-xl text-sm font-bold transition-all border border-slate-100">
                    <i class="fas fa-plus-circle mr-2"></i>Ajouter un champ
                </button>
            </div>

            <form id="tagForm" action="" method="POST" class="space-y-6">
                <div id="tags-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="tag-item relative group flex items-center gap-2">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-4 flex items-center text-indigo-400 font-bold">#</span>
                            <input type="text" name="tag_names[]" placeholder="Vitesse" required 
                                   class="w-full bg-slate-50 border border-slate-100 p-4 pl-8 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all font-semibold text-slate-700">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-50">
                    <button type="submit" class="px-10 bg-indigo-600 text-white font-black py-4 rounded-2xl hover:bg-slate-900 shadow-xl shadow-indigo-200 transition-all transform hover:-translate-y-1 uppercase text-xs tracking-widest">
                        Enregistrer la sélection
                    </button>
                </div>
            </form>
        </section>

        <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.3em] mb-6 ml-2">Tags Existants</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            

        <?php  if(count($tages)>0){   
            foreach($tages as $tag){

         
            ?>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm tag-glow transition-all group">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-hashtag text-lg"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block"><?= $tag->getNomTag()  ?></span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase">12 Articles</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                        <a href="modifier_tag.php?id=<?= $tag->getIdTag() ?>">
   <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:bg-indigo-50"><i class="fas fa-pen text-xs"></i></button>
                        </a>
                     <a href="supprimer_tag.php?id=<?= $tag->getIdTag() ?>">
                        <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50"><i class="fas fa-trash text-xs"></i></button>
                     </a>
                       
                    </div>
                </div>
            </div>


<?php    } }  ?>


    

        </div>
    </main>

    <script>
        document.getElementById('add-tag-btn').addEventListener('click', function () {
            const container = document.getElementById('tags-container');
            
          
            const newTagItem = document.createElement('div');
            newTagItem.className = "tag-item relative group flex items-center gap-2";
            
            newTagItem.innerHTML = `
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-4 flex items-center text-indigo-400 font-bold">#</span>
                    <input type="text" name="tag_names[]" placeholder="Nouveau tag" required 
                           class="w-full bg-slate-50 border border-slate-100 p-4 pl-8 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all font-semibold text-slate-700">
                </div>
                <button type="button" class="remove-btn text-red-300 hover:text-red-500 p-2 transition-colors">
                    <i class="fas fa-times-circle"></i>
                </button>
            `;

            container.appendChild(newTagItem);

          
            newTagItem.querySelector('.remove-btn').addEventListener('click', function() {
                newTagItem.remove();
            });

          
            newTagItem.querySelector('input').focus();
        });
    </script>

</body>
</html>