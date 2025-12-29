<?php
require_once 'bootstrap.php';
$bookId = $_GET['id'] ?? null;
$book = $bookRepo->findById($bookId);
$templateParams["title"] = "Unibook - ". $book->getTitle();

$templateParams["content"] = "view/book-view.php";
require 'template/base.php';
?>