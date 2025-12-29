<?php
require_once 'bootstrap.php';

$randomCatalogues = $catalogueRepo->findAll();

$homeContent = [];

foreach($randomCatalogues as $catalogue) {
    $books = $bookRepo->findByCatalogue($catalogue->getIdCatalogue());
    $homeContent[] = [
        'catalogue_name' => $catalogue->getName(),
        'catalogue_id'   => $catalogue->getIdCatalogue(),
        'books' => $books
    ];

}

$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = "view/all-books-view.php";
$templateParams["home_content"] = $homeContent;

require 'template/base.php';
?>