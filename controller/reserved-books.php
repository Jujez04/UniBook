<?php
require_once 'bootstrap.php';

$reservedBooks = $bookingRepo->findAllByStudent($_SESSION['userid']);




$templateParams["title"] = "Unibook - Libri prenotati";
$templateParams["content"] = BASE_PATH . "/UniBook/view/reserved-books-view.php";
$templateParams["reserved_books"] = $reservedBooks;
$templateParams["css"] = "user_style.css";
require  BASE_PATH . "/UniBook/" . 'template/base.php';
?>