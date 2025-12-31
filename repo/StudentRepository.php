<?php
require_once  BASE_PATH . "/UniBook/" .  'db/database.php';
require_once BASE_PATH .  "/UniBook/" . 'orm/Student.php';

class StudentRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Trova studente per Email (Utile per Login e Check duplicati)
     */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM student WHERE email = ?";
        $result = $this->db->executeQuery($sql, [$email], 's');

        if (count($result) == 0) {
            return null;
        }

        return $this->mapRowToObject($result[0]);
    }

    /**
     * Trova studente per ID (Utile per la navigazione dopo il login)
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM student WHERE idstudent = ?";
        $result = $this->db->executeQuery($sql, [$id], 'i');

        if (count($result) == 0) {
            return null;
        }

        return $this->mapRowToObject($result[0]);
    }

    /**
     * Registra un nuovo studente
     * Ritorna l'ID del nuovo studente o false se fallisce
     */
    public function create($name, $surname, $email, $passwordHash, $phone, $profileImage = 'default.jpg')
    {
        // find new idstudent
        $sql = '
            SELECT MAX(idstudent) AS max_id FROM student;
        ';
        $result = $this->db->executeQuery($sql, [], '');
        $newId = ($result[0]['max_id'] ?? 0) + 1;
        // Nota: idstudent è AUTO_INCREMENT, non lo passiamo
        $sql = "INSERT INTO student (name, surname, email, password, phone, profileimage) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Esegue la query
        $this->db->executeStatement($sql, [$name, $surname, $email, $passwordHash, $phone, $profileImage], 'ssssss');

        return true;
    }

    /**
     * Aggiorna i dati profilo (Escluso password ed email per sicurezza)
     */
    public function updateProfile($idStudent, $phone, $profileImage)
    {
        $sql = "UPDATE student SET phone = ?, profileimage = ? WHERE idstudent = ?";
        $this->db->executeStatement($sql, [$phone, $profileImage, $idStudent], 'ssi');
    }

    /**
     * Aggiorna solo la password
     */
    public function updatePassword($idStudent, $newPasswordHash)
    {
        $sql = "UPDATE student SET password = ? WHERE idstudent = ?";
        $this->db->executeStatement($sql, [$newPasswordHash, $idStudent], 'si');
    }

    /**
     * Helper
     */
    private function mapRowToObject($row)
    {
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


    /**
     * Aggiorna i dati di uno studente
     * Aggiungi questo metodo alla classe StudentRepository
     */
    public function update($id, $nome, $cognome, $phone, $photo)
    {
        $query = "UPDATE students SET 
              nome = ?, 
              cognome = ?, 
              phone = ?, 
              photo = ? 
              WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi", $nome, $cognome, $phone, $photo, $id);

        return $stmt->execute();
    }



    /**
     * Aggiorna il profilo completo dello studente (nome, cognome, email, telefono, foto)
     * 
     * @param int $idStudent ID dello studente
     * @param string $name Nome
     * @param string $surname Cognome
     * @param string $email Email
     * @param string $phone Telefono
     * @param string $profileImage Nome file immagine profilo
     * @return bool True se l'aggiornamento ha successo, false altrimenti
     */
    public function updateProfileComplete($idStudent, $name, $surname, $email, $phone, $profileImage)
    {
        $sql = "UPDATE student SET name = ?, surname = ?, email = ?, phone = ?, profileimage = ? WHERE idstudent = ?";
        return $this->db->executeStatement($sql, [$name, $surname, $email, $phone, $profileImage, $idStudent], 'sssssi');
    }
}
