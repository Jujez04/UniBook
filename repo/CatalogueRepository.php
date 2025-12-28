<?php
require_once 'db/database.php';
require_once 'orm/Catalogue.php';

class CatalogueRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Restituisce tutte le categorie.
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
     * Trova una categoria specifica per ID.
     */
    public function findById($idCatalogue) {
        $sql = "SELECT * FROM catalogue WHERE idcatalogue = ?";
        $result = $this->db->executeQuery($sql, [$idCatalogue]);

        if (count($result) == 0) {
            return null;
        }

        return $this->mapRowToObject($result[0]);
    }


    /**
     * (Admin) Crea una nuova categoria.
     */
    public function create($name) {
        $sql = "INSERT INTO catalogue (name) VALUES (?)";
        $this->db->executeQuery($sql, [$name]);
        
        return $this->db->getConnection()->insert_id;
    }

    /**
     * (Admin) Rinominare una categoria.
     */
    public function update($idCatalogue, $newName) {
        $sql = "UPDATE catalogue SET name = ? WHERE idcatalogue = ?";
        $this->db->executeQuery($sql, [$newName, $idCatalogue]);
    }

    /**
     * (Admin) Cancella una categoria.
     */
    public function delete($idCatalogue) {
        $sql = "DELETE FROM catalogue WHERE idcatalogue = ?";
        $this->db->executeQuery($sql, [$idCatalogue]);
    }

    /**
     * Helper Mapping
     */
    private function mapRowToObject($row) {
        // Catalogue ha solo id e name
        return new Catalogue(
            $row['idcatalogue'],
            $row['name']
        );
    }
}
?>