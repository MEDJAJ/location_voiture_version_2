<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>MaBagnole - Mes Favoris</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .fav-card:hover { transform: translateY(-8px); border-color: #e0e7ff; }
        .page-link:hover { background-color: #4f46e5; color: white; }
        .page-active { background-color: #4f46e5; color: white; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4); }
    </style>
</head>
<body class="bg-[#f8fafc]">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2 text-2xl font-black text-slate-900 tracking-tighter">
            <span class="text-indigo-600"><i class="fas fa-car-side"></i></span> MaBagnole
        </div>
        <a href="articles.php" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
            <i class="fas fa-times mr-2"></i> Annuler
        </a>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        
        <header class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center border border-red-100">
                        <i class="fas fa-heart text-xs"></i>
                    </span>
                    <h2 class="text-xs font-black text-red-500 uppercase tracking-widest">Ma Sélection</h2>
                </div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Articles Enregistrés</h1>
            </div>
            <p class="text-slate-400 text-sm font-medium bg-white px-4 py-2 rounded-full border border-slate-100 shadow-sm">
                <span class="text-indigo-600 font-bold">12</span> articles au total
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            
            <div class="fav-card bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all duration-300 flex flex-col relative group">
                <button class="absolute top-6 right-6 w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center hover:scale-110 transition-transform">
                    <i class="fas fa-heart"></i>
                </button>

                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 text-xl">
                    <i class="fas fa-bolt"></i>
                </div>

                <div class="flex-grow">
                    <span class="text-[10px] font-black px-3 py-1 bg-slate-50 text-slate-400 rounded-full uppercase tracking-tighter mb-4 inline-block">Mobilité Électrique</span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-4 leading-tight group-hover:text-indigo-600 transition-colors">L'autonomie révolutionnaire des batteries solid-state</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Découvrez comment cette nouvelle technologie va changer votre façon de voyager en 2026 sans compromis sur le temps de charge...</p>
                </div>

                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400 italic">15 Janvier 2026</span>
                    <a href="#" class="text-indigo-600 font-bold text-xs flex items-center gap-2 group/link">
                        Lire l'article <i class="fas fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="fav-card bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all duration-300 flex flex-col relative group">
                <button class="absolute top-6 right-6 w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                    <i class="fas fa-heart"></i>
                </button>

                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-6 text-xl">
                    <i class="fas fa-crown"></i>
                </div>

                <div class="flex-grow">
                    <span class="text-[10px] font-black px-3 py-1 bg-slate-50 text-slate-400 rounded-full uppercase tracking-tighter mb-4 inline-block">Luxe & Prestige</span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-4 leading-tight group-hover:text-amber-600 transition-colors">Top 10 des Berlines les plus confortables</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Nous avons testé le confort acoustique et les suspensions des modèles les plus prestigieux du marché européen.</p>
                </div>

                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400 italic">12 Janvier 2026</span>
                    <a href="#" class="text-amber-600 font-bold text-xs flex items-center gap-2 group/link">
                        Lire l'article <i class="fas fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="fav-card bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all duration-300 flex flex-col relative group">
                <button class="absolute top-6 right-6 w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                    <i class="fas fa-heart"></i>
                </button>

                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 text-xl">
                    <i class="fas fa-screwdriver-wrench"></i>
                </div>

                <div class="flex-grow">
                    <span class="text-[10px] font-black px-3 py-1 bg-slate-50 text-slate-400 rounded-full uppercase tracking-tighter mb-4 inline-block">Entretien</span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-4 leading-tight group-hover:text-emerald-600 transition-colors">Comment préparer son véhicule pour l'hiver</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Les points de contrôle essentiels : pneus, liquides, batterie et visibilité pour rouler en toute sécurité sous la neige.</p>
                </div>

                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400 italic">08 Janvier 2026</span>
                    <a href="#" class="text-emerald-600 font-bold text-xs flex items-center gap-2 group/link">
                        Lire l'article <i class="fas fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="flex justify-center items-center gap-2">
            <button class="w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all">
                <i class="fas fa-chevron-left text-xs"></i>
            </button>
            
            <button class="page-link page-active w-12 h-12 rounded-2xl font-bold transition-all text-sm">1</button>
            <button class="page-link w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-600 font-bold transition-all text-sm">2</button>
            <button class="page-link w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-600 font-bold transition-all text-sm">3</button>
            
            <span class="mx-2 text-slate-300 font-bold">...</span>
            
            <button class="w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all text-sm">
                <i class="fas fa-chevron-right text-xs"></i>
            </button>
        </div>

    </main>

    <footer class="py-12 text-center text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">
        MaBagnole &bull; Espace Personnel &bull; 2026
    </footer>

</body>
</html>