<?php
require_once BASE_PATH .  "/UniBook/" . 'orm/Loan.php';
require_once BASE_PATH . "/UniBook/" . 'db/database.php';


class LoanRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($idStudent, $codeBook, $codeCopy)
    {
        $date = date('Y-m-d');

        $sql = "INSERT INTO loan (idstudent, codebook, codecopy, subscriptiondate, state, refunddata, idreview)
            VALUES (?, ?, ?, ?, 'in_prestito', NULL, NULL)";

        $this->db->executeStatement($sql, [
            $idStudent,
            $codeBook,
            $codeCopy,
            $date
        ], 'iiis');
    }
    public function update($idStudent, $codeBook, $codeCopy, $state)
    {
        $sql = "UPDATE loan
                SET state = ?
                WHERE idstudent = ? AND codebook = ? AND codecopy = ?";

        $this->db->executeStatement($sql, [
            $state,
            $idStudent,
            $codeBook,
            $codeCopy
        ], 'siii');
    }
    public function findAll()
    {
        $sql = "SELECT * FROM loan ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql);
        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }

    public function findAllBorrowed()
    {
        $sql = "SELECT *
                FROM loan
                WHERE state = 'in_prestito'
                ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql);
        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }
    public function findAllReturned()
    {
        $sql = "SELECT *
                FROM loan
                WHERE state = 'restituito'
                ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql);
        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }
    public function findAllReturning()
    {
        $sql = "SELECT *
                FROM loan
                WHERE state = 'in_restituzione'
                ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql);
        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }


    public function closeLoan($idStudent, $codeBook, $codeCopy, $subscriptionDate)
    {
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

    public function findActiveLoansByStudent($idStudent)
    {
        $sql = "SELECT * FROM loan WHERE idstudent = ? AND state = 'attivo'";
        $result = $this->db->executeQuery($sql, [$idStudent], 'i');

        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }
        return $loans;
    }

    public function findAllByStudent($idStudent)
    {
        $sql = "SELECT * FROM loan WHERE idstudent = ? ORDER BY subscriptiondate DESC";
        $result = $this->db->executeQuery($sql, [$idStudent], 'i');

        $loans = [];
        foreach ($result as $row) {
            $loans[] = $this->mapRowToObject($row);
        }


        return $loans;
    }

    public function isBorrowed($idStudent, $codeBook)
    {
        $sql = "SELECT COUNT(*) as count
                FROM loan
                WHERE idstudent = ? AND codebook = ? AND state = 'in_prestito'";

        $result = $this->db->executeQuery($sql, [
            $idStudent,
            $codeBook
        ], 'ii');

        return $result[0]['count'] > 0;
    }

    /**
     * Trova tutti i prestiti in ritardo
     */
    public function findOverdueLoans()
    {
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

    public function hasBeenReviewed($idStudent, $codeBook)
    {
        $sql = "SELECT COUNT(*) as count
                FROM loan
                WHERE idstudent = ? AND codebook = ? AND idreview IS NOT NULL";

        $result = $this->db->executeQuery($sql, [
            $idStudent,
            $codeBook
        ], 'ii');

        return $result[0]['count'] > 0;
    }
    private function mapRowToObject($row)
    {
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