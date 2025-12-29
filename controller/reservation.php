<?php
require_once 'bootstrap.php';

$studentId = $_SESSION['userid'];
$bookId = $_GET['idbook'];
$redirectUrl = $_GET['redirect'];
$bookingRepo->create($studentId, $bookId);
header("Location: $redirectUrl");
exit;
?>