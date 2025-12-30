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

if (!$idStudent || !$codeBook) {
    header("Location: admin-dashboard.php?error=missing_data");
    exit;
}

try {

    $codeCopy = $bookRepo->findFirstAvailableCopy($codeBook);
    if ($codeCopy === null) {
        // ERRORE: Non ci sono copie fisiche libere.
        header("Location: admin-dashboard.php?error=no_copies_available");
        exit;
    }

    $loanRepo->create($idStudent, $codeBook, $codeCopy);
    $loanRepo->update($idStudent, $codeBook, $codeCopy, 'in_prestito');
    $bookRepo->updateCopyState($codeBook, $codeCopy, 'In_prestito');
    $bookingRepo->delete($idStudent, $codeBook);

    header("Location: admin-dashboard.php?msg=booking_accepted");
} catch (Exception $e) {
    header("Location: admin-dashboard.php?error=db_error");
}
exit;
