<?php

class  User{
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;

    public function __construct($nom,$prenom,$email,$password){
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
        $this->password=$password;
    }

public function setNom($nom){
    $this->nom=$nom;
}
public function setPrenom($prenom){
    $this->prenom=$prenom;
}
public function setPassword($password){
    $this->password=$password;
}
public function setEmail($email){
    $this->email=$email;
}


    public static function seConnecter($conn,$email,$password){
        $sql="SELECT * FROM users WHERE email=:email";
        $stm=$conn->prepare($sql);
       $stm->execute([":email"=>$email]);
        $user=$stm->fetch(PDO::FETCH_ASSOC);
        if(!$user) return "Email Incorrect";
            if(!password_verify($password,$user["password"])) return "Password Incorrect";

          $_SESSION['id_user']=$user['id_user'];
               $_SESSION['nom']=$user['nom'];
               $_SESSION['role']=$user['role'];

               return true;

    }
}



?>