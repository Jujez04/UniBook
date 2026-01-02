<?php
require_once 'bootstrap.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['userid'])) {
    header("Location: " . BASE_URL . "/controller/login-form.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userId = $_SESSION['userid'];

    // Recupero dei campi di testo
    $nome = trim($_POST['nome'] ?? '');
    $cognome = trim($_POST['cognome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $removePhoto = isset($_POST['remove_photo']) && $_POST['remove_photo'] == '1';

    // Validazione base
    if (empty($nome) || empty($cognome) || empty($email)) {
        header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=required_fields");
        exit;
    }

    // Validazione email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=invalid_email");
        exit;
    }

    // Recupera i dati attuali dell'utente (restituisce oggetto Student)
    $currentStudent = $studentRepo->findById($userId);
    if (!$currentStudent) {
        header("Location: " . BASE_URL . "/controller/login-form.php");
        exit;
    }

    // Controlla se l'email è stata modificata e se è già in uso da un altro utente
    if ($email !== $currentStudent->getEmail()) {
        $existingStudent = $studentRepo->findByEmail($email);
        if ($existingStudent && $existingStudent->getIdStudent() !== $userId) {
            header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=email_exists");
            exit;
        }
    }

    // Ottieni la foto attuale usando il getter
    $photoName = $currentStudent->getProfileImage();

    // Gestione rimozione foto
    if ($removePhoto) {
        // Elimina il file fisico se esiste e non è la foto di default
        if (!empty($photoName) && $photoName !== 'default.png') {
            $oldPhotoPath = BASE_PATH . "/UniBook/upload/students/" . $photoName;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        $photoName = 'default.png';
    }

    // Gestione del file caricato (solo se non si vuole rimuovere la foto)
    if (!$removePhoto) {
        $photo = $_FILES['photo'] ?? null;

        if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
            // Validazione tipo file
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $photoType = $photo['type'];
            $fileExtension = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));

            if (!in_array($photoType, $allowedTypes) || !in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=invalid_file_type");
                exit;
            }

            // Validazione dimensione file (max 5MB)
            $maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if ($photo['size'] > $maxSize) {
                header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=file_too_large");
                exit;
            }

            $photoTmpName = $photo['tmp_name'];
            $uploadDir = BASE_PATH . "/UniBook/upload/students/";

            // Crea la cartella se non esiste
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Elimina la vecchia foto se esiste e non è la foto di default
            $oldPhoto = $currentStudent->getProfileImage();
            if (!empty($oldPhoto) && $oldPhoto !== 'default.png') {
                $oldPhotoPath = $uploadDir . $oldPhoto;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Genera un nome univoco per il file
            $newPhotoName = uniqid('profile_', true) . '.' . $fileExtension;
            $photoPath = $uploadDir . $newPhotoName;

            // Sposta il file caricato
            if (move_uploaded_file($photoTmpName, $photoPath)) {
                $photoName = $newPhotoName;
            } else {
                header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=upload_failed");
                exit;
            }
        } elseif ($photo && $photo['error'] !== UPLOAD_ERR_NO_FILE) {
            header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=upload_failed");
            exit;
        }
    }

    // Aggiorna i dati nel database usando il metodo updateProfileComplete
    $updateResult = $studentRepo->updateProfileComplete($userId, $nome, $cognome, $email, $phone, $photoName);

    if ($updateResult) {
        header("Location: " . BASE_URL . "/controller/edit-profile-form.php?success=1");
        exit;
    } else {
        header("Location: " . BASE_URL . "/controller/edit-profile-form.php?error=update_failed");
        exit;
    }
} else {
    header("Location: " . BASE_URL . "/controller/edit-profile-form.php");
    exit;
}
?>