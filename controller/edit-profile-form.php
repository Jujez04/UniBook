<?php
require_once 'bootstrap.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['userid'])) {
    header("Location: " . BASE_URL . "/controller/login-form.php");
    exit;
}

// Recupera i dati dell'utente corrente
$student = $studentRepo->findById($_SESSION['userid']);

if (!$student) {
    header("Location: " . BASE_URL . "/controller/login-form.php");
    exit;
}

$templateParams["title"] = "Unibook - Modifica Profilo";
$templateParams["content"] = BASE_PATH . "/UniBook/view/edit-profile-form-view.php";
$templateParams["css"] = "user_style.css";
$templateParams["student"] = $student;

require '../template/base.php';
?>