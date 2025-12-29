    <form action="login_action.php" method="POST">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                if ($_GET['error'] == 'empty_fields') echo "Inserisci tutti i campi!";
                if ($_GET['error'] == 'credenziali_errate') echo "Email o Password errati.";
                ?>
            </div>
        <?php endif; ?>
        <ul>
            <li>
                <label for="email">Email:</label><input type="text" id="email" name="email" />
            </li>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <li>
                <input type="submit" name="submit" value="Invia" />
            </li>
        </ul>
    </form>
    <!-- rinvio al form di registrazione -->
    <p>Non hai un account? <a href="register-form.php">Registrati qui</a></p>