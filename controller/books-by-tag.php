<?php
require_once 'bootstrap.php';

$homeContent = [];

$tags = $tagRepo->findAll();

foreach($tags as $tag) {
    $books = $bookRepo->findByTag($tag->getIdTag());
    $homeContent[] = [
        'tag_id'   => $tag->getIdTag(),
        'books' => $books
    ];
}

$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = BASE_PATH. "/UniBook/". "view/books-by-tag-view.php";
$templateParams["home_content"] = $homeContent;
$templateParams["css"] = "user_style.css";

require  BASE_PATH. "/UniBook/". 'template/base.php';
?>