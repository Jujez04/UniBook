<?php
require_once 'bootstrap.php';

$reservedBooks = $bookingRepo->findAllByStudent($_SESSION['id']);




$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = "view/reserved-books-view.php";
$templateParams["home_content"] = $reservedBooks;

require 'template/base.php';
?>