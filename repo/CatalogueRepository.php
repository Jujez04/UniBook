<?php
require_once BASE_PATH.  "/UniBook/". 'db/database.php';
require_once BASE_PATH. "/UniBook/". 'orm/Catalogue.php';

class CatalogueRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Restituisce tutti i cataloghi.
     */
    public function findAll() {
        $sql = "SELECT * FROM catalogue";
        $result = $this->db->executeQuery($sql);

        $catalogues = [];
        foreach ($result as $row) {
            $catalogues[] = $this->mapRowToObject($row);
        }
        return $catalogues;
    }

    /**
     * Trova un catalogo specifico per ID.
     */
    public function findById($idCatalogue) {
        $sql = "SELECT * FROM catalogue WHERE idcatalogue = ?";
        $result = $this->db->executeQuery($sql, [$idCatalogue], 'i');

        if (count($result) == 0) {
            return null;
        }

        return $this->mapRowToObject($result[0]);
    }

    /**
     * Recupera i primi n cataloghi casuali (per index)
     */
    public function findRandom($limit) {
        $sql = "SELECT * FROM catalogue ORDER BY RAND() LIMIT " . (int)$limit;
        $result = $this->db->executeQuery($sql);

        $catalogues = [];
        foreach ($result as $row) {
            $catalogues[] = $this->mapRowToObject($row);
        }
        return $catalogues;
    }

    /**
     * (Admin) Crea un nuovo catalogo.
     */
    public function create($name) {
        $sql = "INSERT INTO catalogue (name) VALUES (?)";
        $this->db->executeStatement($sql, [$name], 's');

        return $this->db->getConnection()->insert_id;
    }

    /**
     * (Admin) Rinominare un catalogo.
     */
    public function update($idCatalogue, $newName) {
        $sql = "UPDATE catalogue SET name = ? WHERE idcatalogue = ?";
        $this->db->executeStatement($sql, [$newName, $idCatalogue], 'si');
    }

    /**
     * (Admin) Cancella un catalogo.
     */
    public function delete($idCatalogue) {
        $sql = "DELETE FROM catalogue WHERE idcatalogue = ?";
        $this->db->executeStatement($sql, [$idCatalogue], 'i');
    }

    /**
     * Helper Mapping
     */
    private function mapRowToObject($row) {
        return new Catalogue(
            $row['idcatalogue'],
            $row['name']
        );
    }
}
?>