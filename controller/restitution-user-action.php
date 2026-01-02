<?php
require_once 'bootstrap.php';
$loanRepo->update($_POST['idstudent'], $_POST['codebook'], $_POST['codeCopy'], 'in_restituzione');
$bookRepo->updateCopyState($_POST['codebook'], $_POST['codeCopy'], 'in_restituzione');
header("Location: " . $_POST['redirect_url']);
?>