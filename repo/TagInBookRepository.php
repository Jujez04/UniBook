<?php
require_once BASE_PATH . "/UniBook/db/database.php";
require_once BASE_PATH . "/UniBook/orm/Review.php";

class TagInBookRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($codeBook, $idTag)
    {
        $sql = "INSERT INTO tag_in_book (codebook, idtag) VALUES (?, ?)";
        return $this->db->executeStatement($sql, [$codeBook, $idTag], 'is');
    }

    /**
     * Recupera tutti i tag associati a un libro.
     */
    public function getTagsByBook($codeBook)
    {
        $sql = "SELECT t.*
                FROM tag t,tag_in_book tb
                WHERE t.idtag = tb.idtag
                AND tb.codebook = ?";
        return $this->db->executeQuery($sql, [$codeBook], 'i');
    }
}
?>