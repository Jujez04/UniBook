<?php
require_once 'db/database.php';
require_once 'orm/Student.php';

class StudentRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Trova studente per Email (Utile per Login e Check duplicati)
     */
    public function findByEmail($email) {
        $sql = "SELECT * FROM student WHERE email = ?";
        $result = $this->db->executeQuery($sql, [$email]);

        if (count($result) == 0) {
            return null;
        }

        return $this->mapRowToObject($result[0]);
    }

    /**
     * Trova studente per ID (Utile per la navigazione dopo il login)
     */
    public function findById($id) {
        $sql = "SELECT * FROM student WHERE idstudent = ?";
        $result = $this->db->executeQuery($sql, [$id]);

        if (count($result) == 0) {
            return null;
        }

        return $this->mapRowToObject($result[0]);
    }

    /**
     * Registra un nuovo studente
     * Ritorna l'ID del nuovo studente o false se fallisce
     */
    public function create($name, $surname, $email, $passwordHash, $phone) {
        // Nota: idstudent è AUTO_INCREMENT, non lo passiamo
        $sql = "INSERT INTO student (name, surname, email, password, phone, profileimage) 
                VALUES (?, ?, ?, ?, ?, 'default.jpg')";

        // Esegue la query
        $this->db->executeQuery($sql, [$name, $surname, $email, $passwordHash, $phone]);

        return true;
    }

    /**
     * Aggiorna i dati profilo (Escluso password ed email per sicurezza)
     */
    public function updateProfile($idStudent, $phone, $profileImage) {
        $sql = "UPDATE student SET phone = ?, profileimage = ? WHERE idstudent = ?";
        $this->db->executeQuery($sql, [$phone, $profileImage, $idStudent]);
    }

    /**
     * Aggiorna solo la password
     */
    public function updatePassword($idStudent, $newPasswordHash) {
        $sql = "UPDATE student SET password = ? WHERE idstudent = ?";
        $this->db->executeQuery($sql, [$newPasswordHash, $idStudent]);
    }

    /**
     * Helper privato per trasformare le righe in oggetti Student
     */
    private function mapRowToObject($row) {
        return new Student(
            $row['phone'],
            $row['password'],
            $row['email'],
            $row['surname'],
            $row['idstudent'],
            $row['profileimage'],
            $row['name']
        );
    }
}
?>