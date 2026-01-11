<?php
class Commentaire{
    private ?int $id_commentaire;
    private string $nom_commentaire;

    public function __construct(string $nom_commentaire,?int $id_commentaire=null){
        $this->nom_commentaire=$nom_commentaire;
        $this->id_commentaire=$id_commentaire;
    }


    public function getNomCommentaire(){
        return $this->nom_commentaire;
    }

    public static function afficherCommentaires($conn){
        $sql="SELECT c.contenu,c.date_creation,u.nom,a.titre,c.id_commentaire FROM commentaire c INNER JOIN users u ON u.id_user=c.id_client INNER JOIN article a ON c.id_article=a.id_article";
        $stm=$conn->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function supprimerCommentaire($conn,$id){
        $sql="DELETE FROM commentaire WHERE id_commentaire=:id";
        $stm=$conn->prepare($sql);
        return $stm->execute([':id'=>$id]);
    }


    public static function getCommentaireById($conn, $id)
{
    $sql = "SELECT contenu FROM commentaire WHERE id_commentaire = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public  function modifierCommentaire($conn)
{
    $sql = "UPDATE commentaire SET contenu = :contenu WHERE id_commentaire = :id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':contenu' => $this->nom_commentaire,
        ':id' => $this->id_commentaire
    ]);
}

public function ajauterCommetaire($conn,$id_client,$id_article){
    $sql="INSERT INTO commentaire(contenu,id_client,id_article) VALUES(:contenu,:id_client,:id_article)";
    $stm=$conn->prepare($sql);
    return $stm->execute([
        ':contenu'=>$this->nom_commentaire,
        ':id_client'=>$id_client,
        ':id_article'=>$id_article
    ]);
}



 public static function afficherCommentairesParArticle($conn,$id_article){
        $sql="SELECT c.contenu,c.date_creation,u.nom,a.titre,a.id_article,c.id_commentaire,u.id_user FROM commentaire c INNER JOIN users u ON u.id_user=c.id_client INNER JOIN article a ON c.id_article=a.id_article WHERE a.id_article=:id_article";
        $stm=$conn->prepare($sql);
        $stm->execute([':id_article'=>$id_article]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>