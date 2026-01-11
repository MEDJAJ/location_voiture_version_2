
<?php

$id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    die("cette id introvable");
}

$nom_theme=$_GET['nom_theme'];

?>







<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Banner Attente Article</title>

<style>
.banner-attente {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    border-radius: 15px;
    padding: 30px;
    color: #fff;
    max-width: 900px;
    margin: 40px auto;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.banner-text {
    max-width: 55%;
}

.banner-text h2 {
    font-size: 28px;
    margin-bottom: 10px;
}

.banner-text p {
    font-size: 16px;
    margin-bottom: 20px;
    line-height: 1.5;
}

.banner-text a {
    display: inline-block;
    padding: 12px 25px;
    background-color: #fff;
    color: #4e73df;
    text-decoration: none;
    font-weight: bold;
    border-radius: 25px;
    transition: 0.3s;
}

.banner-text a:hover {
    background-color: #f1f1f1;
    transform: scale(1.05);
}

.banner-image img {
    max-width: 250px;
    border-radius: 10px;
}
</style>
</head>

<body>

<div class="banner-attente">
    <div class="banner-text">
        <h2> Attente d’Article à Ajouter</h2>
        <p>
            Des articles sont en attente d’ajout et d’approbation.
            Cliquez ci-dessous pour consulter la liste complète
            et gérer les articles disponibles.
        </p>
        <a href="articles.php?id=<?=  $id ?>&nom_theme=<?= $nom_theme ?>">Voir les articles</a>
    </div>

    <div class="banner-image">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" alt="Articles en attente">
    </div>
</div>

</body>
</html>
