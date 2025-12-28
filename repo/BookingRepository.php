<?php
require_once 'db/database.php';
require_once 'orm/Booking.php';

class BookingRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Crea una nuova prenotazione.
     * Inserisce la data odierna (CURDATE()) automaticamente.
     */
    public function create($idStudent, $codeBook) {
        // Prima controlliamo se esiste già (opzionale, ma evita errori SQL brutti)
        if ($this->isBooked($idStudent, $codeBook)) {
            return false; // Già prenotato
        }

        $sql = "INSERT INTO booking (idstudent, codebook, date) VALUES (?, ?, CURDATE())";
        $this->db->executeQuery($sql, [$idStudent, $codeBook]);
        return true;
    }

    /**
     * Cancella una prenotazione (es. l'utente cambia idea o ritira il libro)
     */
    public function delete($idStudent, $codeBook) {
        $sql = "DELETE FROM booking WHERE idstudent = ? AND codebook = ?";
        $this->db->executeQuery($sql, [$idStudent, $codeBook]);
    }

    /**
     * Controlla se uno studente ha già prenotato un certo libro.
     */
    public function isBooked($idStudent, $codeBook) {
        $sql = "SELECT count(*) as total FROM booking WHERE idstudent = ? AND codebook = ?";
        $result = $this->db->executeQuery($sql, [$idStudent, $codeBook]);
        
        return $result[0]['total'] > 0;
    }

    /**
     * Recupera tutte le prenotazioni di uno studente.
     */
    public function findAllByStudent($idStudent) {
        $sql = "SELECT * FROM booking WHERE idstudent = ?";
        $result = $this->db->executeQuery($sql, [$idStudent]);

        $bookings = [];
        foreach ($result as $row) {
            $bookings[] = $this->mapRowToObject($row);
        }
        return $bookings;
    }

    private function mapRowToObject($row) {
        return new Booking(
            $row['idstudent'],
            $row['codebook'],
            $row['date']
        );
    }
}
?>