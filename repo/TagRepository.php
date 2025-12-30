<?php
require_once BASE_PATH . "/UniBook/" .  'db/database.php';

class TagRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($idTag)
    {
        $sql = "INSERT INTO tag (idtag) VALUES (?)";
        return $this->db->executeStatement($sql, [$idTag], 's');
    }
}
