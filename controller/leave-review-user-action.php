<?php
require_once 'bootstrap.php';
$codeBook = $_POST['codebook'] ?? null;
$codeCopy = $_POST['codeCopy'] ?? null;
$idStudent = $_POST['idstudent'] ?? null;
$subscriptionDate = $_POST['subscriptiondate'] ?? null;
$rating = $_POST['voto'] ?? null;
$description = $_POST['review'] ?? null;
$reviewRepo->addReview($idStudent, $codeBook, $codeCopy, $subscriptionDate, $rating, $description);
$redirectUrl = $_POST['redirect_url'] ?? BASE_PATH .  '/UniBook/index.php';
header("Location: $redirectUrl");
exit();
