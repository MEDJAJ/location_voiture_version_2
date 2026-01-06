<?php
require_once __DIR__ . '/User.php';

class Admin extends User{

    public function __construct($nom,$prenom,$email,$password){
        parent::__construct($nom,$prenom,$email,$password);
    }


    
}
?>