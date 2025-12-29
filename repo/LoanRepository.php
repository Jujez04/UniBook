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

        $this->db->executeStatement($sql, [
            $idStudent,
            $codeBook,
            $codeCopy
        ], 'iii');
    }

    public function closeLoan($idStudent, $codeBook, $codeCopy, $subscriptionDate) {
        $sql = "UPDATE loan
                SET state = 'restituito', refunddata = CURDATE()
                WHERE idstudent = ? AND codebook = ? AND codecopy = ? AND subscriptiondate = ?";

        $this->db->executeStatement($sql, [
            $idStudent,
            $codeBook,
            $codeCopy,
            $subscriptionDate
        ], 'iiis');
    }

    public function findActiveLoansByStudent($idStudent) {
        $sql = "SELECT * FROM loan WHERE idstudent = ? AND state = 'attivo'";
        $result = $this->db->executeQuery($sql, [$idStudent], 'i');

        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }

    public function findAllByStudent($idStudent) {
        $sql = "SELECT * FROM loan WHERE idstudent = ? ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql, [$idStudent], 'i');

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