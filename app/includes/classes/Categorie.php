<?php


class Categorie {

    private $nom;
    private $description;
    private $status;
    private $image;


     public function __construct($nom,$description,$status,$image){
        $this->nom=$nom;
        $this->description=$description;
        $this->status=$status;
        $this->image=$image;

    }

    public function setNom($nom){
        $this->nom=$nom;
    }

    public function setDescription($description){
        $this->description=$description;
    }

    public function setStatus($status){
        $this->status=$status;
    }

    public function setImage($image){
        $this->image=$image;
    }

 
    public static function afficherCategories($conn) {
        $stmt = $conn->query("SELECT * FROM categories ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   
    public static function supprimerCategorie($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM categories WHERE id_categorie = ?");
        return $stmt->execute([$id]);
    }


    public static function modifierCategorie($conn, $id,$nom,$description,$status,$image) {
        $stmt = $conn->prepare("UPDATE categories SET nom = ?, description = ?, status = ?, image= ? WHERE id_categorie = ?");
        return $stmt->execute([$nom, $description, $status,$image, $id]);
    }

    
    public static function ajouterMasse($conn, $data) {
        $stmt = $conn->prepare("INSERT INTO categories (nom, description, status,image) VALUES (?, ?, ?,?)");
        foreach ($data as $row) {
            $stmt->execute([$row['nom'], $row['description'], $row['status'],$row['image']]);
        }
    }

    public static function getById($conn, $id){
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id_categorie = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public static function getNamesC($conn){
    $sql="SELECT DISTINCT nom,id_categorie FROM categories";
    $stm=$conn->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

public static function getNomCparId($conn,$id){
      $sql="SELECT  nom FROM categories WHERE id_categorie=?";
    $stm=$conn->prepare($sql);
    $stm->execute([$id]);
    return $stm->fetch(PDO::FETCH_ASSOC);
}




public static function countCategorie($conn){
    $stm=$conn->prepare("SELECT * FROM categories");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countCategorieDisponble($conn){
    $stm=$conn->prepare("SELECT * FROM categories where status='1'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countCategorieIndisponible($conn){
    $stm=$conn->prepare("SELECT * FROM categories where status='0'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

}
?>



