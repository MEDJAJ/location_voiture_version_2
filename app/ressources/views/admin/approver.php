<?php
require_once '../../../includes/config.php';
require_once '../../../includes/classes/article.php';

$id=isset($_GET['id']) ? $_GET['id'] : 0;

if($id==0){
    die("cette id introvable");
}

if(Article::approverArticle($conn,$id)){
    header('Location: approver_article.php');
    exit;
}

?>