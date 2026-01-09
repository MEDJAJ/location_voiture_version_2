<?php
require_once '../../../includes/classes/tag.php';
class Article
{
    private ?int $id_article;
    private string $titre;
    private string $contenu;
    private string $etat;
    public array $tags = [];
    private ?string $date_creation;
    public function __construct(
        string $titre,
        string $contenu,
        string $etat,
        ?int $id_article = null,
        ?string $date_creation=null
    ){
        $this->id_article = $id_article;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->etat = $etat;
        $this->date_creation=$date_creation;
    }


 
    public function getId(): ?int
    {
        return $this->id_article;
    }

   
    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function getEtat()
    {
        return $this->etat;
    }

   public function getTags(): array {
    return $this->tags;
}



    public function addTag(Tag $tag): void {
        $this->tags[] = $tag;
    }

      public function getDateCreation(): string
    {
        return $this->date_creation;
    }

   


    public static function afficherArticles($conn){
        $articles_array=[];
      $sql="SELECT a.id_article,a.titre,a.contenu,a.etat,t.nom_theme FROM article a INNER JOIN theme t ON a.id_theme=t.id_theme";
      $stm=$conn->prepare($sql);
      $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function approverArticle($conn,$id_article){
        $sql="UPDATE article SET etat=:etat WHERE id_article=:id";
        $stm=$conn->prepare($sql);
        return $stm->execute([
            ':etat'=>"PUBLIE",
            ':id'=>$id_article
        ]);
    } 

    public static function supprimerArticle($conn,$id){
        $sql="DELETE FROM article WHERE id_article=:id";
         $stm=$conn->prepare($sql);
        return $stm->execute([
            ':id'=>$id
        ]);

    }




   public static function getArticlesWithTags($pdo,$id)
{

        $articles = [];
    $sql = "
        SELECT 
    a.id_article AS article_id,
    a.titre,
    a.contenu,
    t.id_tag AS tag_id,
    t.nom_tag AS tag_name,
    a.date_creation,
    a.etat,
    a.id_theme
FROM article a
LEFT JOIN articletag ta ON a.id_article = ta.id_article
LEFT JOIN tag t ON ta.id_tag = t.id_tag WHERE a.id_theme=:id 
ORDER BY a.id_article";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id'=>$id]);

$articles_tags=$stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($articles_tags as $row) {

        $articleId = (int) $row['article_id'];

       
        if (!isset($articles[$articleId])) {
            $articles[$articleId] = new Article(
                $row['titre'],
                $row['contenu'],
                $row['etat'],
                 $articleId,
                $row['date_creation']
            );
        }

  
        if (!empty($row['tag_id'])){
            $articles[$articleId]->addTag(
                new Tag(
                    $row['tag_name'],
                    (int) $row['tag_id']
                )
            );
        }
         
         
    }


    return $articles;
}



   public function save( $conn,$id_clent,$id_theme)
    {
        $sql = "INSERT INTO article (titre, contenu,etat,id_client,id_theme) VALUES (:titre, :contenu,:etat,:id_client,:id_theme)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':titre' => $this->titre,
            ':contenu' => $this->contenu,
            ':etat'=>$this->etat,
            ':id_client'=>$id_clent,
            ':id_theme'=>$id_theme
        ]);

        return $conn->lastInsertId(); 
    }







    public static function searchArticlesByTitle($pdo, $id_theme, $keyword)
{
    $articles = [];

    $sql = "
        SELECT 
            a.id_article AS article_id,
            a.titre,
            a.contenu,
            a.etat,
            a.date_creation,
            t.id_tag,
            t.nom_tag
        FROM article a
        LEFT JOIN articletag at ON a.id_article = at.id_article
        LEFT JOIN tag t ON at.id_tag = t.id_tag
        WHERE a.id_theme = :id_theme
          AND a.titre LIKE :keyword
        ORDER BY a.date_creation DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_theme' => $id_theme,
        ':keyword'  => '%'. $keyword .'%'
    ]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $articleId = (int) $row['article_id'];

        if (!isset($articles[$articleId])) {
            $articles[$articleId] = new Article(
                $row['titre'],
                $row['contenu'],
                $row['etat'],
                $articleId,
                $row['date_creation']
            );
        }

        if (!empty($row['id_tag'])) {
            $articles[$articleId]->addTag(
                new Tag($row['nom_tag'], (int)$row['id_tag'])
            );
        }
    }

    return $articles;
}






}



?>