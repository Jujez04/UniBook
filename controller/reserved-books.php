<?php
require_once 'bootstrap.php';

$reservedBooks = $bookingRepo->findAllByStudent($_SESSION['userid']);




$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = "view/reserved-books-view.php";
$templateParams["reserved_books"] = $reservedBooks;
$templateParams["css"] = "user_style.css";

require 'template/base.php';
?>