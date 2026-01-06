<?php
session_start();

require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/Categorie.php';
require_once '../../../includes/classes/vehicule.php';
require_once '../../../includes/classes/reservation.php';
require_once '../../../includes/classes/Avis.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    echo "cette id introvable";
    exit;
}

$id_c=isset($_GET['id_c']) ? $_GET['id_c'] : 0;
if($id==0){
    echo "cette id categorie introvable";
    exit;
}

$id_user=$_SESSION['id_user'];
$vehicules=Vehicle::getById($conn,$id,$id_c);
$sucess="";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $lieuprice=trim($_POST['pricecharge']);
    $datedebut=trim($_POST['datedebut']);
      $datefin=trim($_POST['datefin']);

      $reservation=new Reservation(
        $datedebut,
        $datefin,
        $lieuprice,
        'en attente',
        "2",
        $id
      );

      if($reservation->ajauterReservation($conn)){
        $sucess="1";
       header('Location: details.php?id='.$id.'&id_c='.$id_c);
      }else{
        $sucess="0";
      }


}


$avis=Avis::getAvisParVehicule($conn,$id);


?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Détails - MaBagnole</title>
</head>
<body class="bg-slate-50">
    <nav class="bg-white border-b px-6 py-4 flex justify-between items-center">
        <div class="text-2xl font-black text-indigo-600 tracking-tighter">MaBagnole</div>
        <a href="categorie.php" class="text-sm font-bold text-gray-500 hover:text-indigo-600">← Retour au catalogue</a>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2">
            <div class="rounded-[3rem] overflow-hidden shadow-lg mb-8 bg-gray-200">
                <img src="<?= '../../../assets/uploads/'.$vehicules['image'] ?>" class="w-full h-[500px] object-cover">
            </div>
            <h1 class="text-5xl font-black text-gray-900 mb-4 tracking-tighter"><?= $vehicules['modele'] ?></h1>
            <div class="flex gap-4 mb-8">
                <span class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold"><?= $vehicules['marque'] ?></span>
                <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl font-bold"><?= $vehicules['prix'] ?>€ /Par jour</span>
                                <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl font-bold">                <span class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold">Categorie : </span><?= $vehicules['nom'] ?></span>
            </div>
            <p class="text-xl text-gray-500 leading-relaxed mb-12">
                L'accélération la plus rapide de tous les véhicules en production aujourd'hui. Profitez d'une puissance de 1020 chevaux et d'un intérieur futuriste.
            </p>


            <div class="border-t pt-10">
                <h2 class="text-2xl font-bold mb-8">Ce qu'en disent les clients</h2>
                <?php if(count($avis)>0){
           foreach($avis as $avi){

         if($avi['id_user']==$id_user){

                ?>
 <div class="space-y-6">
    <div class="bg-white p-6 rounded-3xl border border-gray-100">
        
       
        <div class="flex justify-between mb-2">
            <span class="font-bold"><?= $avi['nom'] ?></span>

            <span class="text-yellow-400 font-bold">
                <?php
                if ($avi['note'] == 1) {
                    echo "★";
                } elseif ($avi['note'] == 2) {
                    echo "★★";
                } elseif ($avi['note'] == 3) {
                    echo "★★★";
                } elseif ($avi['note'] == 4) {
                    echo "★★★★";
                } else {
                    echo "★★★★★";
                }
                ?>
            </span>
        </div>

      
        <p class="text-gray-600 italic mb-3"><?= $avi['content'] ?></p>

     
        <a href="mes_avis.php ?>"
           class="text-sm text-indigo-600 font-bold hover:underline">
            Cliquez ici pour modifier ou supprimer
        </a>

    </div>
</div>


<?php  }else{

?>
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100">
                        <div class="flex justify-between mb-4">
                            <span class="font-bold"><?= $avi['nom']?></span>
                       
                            <span class="text-yellow-400 font-bold">
                            <?php
                              if($avi['note']==1){
                                echo "★";
                              }elseif($avi['note']==2){
                                echo"★★";
                              }elseif($avi['note']==3){
                                echo"★★★";
                              }elseif($avi['note']==4){
                                echo"★★★★";
                              }else{
                                echo"★★★★★";
                              }
                            ?>
                            </span>
                        </div>
                        <p class="text-gray-600 italic"><?= $avi['content'] ?></p>
                    </div>
                </div>

<?php }   }  } ?>

            </div>
        </div>

        
        <aside>
            <div class="bg-white p-10 rounded-[2.5rem] shadow-2xl border border-gray-50 sticky top-10">
                <?php if($sucess=="1"){

               ?>
                <h3 class="text-2xl font-bold mb-8 italic text-green-600">Réserver ce véhicule</h3>
                <?php  }elseif($sucess=="0"){

                ?>
<h3 class="text-2xl font-bold mb-8 italic text-red-600">Réserver ce véhicule</h3>
                <?php   }else{

                 ?>
<h3 class="text-2xl font-bold mb-8 italic ">Réserver ce véhicule</h3>
                 <?php  }  ?>
                <form action="#" class="space-y-5" method="POST">
                    <div>
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Prise en charge</label>
                        <input type="text" name="pricecharge" placeholder="Gare, Aéroport, Ville..." class="w-full mt-1 p-4 bg-gray-50 rounded-2xl border-none focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Début</label>
                            <input type="date" name="datedebut" class="w-full mt-1 p-4 bg-gray-50 rounded-2xl border-none outline-none">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Fin</label>
                            <input type="date" name="datefin" class="w-full mt-1 p-4 bg-gray-50 rounded-2xl border-none outline-none">
                        </div>
                    </div>
                    <div class="pt-6 border-t border-dashed my-6 flex justify-between items-center">
                        <span class="text-gray-400 font-bold">Prix Total</span>
                        <span class="text-4xl font-black text-indigo-600 underline"><?= $vehicules['prix'] ?>€</span>/par jour
                    </div>
                    <button type="submit" name="reserve" class="w-full bg-indigo-600 text-white py-5 rounded-[1.5rem] font-black text-xl hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all transform hover:scale-[1.02]">RESERVER</button>
                </form>
            </div>
        </aside>
    </main>
</body>
</html>