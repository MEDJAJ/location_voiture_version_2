
<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Categorie.php';

$nom=$_SESSION['nom'];
$categories=Categorie::afficherCategories($conn); 
if(count($categories)==0){
echo "aucun categorie";
exit;
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MaBagnole - Catégories</title>
</head>
<body class="bg-slate-50">
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 px-6 py-4 flex justify-between items-center">
        <div class="text-2xl font-black text-indigo-600 tracking-tighter">MaBagnole</div>
        <div class="hidden md:flex gap-8 font-bold text-gray-600">
            <a href="categorie.php" class="text-indigo-600">Nos Catégories</a>
            <a href="mes_avis.php" class="hover:text-indigo-600">Mes Avis</a>
        </div>
        <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold"><?= $nom[0].$nom[1]  ?></button>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <header class="mb-12 text-center lg:text-left">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-4">Explorez nos catégories</h1>
            <p class="text-gray-500 text-lg">Choisissez le style de conduite qui vous convient pour votre prochain voyage.</p>
        </header>




        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php   foreach($categories as $categorie){
            
if($categorie['status']==1){
        ?>


            <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden">
                <div class="relative h-64 rounded-[2rem] overflow-hidden mb-6">
                    <img src="<?= '../../../assets/uploads/'.$categorie['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    <span class="absolute bottom-6 left-6 bg-indigo-600 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest italic">Actif</span>
                </div>
                <div class="px-4 pb-4">
                    <h3 class="text-2xl font-black text-gray-800 mb-2"><?= $categorie['nom'] ?></h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6"><?= $categorie['description'] ?></p>
                    <a href="vehicules.php?id=<?= $categorie['id_categorie']?>&name=<?= $categorie['nom'] ?>" class="flex items-center justify-between group/btn bg-slate-50 hover:bg-indigo-600 p-4 rounded-2xl transition-all duration-300">
                        <span class="font-bold text-slate-700 group-hover/btn:text-white">Voir les véhicules</span>
                        <span class="text-indigo-600 group-hover/btn:text-white">→</span>
                    </a>
                </div>
            </div>

<?php  }else{

 ?>




            <div class="group relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-sm opacity-70">
                <div class="relative h-64 rounded-[2rem] overflow-hidden mb-6 grayscale">
                    <img src="<?= '../../../assets/uploads/'.$categorie['image'] ?>" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-slate-900/20"></div>
                    <span class="absolute bottom-6 left-6 bg-gray-500 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest italic">Bientôt disponible</span>
                </div>
                <div class="px-4 pb-4">
                    <h3 class="text-2xl font-black text-gray-400 mb-2 font-strikethrough"><?= $categorie['nom'] ?></h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6"><?= $categorie['description'] ?></p>
                    <button disabled class="w-full bg-gray-100 text-gray-400 py-4 rounded-2xl font-bold cursor-not-allowed">Indisponible</button>
                </div>
            </div>

<?php  } }   ?>
        </div>
    </main>
</body>
</html>