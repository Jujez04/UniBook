<?php
require_once 'bootstrap.php';

$studentLoans = $loanRepo->findAllByStudent($_SESSION['userid']);
$borrowedBooks = [];
foreach ($studentLoans as $loan) {
    $book = $bookRepo->findById($loan->getCodeBook());
    if ($loan->getState() === 'in_restituzione') {
        array_push($borrowedBooks, $loan);
    }
}



$templateParams["title"] = "Unibook - Libri in restituizione";
$templateParams["content"] = BASE_PATH . "/UniBook/view/return-books-view.php";
$templateParams["return_books"] = $borrowedBooks;
$templateParams["css"] = "user_style.css";
require  BASE_PATH . "/UniBook/" . 'template/base.php';
?>