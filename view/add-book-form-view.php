<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == 'missing_fields') {
        echo '<div class="alert alert-danger">Ci sono campi mancanti. Per favore, compila tutti i campi richiesti.</div>';
    }
}
if (isset($_GET["success"])) {
    echo '<div class="alert alert-success">Libro inserito correttamente!</div>';
}
?>

<form action="add-book-action.php" method="POST" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="titolo">Titolo:</label><input required type="text" id="titolo" name="titolo" />
        </li>
        <li>
            <label for="autore">Autore:</label><input required type="text" id="autore" name="autore" />
        </li>
        <li>
            <label for="publisher">Publisher:</label><input required type="text" id="publisher" name="publisher" />
        </li>
        <li>
            <label for="anno-pubblicazione">Anno pubblicazione:</label><input required type="number" id="anno-pubblicazione" name="anno-pubblicazione" min="0" max="9999" />
        </li>
        <li>
            <label for="descrizione">Descrizione:</label><textarea required id="descrizione" name="descrizione"></textarea>
        </li>
        <li>
            <label for="immagine">Immagine:</label><input required type="file" id="immagine" name="immagine" />
        </li>
        <li>
            <label for="numero-copie">Numero copie:</label><input required type="number" id="numero-copie" name="numero-copie" />
        </li>
        <li>
            <label for="catalogo">Catalogo:</label><select required id="catalogo" name="catalogo">
                <option disabled selected value> &mdash; Seleziona un catalogo &mdash; </option>
                <option value="custom">Nuovo catalogo...</option>
                <?php foreach ($templateParams["catalogues"] as $catalogue): ?>
                    <option value="<?php echo $catalogue->getIdCatalogue() ?>">
                        <?php echo $catalogue->getName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </li>
        <li>
            <label for="nuovo-catalogo">Nome nuovo catalogo:</label><input type="text" id="nuovo-catalogo" name="nuovo-catalogo" />
        </li>
        <li>
            <label for="tag" title="Inserisci un tag per riga senza #">Tag<sup><strong>&#9432;</strong></sup>:</label><textarea id="tag" name="tag"></textarea>
        </li>
        <li>
            <input type="submit" name="submit" value="Invia" />
        </li>
    </ul>
</form>