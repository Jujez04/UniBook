<?php

class BookCopy {
    private $codebook;
    private $codecopy;
    private $state;

    public function __construct($codebook, $codecopy, $state) {
        $this->codebook = $codebook;
        $this->codecopy = $codecopy;
        $this->state = $state;
    }

    public function getCodeBook() {
        return $this->codebook;
    }

    public function getCodeCopy() {
        return $this->codecopy;
    }

    public function getState() {
        return $this->state;
    }
}
?>