<?php

class Tag {
    private $idtag;

    public function __construct($idtag) {
        $this->idtag = $idtag;
    }

    public function getIdTag() {
        return $this->idtag;
    }
}
?>