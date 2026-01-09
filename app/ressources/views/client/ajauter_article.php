<?php
session_start();
require_once '../../../includes/config.php';
require_once '../../../includes/classes/article.php';
require_once '../../../includes/classes/tag.php';
require_once '../../../includes/classes/articleTag.php';


$id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    die("cette id introvable");
}

$nom_theme=$_GET['nom_theme'];

$tags=Tag::afficherTags($conn);

$id_user= $_SESSION['id_user'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $tags = $_POST['tags']; 

   
    $article = new Article($titre, $contenu,"EN_ATTENTE");
    $id_article = $article->save($conn,$id_user,$id);
   
    


    foreach ($tags as $id_tag) {
        $articleTag = new ArticleTag($id_article, $id_tag);
        if(!$articleTag->save($conn)){
       echo "error de l'insertion de article tag";
        }
    }
 header('Location: articles.php?id='.$id.'&nom_theme='.$nom_theme);
                exit;
    
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>MaBagnole - Publier un Article</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
     
        .tag-checkbox:checked + label {
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
        <a href="articles.php?id=<?=  $id ?>&nom_theme=<?= $nom_theme ?>" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
            <i class="fas fa-times mr-2"></i> Annuler
        </a>
    </nav>

    <main class="max-w-3xl mx-auto px-6 py-16">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Partagez votre expertise</h1>
            <p class="text-slate-500 font-medium">Remplissez les informations ci-dessous pour publier votre nouvel article.</p>
        </div>

        <form action="" method="POST" class="space-y-8 bg-white p-8 md:p-12 rounded-[3rem] shadow-sm border border-slate-100">
            
            <div class="space-y-2">
                <label for="title" class="text-sm font-black text-slate-700 uppercase tracking-widest ml-1">Titre de l'article</label>
                <input type="text" id="title" name="titre" required
                    placeholder="Ex: L'avenir de l'hydrogène en 2026..." 
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white outline-none transition-all text-lg font-semibold text-slate-800">
            </div>

            <div class="space-y-4">
                <label class="text-sm font-black text-slate-700 uppercase tracking-widest ml-1 text-center block">Sélectionnez les tags associés</label>
                <div class="flex flex-wrap justify-center gap-3">
                    
<?php  if(count($tags)>0){
    foreach($tags as $tag){  
?>

                    <div class="relative">
                        <input type="checkbox" id="<?= $tag->getNomTag() ?>" name="tags[]" value="<?= $tag->getIdTag() ?>" class="hidden tag-checkbox">
                        <label for="<?= $tag->getNomTag() ?>" class="tag-label px-5 py-2 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-500 text-xs font-bold block">
                            #<?= $tag->getNomTag() ?>
                        </label>
                    </div>

                  <?php }  }  ?>



                </div>
            </div>

            <div class="space-y-2">
                <label for="content" class="text-sm font-black text-slate-700 uppercase tracking-widest ml-1">Contenu de l'article</label>
                <textarea id="content" name="contenu" required rows="10"
                    placeholder="Écrivez votre article ici..." 
                    class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white outline-none transition-all text-slate-600 leading-relaxed"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-slate-900 shadow-xl shadow-indigo-200 transition-all transform hover:-translate-y-1">
                    <i class="fas fa-paper-plane mr-2"></i> Publier l'article
                </button>
            </div>

        </form>

    </main>

    <footer class="py-12 text-center text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">
        MaBagnole &bull; Espace Rédaction &bull; 2026
    </footer>

</body>
</html>