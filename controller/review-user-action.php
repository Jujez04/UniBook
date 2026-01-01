<?php
require_once 'bootstrap.php';



$templateParams["title"] = "Unibook - Lascia recensione";
$templateParams["content"] = BASE_PATH . "/UniBook/view/review-view.php";
$templateParams["codebook"] = $_POST['codebook'] ?? null;
$templateParams['codecopy'] = $_POST['codecopy'] ?? null;
$templateParams['idstudent'] = $_POST['idstudent'] ?? null;
$templateParams['subscriptiondate'] = $_POST['subscriptiondate'] ?? null;
$templateParams["css"] = "user_style.css";
require  BASE_PATH . "/UniBook/" . 'template/base.php';
?>