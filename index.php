<?php
require_once 'bootstrap.php';

$randomCatalogues = $catalogueRepo->findRandom(3);

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
$templateParams["content"] = "view/index-view.php";
$templateParams["home_content"] = $homeContent;
$templateParams["css"] = "user_style.css";

require 'template/base.php';
?>