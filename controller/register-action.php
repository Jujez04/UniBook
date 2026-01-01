<?php
require_once 'bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Recupero dei campi di testo
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = $_POST['phone'] ?? '';
    // vedi se l'email è già registrata
    $student = $studentRepo->findByEmail($email);
    if ($student) {
        header("Location: " . BASE_URL . "/controller/register-form.php?error=email_exists");
        exit;
    }
    if ($confirm_password) {
        if ($password !== $confirm_password) {
            header("Location: " . BASE_URL . "/controller/register-form.php?error=password_mismatch");
            exit;
        }
    } else {
        header("Location: " . BASE_URL . "/controller/register-form.php?error=confirm_password_empty");
        exit;
    }
    if ($password !== $confirm_password) {
        header("Location: " . BASE_URL . "/controller/register-form.php?error=password_mismatch");
        exit;
    }
    

    // Gestione del file caricato
    $photo = $_FILES['photo'] ?? null;
    $photoName = '';
    $photoError = '';

    if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $photoSize = $photo['size'];
        $photoType = $photo['type'];

        // Definisci la cartella di destinazione
        $uploadDir = BASE_PATH . "/UniBook/upload/students/";

        // Crea la cartella se non esiste
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Genera un nome univoco per il file
        $photoExtension = pathinfo($photoName, PATHINFO_EXTENSION);
        $newPhotoName = uniqid('profile_', true) . '.' . $photoExtension;
        $photoPath = $uploadDir . $newPhotoName;

        // Sposta il file caricato
        if (move_uploaded_file($photoTmpName, $photoPath)) {
            $photoName = $newPhotoName;
        } else {
            $photoError = 'Errore durante il caricamento della foto';
        }
    } elseif ($photo && $photo['error'] !== UPLOAD_ERR_NO_FILE) {
        $photoError = 'Errore nel caricamento del file: ' . $photo['error'];
    }

    // Visualizza i dati ricevuti
    echo "<h2>Dati ricevuti:</h2>";
    echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
    echo "<p><strong>Cognome:</strong> " . htmlspecialchars($cognome) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Password:</strong> " . str_repeat('*', strlen($password)) . "</p>";
    echo "<p><strong>Conferma Password:</strong> " . str_repeat('*', strlen($confirm_password)) . "</p>";
    echo "<p><strong>Telefono:</strong> " . htmlspecialchars($phone) . "</p>";

    if ($photoName) {
        echo "<p><strong>Foto Profilo:</strong> " . htmlspecialchars($photoName) . "</p>";
        echo "<p><img src='" . htmlspecialchars($uploadDir . $photoName) . "' alt='Foto Profilo' style='max-width: 200px;'></p>";
    }

    if ($photoError) {
        header("Location: " . BASE_URL . "/controller/register-form.php?error=" . urlencode($photoError));
    }
    // Hash della password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $studentRepo->create($nome, $cognome, $email, $passwordHash, $phone, $photoName);
} else {
    header("Location: " . BASE_URL . "/controller/login-form.php");
    exit;
}
$templateParams["title"] = "Unibook - Registrazione";
$templateParams["content"] =  BASE_PATH . "/UniBook/view/register-form-view.php";
$templateParams["css"] = "user_style.css";

header("Location: " . BASE_URL . "/controller/login-form.php");
exit;
?>