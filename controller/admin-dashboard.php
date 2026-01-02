<?php

require_once 'bootstrap.php';

$templateParams["title"] = "Unibook - Area Admin";
$templateParams["content"] = BASE_PATH . "/UniBook/view/admin-dashboard-view.php";
$templateParams["css"] = "style.css";
$templateParams["css"] = "style_admin-booking.css";

require BASE_PATH .  "/UniBook/template/base.php";
?>