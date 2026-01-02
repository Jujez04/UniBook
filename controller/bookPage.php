<?php
require_once 'bootstrap.php';
$bookId = $_GET['id'] ?? null;
$book = $bookRepo->findById($bookId);
$templateParams["title"] = "Unibook - " . $book->getTitle();

$templateParams["content"] =  BASE_PATH . "/UniBook/view/book-view.php";
$templateParams["css"] = "user_style.css";

require '../template/base.php';
