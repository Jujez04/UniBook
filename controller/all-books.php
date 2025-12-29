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
$templateParams["content"] = BASE_PATH. "/UniBook/". "view/all-books-view.php";
$templateParams["home_content"] = $homeContent;
$templateParams["css"] = "user_style.css";

require  BASE_PATH. "/UniBook/". 'template/base.php';
?>