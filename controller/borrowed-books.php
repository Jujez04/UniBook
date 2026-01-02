<?php
require_once 'bootstrap.php';

$studentLoans = $loanRepo->findAllByStudent($_SESSION['userid']);
$borrowedBooks = [];
foreach ($studentLoans as $loan) {
    $book = $bookRepo->findById($loan->getCodeBook());
    if ($loan->getState() === 'in_prestito') {
        $borrowedBooks[]  = $book;
    }
}



$templateParams["title"] = "Unibook - Home";
$templateParams["content"] = BASE_PATH . "/UniBook/view/borrowed-books-view.php";
$templateParams["borrowed_books_loan"] = $studentLoans;
$templateParams["css"] = "user_style.css";
require  BASE_PATH . "/UniBook/" . 'template/base.php';
?>