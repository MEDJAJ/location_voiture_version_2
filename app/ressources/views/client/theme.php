<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/theme.php';

$themes=Theme::afficherthemes($conn);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>MaBagnole - Le Blog</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .theme-card:hover .theme-icon { transform: scale(1.1) rotate(-5deg); }
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-[#fcfdfe]">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 px-8 py-5 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-indigo-600 p-1.5 rounded-lg">
                <i class="fas fa-car-side text-white text-xl"></i>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tighter">MaBagnole<span class="text-indigo-600">.</span></div>
        </div>
        
        <div class="hidden md:flex gap-10 font-bold text-slate-600 items-center">
            <a href="categorie.php" class="hover:text-indigo-600 transition-colors">Nos Véhicules</a>
            <a href="mes_avis.php" class="hover:text-indigo-600 transition-colors">Mes Avis</a>
            <a href="theme.php" class="text-indigo-600 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-1 after:bg-indigo-600 after:rounded-full">Blog</a>
        </div>

        <div class="flex items-center gap-4">
            <span class="hidden sm:block text-sm font-bold text-slate-500">Bonjour, Utilisateur</span>
            <button class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold shadow-lg shadow-indigo-200 ring-4 ring-white">
                UT
            </button>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <header class="max-w-3xl mb-16">
            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
                Passion Automobile : <br><span class="gradient-text">Explorez nos Thématiques</span>
            </h1>
            <p class="text-slate-500 text-xl leading-relaxed">
                Plongez dans l'univers MaBagnole à travers nos articles spécialisés. Conseils techniques, guides d'achat et actualités électriques.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
        <?php if(count($themes)>0){
   foreach($themes as $theme){

   
      ?>
            <div class="theme-card group bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 flex flex-col h-full">
                <div class="theme-icon w-16 h-16 rounded-3xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-8 transition-transform duration-500">
                    <i class="fas fa-bolt text-2xl"></i>
                </div>
                <div class="flex-grow">
                    <h3 class="text-2xl font-extrabold text-slate-800 mb-4 group-hover:text-indigo-600 transition-colors"><?=  $theme->getNom() ?></h3>
                    <p class="text-slate-500 leading-relaxed mb-8"><?=  $theme->getDescription() ?>.</p>
                </div>
                <a href="articles.php?id=<?= $theme->getId() ?>&nom_theme=<?= $theme->getNom() ?>" class="inline-flex items-center justify-between w-full bg-slate-900 text-white p-5 rounded-[1.5rem] group-hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-slate-200 group-hover:shadow-indigo-200">
                    <span class="font-bold tracking-wide">Découvrir les articles</span>
                    <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>
            </div>

<?php   }  } ?>

         


        </div>
    </main>

    <footer class="border-t border-slate-100 py-12 text-center text-slate-400 text-sm">
        <p>&copy; 2026 MaBagnole. Tous les articles sont rédigés par nos experts.</p>
    </footer>

</body>
</html>