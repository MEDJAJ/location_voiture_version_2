<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Categorie.php';
require_once '../../../includes/classes/vehicule.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $modeles = $_POST['modele'];
    $marques = $_POST['marque'];
    $prix = $_POST['prix'];
    $images = $_FILES['image'];
    $nom_categorie=$_POST['categorie'];
    $disponible=$_POST['disponible'];
    $data = [];

    foreach ($modeles as $index => $modele) {

        $imageName = null;

        if (!empty($images['name'][$index])) {

            $extension = pathinfo($images['name'][$index], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            $tmpPath = $images['tmp_name'][$index];
            $destination = "../../../assets/uploads/" . $imageName;

            move_uploaded_file($tmpPath, $destination);
        }

        $data[] = [
            'modele' => $modele,
            'marque' => $marques[$index],
             'prix'=>$prix[$index],
             'nom_categorie'=>$nom_categorie[$index],
            'disponible' => $disponible[$index]=="1" ? "1" :"0",
            'image' => $imageName
        ];
    }

   
    Vehicle::ajouterMasse($conn, $data);


    header('Location: vehicules.php');
    
}

$categories=Categorie::afficherCategories($conn);

$vehicules=Vehicle::afficherVehicule($conn);



$names=Categorie::getNamesC($conn);
if(!$names){
    echo "aucun categorie";
    exit;
}

if(!$vehicules){
    echo "aucun categorie";
    exit;
}

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
            border: 1px solid rgba(103, 41, 41, 0.2);
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
            <a href="vehicules.php" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-semibold">
                <i class="fas fa-car text-white"></i>
                <span> Véhicules</span>
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
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Gestion du Parc</h2>
            <p class="text-slate-500 mt-1">Gérez vos véhicules, tarifs et disponibilités.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative">
                <i class="fas fa-bell text-slate-400 text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-indigo-500 w-2 h-2 rounded-full border-2 border-white"></span>
            </div>
           <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold"><?= $nom[0].$nom[1]  ?></button>
        </div>
    </header>

    <section class="glass-card p-8 rounded-[2rem] shadow-sm mb-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <i class="fas fa-plus-circle text-9xl"></i>
        </div>
        
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-bold flex items-center gap-3">
                <span class="bg-indigo-100 text-indigo-600 w-8 h-8 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus text-sm"></i>
                </span>
                Nouveau Véhicule
            </h3>
          
            <button type="button" id="addFormBtn" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2">
                <i class="fas fa-plus"></i> Ajouter un formulaire
            </button>
        </div>

        <form method="POST" enctype="multipart/form-data" id="vehicleFormContainer" class="grid grid-cols-1 gap-8 relative z-10" >
         
            <div class="vehicle-form grid grid-cols-1 md:grid-cols-3 gap-8 relative p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Modèle du véhicule</label>
                    <input name="modele[]" type="text" placeholder="Ex: Tesla Model S" class="w-full bg-slate-50 border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all">
                </div>

                 <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Marque du véhicule</label>
                    <input name="marque[]" type="text" placeholder="Ex: Marque" class="w-full bg-slate-50 border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all">
                </div>

                 <div class="space-y-2">

                    <label class="text-sm font-semibold text-slate-700 ml-1">Disponibiliter</label>
                    <select name="disponible[]" class="w-full bg-slate-50 border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all appearance-none cursor-pointer">
                       
               <option value="1">Disponible</option>
               <option value="0">Indisponible</option>       
                    
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Prix Journalier (€)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-slate-400">€</span>
                        <input name="prix[]" type="number" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 p-3 pl-8 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all">
                    </div>
                </div>

                <div class="space-y-2">

                    <label class="text-sm font-semibold text-slate-700 ml-1">Catégorie</label>
                    <select name="categorie[]" class="w-full bg-slate-50 border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all appearance-none cursor-pointer">
                        <?php   foreach($names as $nom){ ?>
  <option value="<?= $nom['id_categorie'] ?>"><?= $nom['nom'] ?></option>
                     <?php   }  ?>
                    
                    
                    </select>
                </div>

                <div class="md:col-span-1 space-y-2">
                   
                    <div class="md:col-span-2 space-y-2">
                       <label class="text-sm font-semibold text-slate-700 ml-1">Photo du véhicule</label>
                        <input name="image[]" type="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            </div>

            <div class="flex items-end mt-4">
                <button class="w-full bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-1">
                    Enregistrer le véhicule
                </button>
            </div>
        </form>
    </section>






    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"> 
        
    <?php   
    foreach($vehicules as $vehicule){
    ?>
                            <div class="bg-white rounded-[2rem] shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
                                 <div class="relative h-56 m-3 overflow-hidden rounded-[1.5rem]"> 
                                    <img src="<?= '../../../assets/uploads/'.$vehicule['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"> 
                                    <div class="absolute top-4 left-4">
                                        <?php if($vehicule['disponibilite']==1){
                                       ?>
                                         <span class="bg-green-500 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm"> 
                                            <i class="fas fa-history text-[8px] mr-1"></i>
                                             Disponible
                                            </span> 
                                            <?php   }else{
                                                ?>
                                                   <span class="bg-red-500 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm"> 
                                            <i class="fas fa-history text-[8px] mr-1"></i>
                                             Indisponible
                                            </span> 
                                         <?php   } ?>
                                            </div> 
                                        </div>
                                         <div class="p-6 pt-2"> 
                                                <div class="flex justify-between items-start mb-4">
                                                     <div> <span class="text-xs font-bold text-indigo-500 uppercase tracking-widest"><?= $vehicule['modele'] ?></span>
                                                      <h4 class="text-xl font-bold text-slate-800"><?= $vehicule['marque'] ?></h4> </div> 
                                                      <?php  $nom_c=Categorie::getNomCparId($conn,$vehicule['id_categorie'])  ?>
                                                       <h4 class="text-xs font-bold text-indigo-500 uppercase tracking-widest">categorie :<?= $nom_c['nom'] ?></h4> </div> 
                                                      <div class="text-right"> <p class="text-2xl font-black text-slate-900"><?= $vehicule['prix'] ?> €</p>
                                                       <p class="text-xs text-slate-400 font-medium">par jour</p> </div> </div> 
                                                        <div class="flex gap-3 mt-6">
                   <a href="modifier_vehicule.php?id=<?= $vehicule['id_vehicule'] ?>">
                     <button class="flex-1 bg-slate-100 text-slate-600 font-bold py-3 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 w-[250px] transition-all">
                        <i class="fas fa-edit mr-2"></i> Éditer
                    </button>
                   </a>
                   <a href="supprimer_vehicule.php?id=<?= $vehicule['id_vehicule'] ?>">
                     <button class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                   </a>
                </div>
                                                    </div>
                                                
                                           

                                                 <?php    }  ?>
                                                  </div>
                                                 


</main>

<script>
   
    document.getElementById('addFormBtn').addEventListener('click', function() {
        const container = document.getElementById('vehicleFormContainer');
        const firstForm = container.querySelector('.vehicle-form');
        const newForm = firstForm.cloneNode(true);

       
        newForm.querySelectorAll('input').forEach(input => input.value = '');
        newForm.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        
        newForm.querySelectorAll('.fileInput').forEach(fileInput => fileInput.value = '');

     
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full shadow-lg hover:bg-red-600 transition-all';
        removeBtn.innerHTML = '<i class="fas fa-times"></i>';
        removeBtn.onclick = function() { newForm.remove(); };
        newForm.appendChild(removeBtn);

        container.insertBefore(newForm, container.lastElementChild);
    });
</script>

</body>
</html>
