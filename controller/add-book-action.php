<?php
require_once 'bootstrap.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Recupero dei campi di testo
    $titolo = $_POST['titolo'] ?? '';
    $publisher = $_POST['publisher'] ?? '';
    $anno_pubblicazione = $_POST['anno-pubblicazione'] ?? '';
    $descrizione = $_POST['descrizione'] ?? '';
    $autore = $_POST['autore'] ?? '';
    $catalogo = $_POST['catalogo'] ?? '';
    $nuovo_catalogo = $_POST['nuovo-catalogo'] ?? '';
    $tagString = $_POST['tag'] ?? '';
    $numero_copie = $_POST['numero-copie'] ?? '';

    if (empty($titolo) || empty($publisher) || empty($anno_pubblicazione) || empty($descrizione) || empty($autore) || empty($catalogo) || ($catalogo === 'custom' && empty($nuovo_catalogo)) || empty($numero_copie)) {
        header("Location: " . BASE_URL . "/controller/add-book-form.php?error=missing_fields");
        exit;
    }

    if ($catalogo === 'custom' && !empty($nuovo_catalogo)) {
        // Aggiungi il nuovo catalogo al database e ottieni il suo ID
        $newCatalogueId = $catalogueRepo->create($nuovo_catalogo);
        $catalogo = $newCatalogueId;
    }
    // Gestione del file caricato
    $immagine = $_FILES['immagine'] ?? null;
    $immagineName = '';
    $immagineError = '';

    if ($immagine && $immagine['error'] === UPLOAD_ERR_OK) {
        $immagineName = $immagine['name'];
        $immagineTmpName = $immagine['tmp_name'];
        $immagineSize = $immagine['size'];
        $immagineType = $immagine['type'];

        // Definisci la cartella di destinazione
        $uploadDir = BASE_PATH . "/UniBook/upload/books/";

        // Crea la cartella se non esiste
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Genera un nome univoco per il file
        $immagineExtension = pathinfo($immagineName, PATHINFO_EXTENSION);
        $newImmagineName = uniqid('book_', true) . '.' . $immagineExtension;
        $immaginePath = $uploadDir . $newImmagineName;

        // Sposta il file caricato
        if (move_uploaded_file($immagineTmpName, $immaginePath)) {
            $immagineName = $newImmagineName;
        } else {
            $immagineError = 'Errore durante il caricamento della foto';
        }
    } elseif ($immagine && $immagine['error'] !== UPLOAD_ERR_NO_FILE) {
        $immagineError = 'Errore nel caricamento del file: ' . $immagine['error'];
    }



    // Visualizza i dati ricevuti
    echo "<h2>Dati ricevuti:</h2>";
    echo "<p><strong>Titolo:</strong> " . htmlspecialchars($titolo) . "</p>";
    echo "<p><strong>Publisher:</strong> " . htmlspecialchars($publisher) . "</p>";
    echo "<p><strong>Anno Pubblicazione:</strong> " . htmlspecialchars($anno_pubblicazione) . "</p>";
    echo "<p><strong>Descrizione:</strong> " . htmlspecialchars($descrizione) . "</p>";
    echo "<p><strong>Autore:</strong> " . htmlspecialchars($autore) . "</p>";
    echo "<p><strong>Catalogo:</strong> " . htmlspecialchars($catalogo) . "</p>";

    if ($immagineName) {
        echo "<p><strong>Immagine:</strong> " . htmlspecialchars($immagineName) . "</p>";
        echo "<p><img src='" . htmlspecialchars(BASE_URL . "upload/books/" . $immagineName) . "' alt='Immagine' style='max-width: 200px;'/></p>";
    }

    if ($immagineError) {
        header("Location: " . BASE_URL . "/controller/register-form.php?error=" . urlencode($immagineError));
    }

    $newBookId = $bookRepo->create($titolo, $publisher, $anno_pubblicazione, $descrizione, $autore, $immagineName, $catalogo);
    echo "<p><strong>ID del nuovo libro inserito:</strong> " . htmlspecialchars($newBookId) . "</p>";
    $tagArray = stringToArray($tagString);
    foreach ($tagArray as $tag) {
        // Prova a crearlo, se fallisce agisce già, ma non bisogna fare nulla perché la chiave del tag è il nome.
        $tagRepo->create($tag);

        $tagInBookRepo->create($newBookId, $tag);
    }

    $bookRepo->addNewCopies($newBookId, $numero_copie);
} else {
    header("Location: " . BASE_URL . "/controller/login-form.php");
    exit;
}
$templateParams["title"] = "Unibook - Aggiunta Libro";
$templateParams["content"] =  BASE_PATH . "/UniBook/view/add-book-form-view.php";
$templateParams["css"] = "user_style.css";

header("Location: " . BASE_URL . "/controller/add-book-form.php?success=true");
exit;

/**
 * Converte una stringa che contiene tag separati da nuove righe in un array di tag.
 * Rimuove anche eventuali righe vuote.
 */
function stringToArray($tags)
{
    return array_filter(array_map('trim', explode("\n", $tags)));
}
?>