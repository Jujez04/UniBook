<?php
require_once 'db/database.php';
require_once 'orm/student.php';

class StudentRepository {
    private $db;

    public function __construct(&$db) {
        $this->db = $db;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM student WHERE email = ?";

        $result = $this->db->executeQuery($sql, [$email]);

        if(count($result) == 0) {
            return null;
        }

        $row = $result[0];

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