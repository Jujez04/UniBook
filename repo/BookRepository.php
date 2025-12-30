<?php
require_once  BASE_PATH . "/UniBook/" . 'orm/Book.php';
require_once  BASE_PATH . "/UniBook/" . 'db/database.php';

class BookRepository
{
    private $db;

    public function __construct(&$db)
    {
        $this->db = $db;
    }

    public function create($titolo, $publisher, $anno_pubblicazione, $descrizione, $autore, $immagineName, $catalogo)
    {
        $sql = "INSERT INTO book (title, publisher, publicationyear, image, description, author, idcatalogue) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeStatement($sql, [$titolo, $publisher, $anno_pubblicazione, $immagineName, $descrizione, $autore, $catalogo], 'ssisssi');

        return $this->db->getConnection()->insert_id;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM book";
        $result = $this->db->executeQuery($sql);

        $books = [];
        foreach ($result as $row) {
            $books[] = $this->mapRowToObject($row);
        }
        return $books;
    }

    public function findById($codeBook)
    {
        $sql = "SELECT * FROM book WHERE codebook = ?";
        $result = $this->db->executeQuery($sql, [$codeBook], 'i');

        if (count($result) == 0) {
            return null;
        }
        return $this->mapRowToObject($result[0]);
    }

    public function getAuthorByBookId($codeBook)
    {
        $sql = "SELECT author FROM book WHERE codebook = ?";
        $result = $this->db->executeQuery($sql, [$codeBook], 'i');

        if (count($result) == 0) {
            return null;
        }
        return $result[0]['author'];
    }
    public function findByCatalogue($idCatalogue)
    {
        $sql = "SELECT * FROM book WHERE idcatalogue = ?";
        $result = $this->db->executeQuery($sql, [$idCatalogue], 'i');

        $books = [];
        foreach ($result as $row) {
            $books[] = $this->mapRowToObject($row);
        }
        return $books;
    }

    public function search($keyword)
    {
        $sql = "SELECT * FROM book WHERE title LIKE ? OR author LIKE ?";
        $searchTerm = "%" . $keyword . "%";
        $result = $this->db->executeQuery($sql, [$searchTerm, $searchTerm], 'ss');

        $books = [];
        foreach ($result as $row) {
            $books[] = $this->mapRowToObject($row);
        }
        return $books;
    }

    public function addNewCopies($codeBook, $numberOfCopies = 1)
    {
        // Find highest existing codecopy
        $sql = "SELECT MAX(codecopy) as max_codecopy FROM book_copy WHERE codebook = ?";
        $result = $this->db->executeQuery($sql, [$codeBook], 'i');

        $results = [];
        $sql = "INSERT INTO book_copy (codebook, codecopy, state) VALUES (?, ?, 'Disponibile')";
        $startCodeCopy = $result[0]['max_codecopy'] !== null ? $result[0]['max_codecopy'] + 1 : 0;
        for ($i = $startCodeCopy; $i < $startCodeCopy + $numberOfCopies; $i++) {
            $results[] = $this->db->executeStatement($sql, [$codeBook, $i], 'ii');
        }
        return $results;
    }

    public function getAvailableCopiesCount($codeBook)
    {
        $sql = "SELECT COUNT(*) as total FROM book_copy
                WHERE codebook = ? AND state = 'disponibile'";
        $result = $this->db->executeQuery($sql, [$codeBook], 'i');
        return $result[0]['total'] ?? 0;
    }

    public function findFirstAvailableCopy($codeBook)
    {
        $sql = "SELECT codecopy FROM book_copy
                WHERE codebook = ? AND state = 'Disponibile'
                LIMIT 1";
        $result = $this->db->executeQuery($sql, [$codeBook], 'i');

        if (count($result) > 0) {
            return $result[0]['codecopy'];
        }
        return null;
    }

    public function updateCopyState($codeBook, $codeCopy, $newState)
    {
        $sql = "UPDATE book_copy SET state = ? WHERE codebook = ? AND codecopy = ?";
        $this->db->executeStatement($sql, [$newState, $codeBook, $codeCopy], 'sii');
    }

    private function mapRowToObject($row)
    {
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
