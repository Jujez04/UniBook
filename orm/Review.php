<?php

class Review
{
    private $idreview;
    private $rating;
    private $description;

    public function __construct($idreview, $rating, $description)
    {
        $this->idreview = $idreview;
        $this->rating = $rating;
        $this->description = $description;
    }

    public function getIdReview()
    {
        return $this->idreview;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
?>