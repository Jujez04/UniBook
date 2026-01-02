<?php
require_once 'bootstrap.php';

// Setup della pagina
$templateParams["title"] = "UniBook - Domande Frequenti";
$templateParams["content"] = BASE_PATH . "/UniBook/view/faq-view.php";
$templateParams["css"] = "user_style.css";

require BASE_PATH . '/UniBook/template/base.php';
?>