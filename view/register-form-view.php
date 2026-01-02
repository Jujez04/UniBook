<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == 'email_exists') {
        echo '<div class="alert alert-danger">L\'email è già registrata. Per favore, usa un\'altra email.</div>';
    } elseif ($error == 'password_mismatch') {
        echo '<div class="alert alert-danger">Le password non corrispondono. Per favore, riprova.</div>';
    } elseif ($error == 'confirm_password_empty') {
        echo '<div class="alert alert-danger">Il campo di conferma della password è vuoto. Per favore, compilalo.</div>';
    }
}
?>

<form action="register-action.php" method="POST" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nome">Nome:</label><input type="text" id="nome" name="nome" />
        </li>
        <li>
            <label for="cognome">Cognome:</label><input type="text" id="cognome" name="cognome" />
        </li>
        <li>
            <label for="email">Email:</label><input type="email" id="email" name="email" />
        </li>
        <li>
            <label for="password">Password:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <label for="confirm_password">Conferma Password:</label><input type="password" id="confirm_password"
                name="confirm_password" />
        </li>
        <li>
            <label for="phone">Telefono:</label><input type="tel" id="phone" name="phone" />
        </li>
        <li>
            <label for="photo">Foto Profilo:</label><input type="file" id="photo" name="photo" />
        </li>
        <li>
            <input type="submit" name="submit" value="Invia" />
        </li>

    </ul>
</form>