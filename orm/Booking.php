<?php

class Booking {
    private $idstudent;
    private $codebook;
    private $date;

    public function __construct($idstudent, $codebook, $date) {
        $this->idstudent = $idstudent;
        $this->codebook = $codebook;
        $this->date = $date;
    }

    public function getIdStudent() {
        return $this->idstudent;
    }

    public function getCodeBook() {
        return $this->codebook;
    }

    public function getDate() {
        return $this->date;
    }
}
?>