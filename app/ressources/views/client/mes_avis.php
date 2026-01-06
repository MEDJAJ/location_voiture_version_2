
<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Categorie.php';
require_once '../../../includes/classes/vehicule.php';
require_once '../../../includes/classes/reservation.php';
require_once '../../../includes/classes/Avis.php';


$vehicules = Avis::getNomVehiculeMarque($conn);
$success="0";
$id_user=$_SESSION['id_user'];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$id_vehicule=trim($_POST['id_vehicule']);
$description=trim($_POST['description']);
$number=trim($_POST['number']);

$avi=new Avis($number,$description,"1");
if($avi->ajauterAvis($conn,$id_user,$id_vehicule)){
    $success="1";
    header('Location: mes_avis.php');
}else{
    $success="2";
}
}

$avisparuserconnecter=Avis::getAvisParUser($conn,$id_user);




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mes Avis - MaBagnole</title>
</head>
<body class="bg-slate-50">
    <nav class="bg-white border-b px-6 py-4 flex justify-between items-center">
        <div class="text-2xl font-black text-indigo-600 tracking-tighter">MaBagnole</div>
        <div class="flex gap-6">
            <a href="categorie.php" class="font-bold text-gray-400">Catalogue</a>
            <a href="mes_avis.php" class="font-bold text-indigo-600">Mes Avis</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <h1 class="text-4xl font-black text-gray-900 mb-10 tracking-tight text-center lg:text-left">Vos expériences passées</h1>

        <div class="space-y-6">
            <?php if(count($avisparuserconnecter)>0){
                foreach($avisparuserconnecter as $aviuser){

             
           if($aviuser['deleted_at']=="1"){

             ?>
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex gap-6 items-center w-full">
                    <div class="w-24 h-24 bg-gray-100 rounded-2xl overflow-hidden shrink-0">
                        <img src="<?= '../../../assets/uploads/'.$aviuser['image'] ?>" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-800"><?= $aviuser['marque']."  ".$aviuser['modele'] ?></h4>
                        <p class="text-gray-500 italic mt-1"><?=  $aviuser['content'] ?></p>
                        <div class="text-yellow-400 text-xs mt-2 font-bold tracking-widest uppercase">
                         <?php
if($aviuser['note']=="1"){
    echo "★";
}elseif($aviuser['note']=="2"){
    echo "★★";
}elseif($aviuser['note']=="3"){
    echo "★★★";
}elseif($aviuser['note']=="4"){
    echo "★★★★";
}else{
    echo "★★★★★";
}

?>

                        </div>
                    </div>
                </div>
                <div class="flex gap-3 w-full md:w-auto justify-end">
                    <a href="modifier_avis.php?id=<?= $aviuser['id_avis'] ?>">
                  <button class="px-4 py-3 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-100 transition">Modifier</button>
                    </a>
                     <a href="supprimer_avis.php?id=<?= $aviuser['id_avis'] ?>">
                     <button class="px-4 py-3 bg-red-50 text-red-500 rounded-xl font-bold hover:bg-red-100 transition">Supprimer</button>
                    </a>
                  

                </div>
            </div>

            <?php         }else{

            ?>


            <div class="bg-gray-100/50 p-8 rounded-[2rem] border-2 border-dashed border-gray-200 flex justify-between items-center opacity-60">
                <div class="italic text-gray-400 font-medium">
                    Avis sur <span class="font-bold"><?= $aviuser['marque']."  ".$aviuser['modele'] ?></span> (Masqué)
                </div>
<a href="restaurer_avis.php?id=<?= $aviuser['id_avis'] ?>">
     <button class="text-indigo-600 font-bold hover:underline">Restaurer cet avis</button>
</a>
            </div>
        </div>


<?php    }  } } ?>


        <div class="mt-20 bg-white p-10 rounded-[3rem] shadow-xl border border-gray-100">
            <?php if($success=="0"){
            ?>
            <h2 class="text-2xl font-bold mb-6">Ajouter un avis</h2>
            <?php       }elseif($success=="1"){
          ?>
 <h2 class="text-2xl font-bold mb-6 text-green-600">Ajouter un avis</h2>
          <?php   }else{ ?>
 <h2 class="text-2xl font-bold mb-6 text-red-600">Ajouter un avis</h2>

            <?php   } ?>
            <form action="#" class="space-y-4" method="POST">
               <select name="id_vehicule" 
        class="w-full p-4 rounded-2xl bg-gray-50 border outline-none font-bold text-gray-500">

    <option value="">Sélectionnez un véhicule loué</option>

    <?php foreach ($vehicules as $v): ?>
        <option value="<?= $v['id_vehicule'] ?>">
            <?= $v['modele'] ?> - <?= $v['marque'] ?>
        </option>
    <?php endforeach; ?>

</select>

                <textarea name="description" rows="4" placeholder="Racontez-nous votre trajet..." class="w-full p-4 rounded-2xl bg-gray-50 border focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Note :</span>
                    <input name="number" type="number" max="5" min="1" class="w-20 p-2 bg-gray-50 border rounded-xl font-bold text-center">
                </div>
                <button class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-bold hover:bg-indigo-600 transition">Publier l'avis</button>
            </form>
        </div>
    </main>
</body>
</html>