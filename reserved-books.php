<?php
require_once 'bootstrap.php';

$reservedBooks = $bookingRepo->findAllByStudent($_SESSION['userid']);




$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = "view/reserved-books-view.php";
$templateParams["reserved_books"] = $reservedBooks;

require 'template/base.php';
?>