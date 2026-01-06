<?php

session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Categorie.php';





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $noms = $_POST['nom'];
    $descriptions = $_POST['description'];
    $status = $_POST['status'];
    $images = $_FILES['image'];

    $data = [];

    foreach ($noms as $index => $nom) {

        $imageName = null;

        if (!empty($images['name'][$index])) {

            $extension = pathinfo($images['name'][$index], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            $tmpPath = $images['tmp_name'][$index];
            $destination = "../../../assets/uploads/" . $imageName;

            move_uploaded_file($tmpPath, $destination);
        }

        $data[] = [
            'nom' => $nom,
            'description' => $descriptions[$index],
            'status' => $status[$index]=="1" ? "1" :"0",
            'image' => $imageName
        ];
    }

   
    Categorie::ajouterMasse($conn, $data);


    header('Location: categories.php');
    
}

$categories=Categorie::afficherCategories($conn);

$nom=$_SESSION['nom'];

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole - Gestion Catégories</title>
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
            <a href="Statistiques.php" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-chart-pie text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Statistiques</span>
            </a>
            <a href="vehicules.php" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-car text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium"> Véhicules</span>
            </a>
            <a href="categories.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-semibold">
                <i class="fas fa-tags text-white"></i>
                <span>Catégories</span>
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
        <a href="../logout.php">
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
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Classification</h2>
            <p class="text-slate-500 mt-1">Organisez vos véhicules par segments et styles.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="bg-white p-2 rounded-xl border border-slate-200 shadow-sm px-4">
                <span class="text-xs font-bold text-slate-400 uppercase">Total catégories</span>
                <p class="text-xl font-bold text-indigo-600"><?= count($categories) ?></p>
            </div>
           <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold"><?= $nom[0].$nom[1]  ?></button>
        </div>
    </header>

    <section class="glass-card p-8 rounded-[2rem] shadow-sm mb-12 relative overflow-hidden">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-bold flex items-center gap-3">
                <span class="bg-indigo-100 text-indigo-600 w-8 h-8 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder-plus text-sm"></i>
                </span>
                Gestion des Catégories
            </h3>
            <button type="button" id="add-category-btn" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                <i class="fas fa-plus"></i> Ajouter un formulaire
            </button>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div id="categories-container" class="space-y-10">
                <div class="category-item grid grid-cols-1 md:grid-cols-2 gap-8 relative p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Nom de la catégorie</label>
                        <input name="nom[]" type="text" required placeholder="Ex: SUV Luxueux" class="w-full bg-white border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Statut d'affichage</label>
                        <select name="status[]" class="w-full bg-white border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all cursor-pointer">
                            <option value="1">Active (Visible)</option>
                            <option value="0">Inactive (Masquée)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Description détaillée</label>
                        <textarea name="description[]" rows="2" placeholder="Décrivez les spécificités..." class="w-full bg-white border border-slate-200 p-4 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all"></textarea>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Image de couverture</label>
                        <input name="image[]" type="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-slate-100">
                <button type="submit" class="w-full md:w-auto px-12 bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-1">
                    Enregistrer toutes les catégories
                </button>
            </div>
        </form>
    </section>







    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        

    
<?php


foreach($categories as $c){
    


?>

        <div class="bg-white rounded-[2rem] shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
            <div class="relative h-56 m-3 overflow-hidden rounded-[1.5rem]">
                <img src="<?= '../../../assets/uploads/'.$c['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4">
                    <?php  if($c['status']=='1'){ ?>
                    <span class="bg-white/90 backdrop-blur-md text-emerald-600 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                        <i class="fas fa-circle text-[8px] mr-1 animate-pulse"></i> DISPONIBLE 
                    </span>
                    <?php      }else{ ?>
 <span class="bg-red-600 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                        <i class="fas fa-circle text-[8px] mr-1 animate-pulse"></i> INDISPONIBLE 
                    </span>

<?php  } ?>
                </div>
            </div>

            <div class="p-6 pt-2">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-xs font-bold text-indigo-500 uppercase tracking-widest"><?= $c['nom']   ?></span>
                        <h4 class="text-xl  text-slate-800"><?= $c['description']   ?></h4>
                    </div>

                </div>

                <div class="flex gap-3 mt-6">
                   <a href="modifier_categorie.php?id=<?= $c['id_categorie'] ?>">
                     <button class="flex-1 bg-slate-100 text-slate-600 font-bold py-3 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 w-[250px] transition-all">
                        <i class="fas fa-edit mr-2"></i> Éditer
                    </button>
                   </a>
                   <a href="supprimer_categorie.php?id=<?= $c['id_categorie'] ?>">
                     <button class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                   </a>
                </div>
            </div>
        </div>
<?php
}
?>


     
    </div>



    </main>

<script>

    document.getElementById('add-category-btn').addEventListener('click', function() {
        const container = document.getElementById('categories-container');
        const firstItem = container.querySelector('.category-item');
        const newItem = firstItem.cloneNode(true);

      
        newItem.querySelectorAll('input, textarea').forEach(input => {
            input.value = '';
        });

        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full shadow-lg hover:bg-red-600 transition-all';
        removeBtn.innerHTML = '<i class="fas fa-times"></i>';
        removeBtn.onclick = function() { newItem.remove(); };
        
        newItem.appendChild(removeBtn);
        container.appendChild(newItem);
    });
</script>

</body>
</html>