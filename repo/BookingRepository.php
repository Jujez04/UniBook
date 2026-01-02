<?php
require_once BASE_PATH . "/UniBook/" .  'db/database.php';
require_once BASE_PATH . "/UniBook/" . 'orm/Booking.php';

class BookingRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Crea una nuova prenotazione.
     * Inserisce la data odierna (CURDATE()) automaticamente.
     */
    public function create($idStudent, $codeBook)
    {
        if ($this->isBooked($idStudent, $codeBook)) {
            return false;
        }
        $sql = "INSERT INTO booking (idstudent, codebook, date) VALUES (?, ?, NOW())";
        $this->db->executeStatement($sql, [$idStudent, $codeBook], 'ii');
        return true;
    }


    public function getNumberOfPeopleAhead($idStudent, $codeBook)
    {
        $sql = "SELECT COUNT(*) as total FROM booking WHERE codebook = ? AND date < (SELECT date FROM booking WHERE idstudent = ? AND codebook = ?)";
        $result = $this->db->executeQuery($sql, [$codeBook, $idStudent, $codeBook], 'iii');
        return $result[0]['total'];
    }

    public function findBookQueue($codeBook)
    {
        $sql = "SELECT * FROM booking WHERE codebook = ? ORDER BY date ASC";
        $result = $this->db->executeQuery($sql, [$codeBook], 'i');

        $bookings = [];
        foreach ($result as $row) {
            $bookings[] = $this->mapRowToObject($row);
        }
        return $bookings;
    }

    public function findAllFirstPositionReservations()
    {
        $sql = "SELECT b1.* FROM booking b1
                WHERE NOT EXISTS (
                    SELECT 1 FROM booking b2
                    WHERE b2.codebook = b1.codebook AND b2.date < b1.date
                )";
        $result = $this->db->executeQuery($sql, [], '');

        $bookings = [];
        foreach ($result as $row) {
            $bookings[] = $this->mapRowToObject($row);
        }
        return $bookings;
    }

    /**
     * Cancella una prenotazione (es. l'utente cambia idea o ritira il libro)
     */
    public function delete($idStudent, $codeBook)
    {
        $sql = "DELETE FROM booking WHERE idstudent = ? AND codebook = ?";
        $this->db->executeStatement($sql, [$idStudent, $codeBook], 'ii');
    }

    /**
     * Controlla se uno studente ha già prenotato un certo libro.
     */
    public function isBooked($idStudent, $codeBook)
    {
        $sql = "SELECT count(*) as total FROM booking WHERE idstudent = ? AND codebook = ?";
        $result = $this->db->executeQuery($sql, [$idStudent, $codeBook], 'ii');
        return $result[0]['total'] > 0;
    }

    /**
     * Recupera tutte le prenotazioni di uno studente.
     */
    public function findAllByStudent($idStudent)
    {
        $sql = "SELECT * FROM booking WHERE idstudent = ?";
        $result = $this->db->executeQuery($sql, [$idStudent], 'i');

        $bookings = [];
        foreach ($result as $row) {
            $bookings[] = $this->mapRowToObject($row);
        }
        return $bookings;
    }

    /**
     * Recupera tutte le prenotazioni.
     */
    public function findAll()
    {
        $sql = "SELECT * FROM booking";
        $result = $this->db->executeQuery($sql, [], 'i');

        $bookings = [];
        foreach ($result as $row) {
            $bookings[] = $this->mapRowToObject($row);
        }
        return $bookings;
    }


    private function mapRowToObject($row)
    {
        return new Booking(
            $row['idstudent'],
            $row['codebook'],
            $row['date']
        );
    }
}
?>