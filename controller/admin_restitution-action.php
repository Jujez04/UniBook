<?php
require_once "bootstrap.php";

if (!$sessionManager->isAdminLogged()) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin-dashboard.php?error=not_in_post");
    exit;
}

$idStudent = $_POST['idstudent'] ?? null;
$codeBook = $_POST['codebook'] ?? null;
$codeCopy = $_POST['codecopy'] ?? null;

if (!$idStudent || !$codeBook || !$codeCopy) {
    header("Location: admin-dashboard.php?error=missing_data");
    exit;
}

try {
    $loanRepo->update($idStudent, $codeBook, $codeCopy, 'restituito');
    $bookRepo->updateCopyState($codeBook, $codeCopy, 'Disponibile');

    header("Location: admin-dashboard.php?msg=restitution_successful");
} catch (Exception $e) {
    header("Location: admin-dashboard.php?error=db_error");
}
exit;
