<?php
session_start();

//Costanti
define("BASE_URL", "/UniBook/");
define("UPLOAD_DIR", BASE_URL . "upload/");
// FILESYSTEM (PHP)
define("BASE_PATH", realpath(__DIR__ . "/.."));

//Credenziali admin
define("ADMIN_EMAIL", "admin@unibook.com");
define("ADMIN_PASSWORD", "admin");

require_once(BASE_PATH. BASE_URL . "db/database.php");
require_once(BASE_PATH. BASE_URL . "db/database.php");
require_once(BASE_PATH. BASE_URL . "db/database.php");
require_once(BASE_PATH. BASE_URL . "db/database.php");
require_once(BASE_PATH. BASE_URL . "db/database.php");
require_once(BASE_PATH. BASE_URL . "orm/Student.php");
require_once(BASE_PATH. BASE_URL . "repo/StudentRepository.php");
require_once(BASE_PATH. BASE_URL . "repo/BookingRepository.php");
require_once(BASE_PATH. BASE_URL . "repo/BookRepository.php");
require_once(BASE_PATH. BASE_URL . "repo/CatalogueRepository.php");
require_once(BASE_PATH. BASE_URL . "repo/LoanRepository.php");
require_once(BASE_PATH. BASE_URL . "repo/ReviewRepository.php");
require_once(BASE_PATH. BASE_URL . "repo/TagInBookRepository.php");
require_once(BASE_PATH. BASE_URL . "SessionManager.php");
require_once BASE_PATH. BASE_URL . 'AuthenticationManager.php';

$dbh = new DatabaseHelper("localhost", "root", "", "unibook", 3306);

//Repository
$studentRepo = new StudentRepository($dbh);
$bookingRepo = new BookingRepository($dbh);
$bookRepo = new BookRepository($dbh);
$catalogueRepo = new CatalogueRepository($dbh);
$loanRepo = new LoanRepository($dbh);
$reviewRepo = new ReviewRepository($dbh);
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

?>