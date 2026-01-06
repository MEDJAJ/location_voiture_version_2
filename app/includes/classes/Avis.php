<?php

class Avis{
    private $note;
    private $content;
    private $detete_at;
   

    public function __construct($note,$content,$delete_at){
        $this->note=$note;
        $this->content=$content;
        $this->delete_at=$delete_at;
    }
   
    public static function afficherAvis($conn){
        $sql="SELECT a.deleted_at,a.note,a.content,u.nom,v.modele,v.marque,a.id_avis FROM avis a INNER JOIN users u ON u.id_user=a.id_user INNER JOIN vehicules v ON v.id_vehicule=a.id_vehicule";
        $stm=$conn->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
        
    }


    public static function supprimerAvi($conn,$id){
       $sql="UPDATE avis SET deleted_at=:deleted WHERE id_avis=:id";
    $stm=$conn->prepare($sql);
    return $stm->execute([
        ':deleted'=>"0",
        ':id'=>$id
    ]);
        
    }

    public static function getAvisParId($conn,$id){
        $sql="SELECT * FROM avis WHERE id_avis=:id";
        $stm=$conn->prepare($sql);
        $stm->execute([':id'=>$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);   
     
    }

public function modifierAvis($conn,$id){
     $sql = "UPDATE avis SET note = :note, content = :content, deleted_at = :deleted_at WHERE id_avis = :id";
    $stmt = $conn->prepare($sql);
   return $stmt->execute([
        ':note'       => $this->note,
        ':content'    => $this->content,
        ':deleted_at' => $this->delete_at,
        ':id'         => $id
    ]);
}

public static function getAvisParVehicule($conn,$id){
    $sql="SELECT u.nom,a.content,a.note,a.id_user,a.deleted_at FROM avis a INNER JOIN users u ON a.id_user=u.id_user WHERE a.id_vehicule=:id AND a.deleted_at='1'";
    $stm=$conn->prepare($sql);
    $stm->execute([':id'=>$id]);
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

public static function getNomVehiculeMarque($conn){
    $sql = "
        SELECT 
            v.id_vehicule,
            v.modele,
            v.marque
        FROM vehicules v
    ";
    $stm = $conn->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

public function ajauterAvis($conn,$id_user,$id_vehecule){
    $sql="INSERT INTO avis(note,content,deleted_at,id_user,id_vehicule)
    VALUES(:note,:content,:deleted_at,:id_user,:id_vehicule)
    ";
    $stm=$conn->prepare($sql);
  return  $stm->execute([
        ':note'=> $this->note,
        ':content'=> $this->content,
        ':deleted_at'=>$this->delete_at,
        ':id_user'=>$id_user,
        ':id_vehicule'=>$id_vehecule
    
  ]);
}

public static function getAvisParUser($conn,$id_user){
    $sql="SELECT v.modele,v.marque,a.content,a.note,a.deleted_at,a.id_avis,v.image FROM avis a INNER JOIN vehicules v ON v.id_vehicule=a.id_vehicule WHERE id_user=:id";
    $stm=$conn->prepare($sql);
    $stm->execute([':id'=>$id_user]);
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}


public static function modifierdeleteAt($conn,$id_avis){
    $sql="UPDATE avis SET deleted_at=:deleted WHERE id_avis=:id";
    $stm=$conn->prepare($sql);
    return $stm->execute([
        ':deleted'=>"1",
        ':id'=>$id_avis
    ]);
}




 public static function voirAvi($conn,$id){
       $sql="UPDATE avis SET deleted_at=:deleted WHERE id_avis=:id";
    $stm=$conn->prepare($sql);
    return $stm->execute([
        ':deleted'=>"1",
        ':id'=>$id
    ]);
        
    }

}





?>