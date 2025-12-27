<?php

class DatabaseHelper {

    private $db;

    public function __construct($servername, $username, $password, $dbname) {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function executeQuery($query, $params = []) {
        $stmt = $this->db->prepare($query);
        if($stmt === false) {
            die("Error in query execution: " . $this->db->error);
        }

        if(!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>