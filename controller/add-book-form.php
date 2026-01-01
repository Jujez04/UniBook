<?php
require_once 'bootstrap.php';

$templateParams["title"] = "Unibook - Aggiungi Libro";
$templateParams["catalogues"] = $catalogueRepo->findAll();

$templateParams["content"] =  BASE_PATH . "/UniBook/view/add-book-form-view.php";
$templateParams["css"] = "user_style.css";

require  '../template/base.php';
?>