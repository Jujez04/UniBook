<?php

class TagInBook {
    private $codebook;
    private $idtag;

    public function __construct($codebook, $idtag) {
        $this->codebook = $codebook;
        $this->idtag = $idtag;
    }

    public function getCodeBook() {
        return $this->codebook;
    }

    public function getIdTag() {
        return $this->idtag;
    }
}
?>