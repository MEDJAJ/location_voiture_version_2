<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/classes/article.php';
require_once '../../../includes/classes/commentaire.php';
require_once '../../../includes/classes/tag.php';
require_once '../../../includes/classes/favorite.php';

$id=isset($_GET['id']) ? $_GET['id'] :0;
if(!$id){
    die("cette id intovable");
}
$articles_with_tags=Article::getArticlesWithTags($conn,$id);

$id_user= $_SESSION['id_user'];

$nom_theme= $_GET['nom_theme'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['envoyer_c'])){
        $commentaire=$_POST['commentaire'];
$id_art=(int) $_POST['id_art'];
$commentaire=new Commentaire($commentaire);
if(!$commentaire->ajauterCommetaire($conn,$id_user,$id_art)){
 die("cette insertion de commentaire faild");
}else{
    header('Location: articles.php?id='.$id.'&nom_theme='.$nom_theme);
    exit;
}
    }elseif(isset($_POST['recherche'])){
        $search=$_POST['search'];
      if ($search) {
    $articles_with_tags = Article::searchArticlesByTitle($conn, $id, $search);
} else {
    $articles_with_tags = Article::getArticlesWithTags($conn, $id);
}
    }elseif(isset($_POST['heart'])){
        $id_article=trim($_POST['id_article']);
        $favoris=new Favorite($id_user,$id_article);
        if($favoris->verifierArticleAuxF($conn)){
            if(!$favoris->supprimerArticleAuxF($conn)){
           die("Errore de supperesion");
            }
        }else{
            $favoris->ajouterArticleAuxFavoris($conn);
        }
        
    }






}

