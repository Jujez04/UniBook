<?php
require_once 'bootstrap.php';

$loans = $loanRepo->findAllByStudent($_SESSION['userid']);
$returnedBooksLoans = [];
foreach ($loans as $loan) {
    $book = $bookRepo->findById($loan->getCodeBook());
    if ($loan->getState() === 'restituito') {
        array_push($returnedBooksLoans, $loan);
    }
}



$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = BASE_PATH . "/UniBook/view/returned-books-view.php";
$templateParams["returned_books_loans"] = $returnedBooksLoans;
$templateParams["css"] = "user_style.css";
require  BASE_PATH . "/UniBook/" . 'template/base.php';
