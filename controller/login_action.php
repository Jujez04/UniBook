<?php
require_once 'bootstrap.php';



if ($authManager->login()) {
    if ($sessionManager->isAdminLogged()) {
        header("Location: admin-dashboard.php");
        exit;
    }
    header("Location: " . BASE_URL . "index.php");
    exit;
} else {
    header("Location: " . BASE_URL . "/controller/login-form.php?error=credenziali_errate");
    exit;
}
