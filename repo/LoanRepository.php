<?php
require_once 'orm/Loan.php';
require_once 'db/database.php';

class LoanRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($idStudent, $codeBook, $codeCopy) {
        $sql = "INSERT INTO loan (idstudent, codebook, codecopy, subscriptiondate, state, refunddata, idreview) 
                VALUES (?, ?, ?, CURDATE(), 'attivo', NULL, NULL)";

        $this->db->executeQuery($sql, [
            $idStudent,
            $codeBook,
            $codeCopy
        ]);
    }

    public function closeLoan($idStudent, $codeBook, $codeCopy, $subscriptionDate) {
        $sql = "UPDATE loan 
                SET state = 'restituito', refunddata = CURDATE() 
                WHERE idstudent = ? AND codebook = ? AND codecopy = ? AND subscriptiondate = ?";

        $this->db->executeQuery($sql, [
            $idStudent, 
            $codeBook, 
            $codeCopy, 
            $subscriptionDate
        ]);
    }

    public function findActiveLoansByStudent($idStudent) {
        $sql = "SELECT * FROM loan WHERE idstudent = ? AND state = 'attivo'";
        $result = $this->db->executeQuery($sql, [$idStudent]);

        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }

    public function findAllByStudent($idStudent) {
        $sql = "SELECT * FROM loan WHERE idstudent = ? ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql, [$idStudent]);

        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }

    /**
     * Trova tutti i prestiti in ritardo
     */
    public function findOverdueLoans() {
        $sql = "SELECT * FROM loan 
                WHERE state = 'attivo' 
                AND subscriptiondate < DATE_SUB(CURDATE(), INTERVAL 30 DAY)"; // Scadenza impostata a 30 giorni

        $result = $this->db->executeQuery($sql);

        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }

    /**
     * Recupera i prestiti con i dettagli del libro
     * Ritorna un array associativo misto.
     */
    public function getActiveLoansWithBookDetails($idStudent) {
        $sql = "SELECT l.*, b.title, b.image, b.author 
                FROM loan l
                JOIN book b ON l.codebook = b.codebook
                WHERE l.idstudent = ? AND l.state = 'attivo'";
        
        return $this->db->executeQuery($sql, [$idStudent]);
    }

    private function mapRowToObject($row) {
        return new Loan(
            $row['idstudent'],
            $row['codebook'],
            $row['codecopy'],
            $row['idreview'],
            $row['refunddata'],
            $row['subscriptiondate'],
            $row['state']
        );
    }
}


?>