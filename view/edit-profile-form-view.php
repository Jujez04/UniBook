<?php
if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo '<div class="alert alert-success">Profilo modificato con successo!</div>';
}

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == 'upload_failed') {
        echo '<div class="alert alert-danger">Errore durante il caricamento della foto. Per favore, riprova.</div>';
    } elseif ($error == 'invalid_file_type') {
        echo '<div class="alert alert-danger">Tipo di file non valido. Sono accettate solo immagini (JPG, JPEG, PNG, GIF).</div>';
    } elseif ($error == 'file_too_large') {
        echo '<div class="alert alert-danger">Il file è troppo grande. Dimensione massima: 5MB.</div>';
    } elseif ($error == 'update_failed') {
        echo '<div class="alert alert-danger">Errore durante l\'aggiornamento del profilo. Per favore, riprova.</div>';
    } elseif ($error == 'required_fields') {
        echo '<div class="alert alert-danger">Nome, cognome ed email sono obbligatori.</div>';
    } elseif ($error == 'invalid_email') {
        echo '<div class="alert alert-danger">L\'email inserita non è valida.</div>';
    } elseif ($error == 'email_exists') {
        echo '<div class="alert alert-danger">Questa email è già utilizzata da un altro utente.</div>';
    } else {
        echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
    }
}

// Recupera l'oggetto Student
$student = $templateParams['student'];
?>

<h2>Modifica il tuo Profilo</h2>

<form action="edit-profile-action.php" method="POST" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($student->getName() ?? ''); ?>" required />
        </li>
        <li>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" value="<?php echo htmlspecialchars($student->getSurname() ?? ''); ?>" required />
        </li>
        <li>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student->getEmail() ?? ''); ?>" required />
        </li>
        <li>
            <label for="phone">Telefono:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($student->getPhone() ?? ''); ?>" />
        </li>
        <li>
            <label for="photo">Foto Profilo:</label>
            <?php if (!empty($student->getProfileImage())): ?>
                <div class="current-photo">
                    <img src="<?php echo BASE_URL . '/upload/students/' . htmlspecialchars($student->getProfileImage()); ?>"
                        alt="Foto Profilo Attuale"
                        style="max-width: 150px; display: block; margin-bottom: 10px;" />
                    <small>Foto attuale</small>
                </div>
            <?php endif; ?>
            <input type="file" id="photo" name="photo" accept="image/*" />
            <small>Lascia vuoto per mantenere la foto attuale. Dimensione massima: 5MB</small>
        </li>
        <li>
            <input type="checkbox" id="remove_photo" name="remove_photo" value="1" />
            <label for="remove_photo" style="display: inline;">Rimuovi foto profilo</label>
        </li>
        <li>
            <input type="submit" name="submit" value="Salva Modifiche" /><a href="<?php echo BASE_URL; ?>/index.php">Annulla</a>
        </li>
    </ul>
</form>