<?php
require_once BASE_PATH . "/UniBook/" . 'db/database.php';
require_once BASE_PATH . "/UniBook/" . 'orm/Tag.php';

class TagRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($idTag)
    {
        $sql = "INSERT IGNORE INTO tag (idtag) VALUES (?)";
        return $this->db->executeStatement($sql, [$idTag], 's');
    }

    public function findAll() {
        $sql = "SELECT * FROM tag";
        $result = $this->db->executeQuery($sql);
        $tags = [];
        foreach($result as $row) {
            $tags[] = $this->mapRowToObject($row);
        }
        return $tags;
    }

    private function mapRowToObject($row)
    {
        return new Tag(
            $row['idtag']
        );
    }
}
