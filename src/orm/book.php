<?php

class Book {
    private $codebook;
    private $title;
    private $publisher;
    private $description;
    private $image;
    private $publicationyear;
    private $author;
    private $idcatalogue;

    public function __construct(
        $codebook,
        $title,
        $publisher,
        $description,
        $image,
        $publicationyear,
        $author,
        $idcatalogue
    ) {
        $this->codebook = $codebook;
        $this->title = $title;
        $this->publisher = $publisher;
        $this->description = $description;
        $this->image = $image;
        $this->publicationyear = $publicationyear;
        $this->author = $author;
        $this->idcatalogue = $idcatalogue;
    }

    public function getCodebook() {
        return $this->codebook;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPublicationYear() {
        return $this->publicationyear;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getIdCatalogue() {
        return $this->idcatalogue;
    }
}

?>