<?php

class Tag {

    private ?int $id_tag;
    private string $nom_tag;

    public function __construct(string $nom_tag,?int $id_tag = null)
    {
        $this->id_tag = $id_tag;
        $this->nom_tag = $nom_tag;
    }

    public function getNomTag(): string
    {
        return $this->nom_tag;
    }

    public function getIdTag()
    {
        return $this->id_tag;
    }

    public function ajouterTag($conn): bool
    {
        $sql = "INSERT INTO tag(nom_tag) VALUES (:nom)";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':nom' => $this->nom_tag
        ]);
    }

    public static function afficherTags($conn){
        $tages_array=[];
        $sql="SELECT * FROM tag";
        $stm=$conn->prepare($sql);
        $stm->execute();
        $tages=$stm->fetchAll(PDO::FETCH_ASSOC);
        foreach($tages as $tag){
            $tagobjet=new Tag($tag['nom_tag'],$tag['id_tag']);
            $tages_array[]=$tagobjet;
        }

        return $tages_array;
    }

    public static function supprimerTag($conn,$id){
        $sql="DELETE FROM tag WHERE id_tag=:id";
        $stm=$conn->prepare($sql);
        return $stm->execute([
            ':id'=>$id
        ]);
    }


 public static function getTagById($conn,$id):Tag{
   $sql="SELECT * FROM tag WHERE id_tag=:id";
    $stm=$conn->prepare($sql);
    $stm->execute([':id'=>$id]);
   $objet=$stm->fetch(PDO::FETCH_ASSOC);
   return new Tag($objet['nom_tag'],$objet['id_tag']);
    }

    public function modifierTag($conn){
     $sql="UPDATE tag SET nom_tag=:nom_tag WHERE id_tag=:id";
     $stm=$conn->prepare($sql);
     return $stm->execute([':nom_tag'=>$this->nom_tag,':id'=>$this->id_tag]);
    }

    public static function getCountTag($conn){
      $sql="SELECT * FROM tag ";
      $stm=$conn->prepare($sql);
      $stm->execute();
      return count($stm->fetchAll(PDO::FETCH_ASSOC));
    }
}
