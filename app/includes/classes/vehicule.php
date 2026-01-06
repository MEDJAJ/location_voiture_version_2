<?php
class Vehicle{
     private $modele;
     private $marque;
     private $disponibilite;
     private $id_categorie;
     private $image;

     public function __construct($modele,$marque,$disponible,$id_categorie,$image){
        $this->modele=$modele;
        $this->marque=$marque;
        $this->disponible=$disponible;
        $this->id_categorie=$id_categorie;
        $this->image=$image;
     }


  public static function afficherVehicule($conn) {
        $stmt = $conn->query("SELECT * FROM vehicules ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   
    public static function supprimerVehicule($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM vehicules WHERE id_vehicule= ?");
        return $stmt->execute([$id]);
    }


    public static function modifierVehicule($conn, $id,$modele,$marque,$disponibilite,$id_categorie,$image,$prix) {
        $stmt = $conn->prepare("UPDATE vehicules SET modele = ?, marque = ?, disponibilite = ?,id_categorie= ?, image= ?,prix = ? WHERE id_vehicule = ?");
        return $stmt->execute([$modele, $marque, $disponibilite,$id_categorie, $image,$prix,$id]);
    }

    
    public static function ajouterMasse($conn, $data) {
        $stmt = $conn->prepare("INSERT INTO vehicules (modele, marque, disponibilite,id_categorie,image,prix) VALUES (?, ?, ?,?,?,?)");
        foreach ($data as $row) {
            $stmt->execute([$row['modele'],$row['marque'], $row['disponible'], $row['nom_categorie'],$row['image'],$row['prix']]);
        }
    } 

    public static function getById($conn, $idVehicule, $idCategorie) {
    
    $stmt = $conn->prepare(
        "SELECT * 
         FROM ListeVehicules 
         WHERE id_vehicule = :idVehicule 
           AND id_categorie = :idCategorie"
    );

  
    $stmt->execute([
        ':idVehicule' => $idVehicule,
        ':idCategorie' => $idCategorie
    ]);

   
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public static function getvehiculesParCategorie($conn,$id){
    $sql="SELECT * FROM vehicules WHERE id_categorie=:id";
    $stm=$conn->prepare($sql);
  $stm->execute([':id'=>$id]);
  return $stm->fetchAll(PDO::FETCH_ASSOC);
}






public static function countVehiculesParCategorie($conn, $id){
    $sql = "SELECT COUNT(*) FROM vehicules WHERE id_categorie = :id";
    $stm = $conn->prepare($sql);
    $stm->execute([':id' => $id]);
    return $stm->fetchColumn();
}












public static function countVehiculesFilter($conn, $id, $marque, $dispo) {
    $sql = "SELECT COUNT(*) FROM vehicules WHERE id_categorie = :id";

    if ($marque !== '') {
        $sql .= " AND marque LIKE :marque";
    }
    if ($dispo !== '') {
        $sql .= " AND disponibilite = :dispo";
    }

    $stm = $conn->prepare($sql);
    $stm->bindValue(':id', $id);

    if ($marque !== '') {
        $stm->bindValue(':marque', "%$marque%");
    }
    if ($dispo !== '') {
        $stm->bindValue(':dispo', $dispo);
    }

    $stm->execute();
    return $stm->fetchColumn();
}


public static function getVehiculesFilterPaginated($conn, $id, $marque, $dispo, $limit, $offset) {
    $sql = "SELECT * FROM vehicules WHERE id_categorie = :id";

    if ($marque !== '') {
        $sql .= " AND marque LIKE :marque";
    }
    if ($dispo !== '') {
        $sql .= " AND disponibilite = :dispo";
    }

    $sql .= " LIMIT :limit OFFSET :offset";

    $stm = $conn->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    $stm->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stm->bindValue(':offset', $offset, PDO::PARAM_INT);

    if ($marque !== '') {
        $stm->bindValue(':marque', "%$marque%");
    }
    if ($dispo !== '') {
        $stm->bindValue(':dispo', $dispo);
    }

    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}




public static function countVehicule($conn){
    $stm=$conn->prepare("SELECT * FROM vehicules");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countVehiculeDisponble($conn){
    $stm=$conn->prepare("SELECT * FROM vehicules where disponibilite='1'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countVehiculeIndisponible($conn){
    $stm=$conn->prepare("SELECT * FROM vehicules where disponibilite='0'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}
     

}

?>