<?php

class Catalogue {
    private $idcatalogue;
    private $name;

    public function __construct($idcatalogue, $name) {
        $this->idcatalogue = $idcatalogue;
        $this->name = $name;
    }

    public function getIdCatalogue() {
        return $this->idcatalogue;
    }

    public function getName() {
        return $this->name;
    }
}
?>