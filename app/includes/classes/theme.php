<?php
class Theme{
    private string $nom;
    private string $description;
    private ?int $id;

    public function __construct(string $nom,string $description,?int $id = null){
        $this->nom=$nom;
        $this->description=$description;
        $this->id=$id;
    }

    public function setNom($nom){
        $this->nom=$nom;

    }

    public function setDescription($description){
        $this->description=$description;
    }

    public function getNom(){
        return $this->nom;
    }
    
    public function getDescription(){
       return $this->description;
    }

    public function getId(){
       return $this->id;
    }

    public function ajauterTheme($conn){
        $sql="INSERT INTO theme(nom_theme,description) VALUES(:nom,:description)";
        $stm=$conn->prepare($sql);
        return $stm->execute([
          ':nom'=>$this->nom,
          ':description'=> $this->description
        ]);
    }

    public static function  afficherthemes($conn){
        $themes=array();
        $sql="SELECT * FROM theme";
        $stm=$conn->prepare($sql);
        $stm->execute();
       $array=$stm->fetchAll(PDO::FETCH_ASSOC);
       foreach($array as $theme){
        $theme=new Theme($theme['nom_theme'],$theme['description'],$theme['id_theme']);
        array_push($themes,$theme);
       }
       return $themes;
       
    
    }

    public static function supprimerTheme($conn,$id){
        $sql="DELETE FROM theme WHERE id_theme=:theme";
        $stm=$conn->prepare($sql);
       return $stm->execute([
            ':theme'=>$id
        ]);


    }


  public static function getThemeParId($conn, $id){
        $sql="SELECT * FROM theme WHERE id_theme=:id";
      $stm=$conn->prepare($sql);
      $stm->execute([':id'=>$id]);
      $th=$stm->fetch(PDO::FETCH_ASSOC);
      return new Theme($th['nom_theme'],$th['description'],$id);
    }


    public function modifierTheme($conn){
      $sql="UPDATE theme SET nom_theme=:nom , description=:desc WHERE id_theme=:id";
      $stm=$conn->prepare($sql);
      return $stm->execute([
        ':nom'=>$this->nom,
        ':desc'=>$this->description,
        ":id"=>$this->id
      ]);
    }

    public static function getCountTheme($conn){
      $sql="SELECT * FROM theme ";
      $stm=$conn->prepare($sql);
      $stm->execute();
      return count($stm->fetchAll(PDO::FETCH_ASSOC));
    }
}






?>