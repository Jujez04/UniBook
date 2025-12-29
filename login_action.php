<?php
require_once 'bootstrap.php';



if($authManager->login()) {
    if($sessionManager->isAdminLogged()) {
        header("Location: admin-dashboard.php");
        exit;
    }
    header("Location: index.php");
    exit;
} else {
    header("Location: login-form.php?error=credenziali_errate");
    exit;
}
?>