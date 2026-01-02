<?php
require_once BASE_PATH . "/UniBook/" . 'db/database.php';
require_once BASE_PATH . "/UniBook/" . 'orm/Review.php';

class ReviewRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Aggiunge una recensione e la collega al prestito.
     * È un'operazione in due fasi:
     * 1. Inseriamo la recensione nella tabella 'review'.
     * 2. Aggiorniamo la riga del prestito ('loan') con l'ID della nuova recensione.
     */
    public function addReview($idStudent, $codeBook, $codeCopy, $subscriptionDate, $rating, $description)
    {
        $sqlReview = "INSERT INTO review (rating, description) VALUES (?, ?)";
        $this->db->executeQuery($sqlReview, [$rating, $description], 'is');

        $newReviewId = $this->db->getConnection()->insert_id;

        $sqlLoan = "UPDATE loan
                    SET idreview = ?
                    WHERE idstudent = ? AND codebook = ? AND codecopy = ? AND subscriptiondate = ?";

        $this->db->executeStatement($sqlLoan, [
            $newReviewId,
            $idStudent,
            $codeBook,
            $codeCopy,
            $subscriptionDate
        ], 'iiiis');

        return $newReviewId;
    }

    /**
     * Recupera tutte le recensioni di un determinato libro.
     */
    public function getReviewsByBook($codeBook)
    {
        $sql = "SELECT r.*, s.email,s.name, s.surname, l.subscriptiondate
                FROM review r
                JOIN loan l ON r.idreview = l.idreview
                JOIN student s ON l.idstudent = s.idstudent
                WHERE l.codebook = ?
                ORDER BY r.idreview DESC";

        // Ritorna un array associativo con dati recensione + nome studente
        return $this->db->executeQuery($sql, [$codeBook], 'i');
    }

    /**
     * Calcola la media voto di un libro.
     * Utile per mostrare le stelline nel catalogo.
     */
    public function getAverageRating($codeBook)
    {
        $sql = "SELECT AVG(r.rating) as avg_rating, COUNT(*) as total_reviews
                FROM review r
                JOIN loan l ON r.idreview = l.idreview
                WHERE l.codebook = ?";

        $result = $this->db->executeQuery($sql, [$codeBook], 'i');

        // Se non ci sono recensioni, ritorna 0
        return [
            'average' => $result[0]['avg_rating'] ?? 0,
            'count' => $result[0]['total_reviews'] ?? 0
        ];
    }

    /**
     * Cancella una recensione.
     * Bisogna prima scollegarla dal prestito (set null) e poi cancellare la riga review.
     */
    public function deleteReview($idReview)
    {
        $sqlUnlink = "UPDATE loan SET idreview = NULL WHERE idreview = ?";
        $this->db->executeStatement($sqlUnlink, [$idReview], 'i');

        $sqlDelete = "DELETE FROM review WHERE idreview = ?";
        $this->db->executeStatement($sqlDelete, [$idReview], 'i');
    }
}
?>