<?php
class Favorite{
    private $id_client;
    private $id_article;


    public function __construct($id_client,$id_article){
        $this->id_client=$id_client;
        $this->id_article=$id_article;
    }

    public function getIdClient(){
        return  $this->id_client;
    }

        public function getIdArticle(){
        return  $this->id_article;
    }

   public function ajouterArticleAuxFavoris($conn){

    if ($this->verifierArticleAuxF($conn)) {
        return false; 
    }

    $sql = "INSERT INTO favoris(id_client, id_article)
            VALUES(:idclient, :idarticle)";
    
    $stm = $conn->prepare($sql);
    return $stm->execute([
        ':idclient' => $this->id_client,
        ':idarticle' => $this->id_article
    ]);
}


    public function verifierArticleAuxF($conn){
    $sql = "SELECT 1 FROM favoris 
            WHERE id_client = :idclient 
            AND id_article = :idarticle";
    
    $stm = $conn->prepare($sql);
    $stm->execute([
        ':idclient' => $this->id_client,
        ':idarticle' => $this->id_article
    ]);

    return $stm->fetch() !== false;
}


 public  function supprimerArticleAuxF($conn){
    $sql="DELETE FROM favoris  WHERE id_client=:id_client AND id_article=:id_article";
    $stm=$conn->prepare($sql);
    return $stm->execute([
        ':id_client' => $this->id_client,
        ':id_article' => $this->id_article
    ]);

 }



 public static function afficherArticlesAuxFavories($conn,$id_client,$limit,$offset){
  $sql="SELECT a.titre,a.contenu,a.date_creation,u.nom,a.id_article FROM users u INNER JOIN favoris f ON f.id_client=u.id_user INNER JOIN article a ON a.id_article=f.id_article WHERE f.id_client=:id_client LIMIT $limit OFFSET $offset";
 $stm=$conn->prepare($sql);
 $stm->execute([':id_client'=>$id_client]);
 return $stm->fetchAll(PDO::FETCH_ASSOC);
}



public static function countArticlesAusFovorie($conn,$id_user){
      $sql="SELECT a.titre,a.contenu,a.date_creation,u.nom,a.id_article FROM users u INNER JOIN favoris f ON f.id_client=u.id_user INNER JOIN article a ON a.id_article=f.id_article WHERE f.id_client=:id_client";
 $stm=$conn->prepare($sql);
 $stm->execute([':id_client'=>$id_user]);
 return count($stm->fetchAll(PDO::FETCH_ASSOC));
}



}







?>