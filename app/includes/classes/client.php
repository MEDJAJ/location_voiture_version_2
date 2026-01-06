<?php
require_once __DIR__ . '/User.php';


class Client extends User{
  private $role;

  public function __construct($nom,$prenom,$email,$password,$role){
    parent::__construct($nom,$prenom,$email,$password);
    $this->role=$role;
  }

  public function setRole($role){
    $this->role=$role;
  }


  public function register($conn){
    $sql="INSERT INTO users(nom,prenom,role,email,password)
    
    VALUES(:nom,:prenom,:role,:email,:password) ";
    $stm=$conn->prepare($sql);
      return $stm->execute(
        [
            ':nom'=>$this->nom,
            ':prenom'=>$this->prenom,
            ':role'=>$this->role,
            ':email'=>$this->email,
            ':password'=>$this->password
        ]
        );

  }


  public static function countClient($conn){
    $sql="SELECT * FROM users Where role='client' ";
    $stm=$conn->prepare($sql);
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
  } 
}




?>