$tags=Tag::afficherTags($conn);

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>MaBagnole - Articles du Thème</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .article-card:hover { transform: translateY(-5px); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
   
        .heart-btn:hover i, .add-btn:hover i { transform: scale(1.2); transition: transform 0.2s ease; }
        .heart-active { color: #ef4444 !important; background-color: #fef2f2 !important; border-color: #fee2e2 !important; }
        
   
        .floating-add { box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.4); }
          @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
     
        .tag-checkbox-js:checked + label {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
            transform: scale(1.05);
        }
        .tag-label { transition: all 0.2s ease; cursor: pointer; }
    </style>
</head>
<body class="bg-[#f8fafc]">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2 text-2xl font-black text-slate-900 tracking-tighter">
            <span class="text-indigo-600"><i class="fas fa-car-side"></i></span> MaBagnole
        </div>
        <div class="flex items-center gap-4">
            <a href="ajauter_article.php?id=<?= $id ?>&nom_theme=<?= $nom_theme ?>">
<button title="Publier un article" class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl font-bold text-xs hover:bg-indigo-600 transition-all">
                <i class="fas fa-plus"></i> Nouveau
            </button>
            </a>
            

            <a href="mes_favories.php?id=<?= $id ?>&nom_theme=<?= $nom_theme ?>">
                <button title="Explorer les favoris" class="heart-btn heart-active w-10 h-10 rounded-full border flex items-center justify-center transition-all">
                    <i class="fas fa-heart text-sm"></i>
                </button>
            </a>
          
            <a href="theme.php" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">Retour aux Thèmes</a>
            <button class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 font-bold uppercase">AD</button>
        </div>
    </nav>

   

    <main class="max-w-5xl mx-auto px-6 py-12">
        
        <div class="mb-12 text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-8">Articles : <span class="text-indigo-600 italic"><?= $_GET['nom_theme']  ?></span></h1>
            
           <div class="flex flex-col gap-4 bg-white p-4 rounded-[2rem] shadow-sm border border-slate-100">


  <div class="flex items-center w-full bg-slate-50 rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500">
    
   
    <i class="fas fa-search ml-4 text-slate-400"></i>




 <form action="" method="POST" class="flex items-center w-full bg-slate-50 rounded-2xl overflow-hidden ">
    
  

    <input 
        name="search"
        type="text" 
        placeholder="Rechercher un article par titre..."
        class="flex-1 px-4 py-3 bg-transparent outline-none text-sm font-medium text-slate-700"
    >

    <button 
        type="submit" 
        name="recherche"
        class="px-5 py-2 mr-2 rounded-xl bg-indigo-600 text-white text-xs font-bold hover:bg-indigo-700 transition-all"
    >
        Rechercher
    </button>

</form>


  </div>

 
  <div class="flex gap-2 overflow-x-auto pb-2 max-w-full custom-scrollbar">
   <?php  if(count($tags)>0){
    foreach($tags as $tag){  
?>

                    <div class="relative">
                        <input type="checkbox" id="<?= $tag->getNomTag() ?>" name="tags[]" value="<?= $tag->getIdTag() ?>" class="hidden tag-checkbox-js">
                        <label for="<?= $tag->getNomTag() ?>" class="tag-label px-5 py-2 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-500 text-xs font-bold block">
                            #<?= $tag->getNomTag() ?>
                        </label>
                    </div>

                  <?php }  }  ?>
  </div>

</div>



        </div>

        <div id="articles-container" class="space-y-12">
            
<?php       if(count($articles_with_tags)>0){
       foreach($articles_with_tags as $row){ 
  ?>

            <article   data-tags='<?= json_encode(array_map(fn($t) => $t->getIdTag(), $row->getTags())) ?>' class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden article-card transition-all duration-300">
                <div class="p-8 md:p-10">
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-500 bg-indigo-50 px-3 py-1 rounded-lg">Publié le <?=  $row->getDateCreation()  ?></span>
                        <div class="flex items-center gap-3">
                            <?php if(count($row->getTags())>0){   
                                foreach($row->getTags() as $tag){ 
                                ?>
                            <span class="text-[10px] font-bold text-slate-400">#<?= $tag->getNomTag() ?></span>
                            <?php   } } ?>
                            
                                   <form action="" method="POST">
                                      <input value="<?= $row->getId() ?>" class="hidden"  type="text" name="id_article"/>
                                    <?php   
                                    $favoris_check=new Favorite($id_user,$row->getId());
                                   if($favoris_check->verifierArticleAuxF($conn)){
                                    ?>
                                    <button type="submit" name="heart"  title="Ajouter aux favoris" class="heart-btn w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 text-red-500 hover:text-red-500 bg-red-50 hover:bg-red-50 border-red-100 hover:border-red-100 transition-all">
                                <i class="fas fa-heart text-sm text-red-500"></i>
                            </button>

                            <?php }else{   ?>

<button type="submit" name="heart"  title="Ajouter aux favoris" class="heart-btn w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400  hover:text-red-500  hover:bg-red-50  hover:border-red-100 transition-all">
                                <i class="fas fa-heart text-sm"></i>
                            </button>

                                <?php } ?>
                                   </form>
    
                        </div>
                    </div>

                    <h2 class="text-3xl font-bold text-slate-900 mb-4 leading-tight"><?=  $row->getTitre()  ?></h2>
                    <p class="text-slate-600 leading-relaxed text-lg mb-8">
                       <?=  $row->getContenu()  ?>
                    </p>

                    <div class="mt-10 pt-8 border-t border-slate-50">
                        <h4 class="text-sm font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-comments text-indigo-500"></i> Commentaires (2)
                        </h4>
                        
                        <div class="flex gap-3 items-start">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-600 font-bold text-xs">AD</div>
                            <div class="flex-1 group">
                               <form action="" method="POST">
                                 <textarea name="commentaire" placeholder="Écrire un commentaire..." class="w-full p-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 outline-none text-sm transition-all resize-none h-12 focus:h-24"></textarea>
                                 <input value="<?= $row->getId() ?>" class="hidden"  type="text" name="id_art"/>
                                <button name="envoyer_c"  type="submit" class="mt-2 px-6 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-indigo-600 transition-all opacity-0 group-focus-within:opacity-100">Envoyer</button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>


<div class="flex flex-col space-y-4">

<?php   $commentaire_par_articles=Commentaire::afficherCommentairesParArticle($conn,$row->getId())   ;
if(count($commentaire_par_articles)>0){
    foreach($commentaire_par_articles as $comtaire_article){

 
?>

  <div class="flex bg-white rounded-xl shadow-md p-4 w-full hover:shadow-lg transition-shadow duration-300">
  

  <img class="w-12 h-12 rounded-full border-2 border-indigo-500 object-cover mr-4" 
       src="https://randomuser.me/api/portraits/men/32.jpg" 
       alt="Photo utilisateur">


  <div class="flex-1">
    
    <div class="flex justify-between items-center mb-1">
      <span class="font-semibold text-gray-800">
        <?= $comtaire_article['nom'] ?>
      </span>

      <div class="flex items-center gap-3">
        <span class="text-xs text-gray-500">
          <?= $comtaire_article['date_creation'] ?>
        </span>

        <?php    if($comtaire_article['id_user']==$id_user){

         ?>
        <a href="modifier_commentaire.php?id=<?= $comtaire_article['id_commentaire'] ?>&id_theme=<?= $id ?>&nom_theme=<?= $nom_theme ?>"
           class="text-blue-500 hover:text-blue-700 text-sm transition-colors"
           title="Modifier">
          <i class="fas fa-edit"></i>
        </a>

  
        <form method="POST" action="supprimer_commentaire.php?id=<?= $comtaire_article['id_commentaire'] ?>&id_theme=<?= $id ?>&nom_theme=<?= $nom_theme ?>" onsubmit="return confirm('Voulez-vous vraiment supprimer ce commentaire ?');">
          <input type="hidden" name="id_commentaire" value="<?= $comtaire_article['id_commentaire'] ?>">
          <button type="submit"
                  class="text-red-500 hover:text-red-700 text-sm transition-colors"
                  title="Supprimer">
            <i class="fas fa-trash"></i>
          </button>
        </form>
        <?php  }  ?>
      </div>
    </div>

    <p class="text-gray-700 text-sm leading-relaxed">
      <?= $comtaire_article['contenu'] ?>
    </p>

  </div>
</div>


<?php      }
}   ?>

 




</div>


            </article>

<?php  }  }  ?>




        </div>
    </main>

    <footer class="py-12 text-center text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">
        MaBagnole Blog &copy; 2026 - Plateforme d'Échange
    </footer>

    <script>
const checkboxes = document.querySelectorAll('.tag-checkbox-js');
const articlesContainer = document.getElementById('articles-container');

function filterArticlesByTags(){
    const selectedTags = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    const articles = articlesContainer.querySelectorAll('article');

    articles.forEach(article => {
        const articleTags = JSON.parse(article.dataset.tags);
        if (selectedTags.length === 0 || selectedTags.some(tag => articleTags.includes(parseInt(tag)))) {
            article.style.display = ''; 
        } else {
            article.style.display = 'none'; 
        }
    });
}

checkboxes.forEach(cb => cb.addEventListener('change', filterArticlesByTags));

</script>

</body>
</html>