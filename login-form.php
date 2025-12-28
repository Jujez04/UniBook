<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    // La password che vuoi usare per il tuo utente di test
    $passwordDaUsare = "pwd123"; 

    // Generiamo l'hash
    $hash = password_hash($passwordDaUsare, PASSWORD_DEFAULT);

    echo "<h3>Copia questa stringa nel tuo Database:</h3>";
    echo "<textarea cols='100' rows='2'>" . $hash . "</textarea>";
    ?>
    <nav class=" navbar  d-flex justify-content-center mx-0 w-100 ">
        <div class=" row d-flex justify-content-center align-items-center w-100">

            <div class=" col container-fluid p-0 d-flex align-items-center ms-2 w-1">
                <button class="navbar-toggler  d-md-none mx-0" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="index.html" class=" border border-0 text-decoration-none  p-0">
                    <img src="/UniBook/svg/logo.svg" alt="" width="120" />
                </a>
            </div>
            <div class=" col container d-none d-md-block">
                <ul class="navbar-nav  flex-row justify-content-center  m-0 p-0">
                    <li class="me-2">
                        <a href="" class="btn btn-danger">Negozio</a>
                    </li>
                    <li class="me-2">
                        <a href="" class="btn btn-danger">Negozio</a>
                    </li>
                    <li class="me-2">
                        <a href="" class="btn btn-danger">Negozio</a>
                    </li>
                </ul>
            </div>


            <div class="collapse flex-grow-1 w-100" id="searchBar">
                <form class=" d-flex">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success ms-2 my-2 my-sm-0" type="submit">Search</button>
                    <button class="btn btn-outline-danger ms-2 my-2 my-sm-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#searchBar" aria-controls="searchBar" id="searchCloseBtn">Close</button>
                </form>
            </div>

            <div id="right-container" class="col d-flex ms-auto justify-content-end align-items-center gap-2">
                <div class="dropdown d-none d-md-block me-3">
                    <img src="/UniBook/svg/menu-language-desktop-icon.svg" alt="" width="32" height="32"
                        class="rounded-circle dropdown-toggle  " data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Inglese</a></li>

                    </ul>
                </div>

                <a class="nav-link me-3  d-none d-md-block " id="dark-mode-switch" href="#">
                    <img src="/UniBook/svg/dark-mode-desktop-icon.svg" alt="" width="24" height="24">
                </a>
                <a class="nav-link me-3 " id="searchActivator" data-bs-toggle="collapse" data-bs-target="#searchBar"
                    href="#">
                    <img src="/UniBook/svg/search.svg" alt="" width="24" height="24">
                </a>
                <div class="dropdown">
                    <img src="/UniBook/img/download.jpg" alt="" width="32" height="32"
                        class="rounded-circle dropdown-toggle  " data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLanguage">
                <div class="offcanvas-header">
                    <div class="d-flex align-items-center">
                        <a class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                            <img src="/UniBook/svg/menu-back.svg" alt="">
                        </a>
                        <h5 class="offcanvas-title mx-3" id="offcanvasLanguageNavbarLabel">UniBook</h5>
                    </div>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between mx-3 ">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn py-2 px-4 " aria-current="page" href="#">
                                Inglese
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        <h5 class="offcanvas-title mx-3" id="offcanvasNavbarLabel">UniBook</h5>
                    </div>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between mx-3 ">
                    <ul class="navbar-nav  flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" aria-current="page" href="#">
                                <div class="d-flex flex-row align-items-center ">
                                    <img src="/UniBook/svg/shop.svg" alt="" class="" width="48" height="48" />
                                    <span>Negozio</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn py-2 px-4 " aria-current="page" href="#">
                                <div class="d-flex flex-row align-items-center ">
                                    <img src="/UniBook/svg/shop-black.svg" alt="" class="" width="48" height="48" />
                                    <span>Negozio</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link btn py-2 px-4 " data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasLanguage" aria-controls="offcanvasLanguage"
                                aria-current="page" href="#">
                                <div class="d-flex flex-row align-items-center ">
                                    <img src="/UniBook/svg/shop-black.svg" alt="" class="" width="48" height="48" />
                                    <span>Cambia Lingua</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn py-2 px-4 " aria-current="page" href="#">
                                <div class="d-flex flex-row align-items-center ">
                                    <img src="/UniBook/svg/shop-black.svg" alt="" class="" width="48" height="48" />
                                    <span>Cambia tema</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn py-2 px-4 " aria-current="page" href="#">
                                <div class="d-flex flex-row align-items-center ">
                                    <img src="/UniBook/svg/shop-black.svg" alt="" class="" width="48" height="48" />
                                    <span>Log out</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <form action="login_action.php" method="POST">
            <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                    if($_GET['error'] == 'empty_fields') echo "Inserisci tutti i campi!";
                    if($_GET['error'] == 'credenziali_errate') echo "Email o Password errati.";
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="/UniBook/src/search-bar-toggle.js"></script>
</body>

</html>