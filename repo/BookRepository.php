<?php
require_once 'orm/Book.php';
require_once 'db/database.php';

class BookRepository {
    private $db;

    public function __construct(&$db) {
        $this->db = $db;
    }

    public function findAll() {
        $sql = "SELECT * FROM book";
        $result = $this->db->executeQuery($sql);

        $books = [];
        foreach($result as $row) {
            $books[] = $this->mapRowToObject($row);
        }
        return $books;
    }

    public function findById($codeBook) {
        $sql = "SELECT * FROM book WHERE codebook = ?";
        $result = $this->db->executeQuery($sql, [$codeBook]);

        if(count($result) == 0) {
            return null;
        }
        return $this->mapRowToObject($result[0]);
    }

    public function findByCatalogue($idCatalogue) {
        $sql = "SELECT * FROM book WHERE idcatalogue = ?";
        $result = $this->db->executeQuery($sql, [$idCatalogue]);

        $books = [];
        foreach($result as $row) {
            $books[] = $this->mapRowToObject($row);
        }
        return $books;
    }

    public function search($keyword) {
        $sql = "SELECT * FROM book WHERE title LIKE ? OR author LIKE ?";
        $searchTerm = "%" . $keyword . "%";
        $result = $this->db->executeQuery($sql, [$searchTerm, $searchTerm]);

        $books = [];
        foreach($result as $row) {
            $books[] = $this->mapRowToObject($row);
        }
        return $books;
    }

    public function getAvailableCopiesCount($codeBook) {
        $sql = "SELECT COUNT(*) as total FROM book_copy
                WHERE codebook = ? AND state = 'disponibile'";
        $result = $this->db->executeQuery($sql, [$codeBook]);
        return $result[0]['total'] ?? 0;
    }

    private function mapRowToObject($row) {
        return new Book(
            $row['codebook'],
            $row['title'],
            $row['publisher'],
            $row['publicationyear'],
            $row['image'],
            $row['description'],
            $row['author'],
            $row['idcatalogue']
        );
    }
}

?>