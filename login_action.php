<?php
require_once 'bootstrap.php';



if($authManager->login()) {
    // Login successful
    header("Location: index.php");
    exit;
} else {
    // Login failed, redirect back to login form with error
    header("Location: login-form.php?error=credenziali_errate");
    exit;
}
?>