<?php

class DatabaseHelper {

    private $db;

    public function __construct($servername, $username, $password, $dbname) {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    /**
     * Per query SELECT
     */
    public function executeQuery($query, $params = [], $types = '') {
        $stmt = $this->db->prepare($query);
        if($stmt === false) {
            die("Error in query execution: " . $this->db->error);
        }

        if(!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        if($result === false) {
            $stmt->close();
            return [];
        }

        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }

    /**
     * Per query INSERT, UPDATE, DELETE: Restituisce true/false.
     */
    public function executeStatement($query, $params = [], $types = '') {
        $stmt = $this->db->prepare($query);
        if($stmt === false) {
            die("Error preparing statement: " . $this->db->error);
        }

        if(!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function getConnection() {
        return $this->db;
    }
}

?>