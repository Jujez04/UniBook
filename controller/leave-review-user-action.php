<?php
require_once 'bootstrap.php';
$codeBook = $_POST['codebook'] ?? null;
$codeCopy = $_POST['codecopy'] ?? null;
$idStudent = $_POST['idstudent'] ?? null;
$subscriptionDate = $_POST['subscriptiondate'] ?? null;
$rating = $_POST['voto'] ?? null;
$description = $_POST['review'] ?? null;
$reviewRepo->addReview((int)$idStudent, (int)$codeBook, (int)$codeCopy, $subscriptionDate, $rating, $description);
$redirectUrl = "/UniBook/index.php";
header("Location: $redirectUrl");
exit();
