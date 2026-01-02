<?php
session_start();

//Costanti
define("BASE_URL", "/UniBook/");
define("UPLOAD_DIR", BASE_URL . "upload/");
// FILESYSTEM (PHP)
define("BASE_PATH", realpath(__DIR__ . "/../.."));
define('CONTROLLER_PATH', '/UniBook/controller/');

//Credenziali admin
define("ADMIN_EMAIL", "admin@unibook.com");
define("ADMIN_PASSWORD", "admin");

require_once(BASE_PATH . "/UniBook/" . "db/database.php");
require_once(BASE_PATH . "/UniBook/" . "orm/Student.php");
require_once(BASE_PATH . "/UniBook/" . "repo/StudentRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/BookingRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/BookRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/CatalogueRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/LoanRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/ReviewRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/TagRepository.php");
require_once(BASE_PATH . "/UniBook/" . "repo/TagInBookRepository.php");
require_once("SessionManager.php");
require_once("AuthenticationManager.php");

$dbh = new DatabaseHelper("localhost", "root", "", "unibook", 3306);

//Repository
$studentRepo = new StudentRepository($dbh);
$bookingRepo = new BookingRepository($dbh);
$bookRepo = new BookRepository($dbh);
$catalogueRepo = new CatalogueRepository($dbh);
$loanRepo = new LoanRepository($dbh);
$reviewRepo = new ReviewRepository($dbh);
$tagRepo = new TagRepository($dbh);
$tagInBookRepo = new TagInBookRepository($dbh);

if ($studentRepo->findByEmail(ADMIN_EMAIL) === null) {
    $studentRepo->create(
        "Admin",
        "System",
        ADMIN_EMAIL,
        password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT),
        "0000000000"
    );
}

//Session
$sessionManager = new SessionManager();

//Authentication
$authManager = new AuthenticationManager($studentRepo, $sessionManager);

$templateParams["js"] = ["js/search-bar-toggle.js", "js/search.js", "/js/dark-mode.js"];
?>