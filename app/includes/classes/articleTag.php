<?php


class ArticleTag
{
    private int $id_article;
    private int $id_tag;

    public function __construct(int $id_article, int $id_tag)
    {
        $this->id_article = $id_article;
        $this->id_tag = $id_tag;
    }

    public function save($conn)
    {
        $sql = "INSERT INTO articletag (id_article, id_tag)
                VALUES (:article, :tag)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':article' => $this->id_article,
            ':tag' => $this->id_tag
        ]);
    }
}
 ?>