<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $templateParams["title"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/<?php echo $templateParams['css']; ?>">
</head>

<body>

    <nav>
        <div >
            <!-- Sezione Sinistra: Logo e Hamburger -->
            <div >
                <button  type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span ></span>
                </button>
                <a href="index.php" >
                    <img src="/UniBook/svg/logo.svg" alt="UniBook Logo" width="120" />
                </a>
            </div>

            <!-- Sezione Centro: Link Navigazione (desktop) -->
            <div >
                <ul >
                    <li><a href="all-books.php">Libri</a></li>
                </ul>
            </div>

            <!-- Barra di Ricerca Collapsible -->
           

            <!-- Sezione Destra: Icone e Azioni -->
            <div >
                <!-- Dropdown Lingua (desktop) -->
                <div class="dropdown navbar-item desktop-only">
                    <img src="/UniBook/svg/menu-language-desktop-icon.svg" alt="Language" width="32" height="32"
                        class="rounded-circle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Inglese</a></li>
                    </ul>
                </div>

                <!-- Dark Mode Toggle (desktop) -->
                <a id="dark-mode-switch" href="#">
                    <img src="/UniBook/svg/dark-mode-desktop-icon.svg" alt="Dark Mode" width="24" height="24">
                </a>

                <!-- Search Toggle -->
                <a id="searchActivator" data-bs-toggle="collapse" data-bs-target="#searchBar" href="#">
                    <img src="/UniBook/svg/search.svg" alt="Search" width="24" height="24">
                </a>

                <!-- User Profile / Login -->
                <?php if ($sessionManager->isLogged()) : ?>
                <div class="dropdown navbar-item">
                    <?php $student = $studentRepo->findById($_SESSION['userid']); ?>
                    <img src="<?php echo UPLOAD_DIR . 'students/' . htmlspecialchars($student->getProfileImage()); ?>" 
                        alt="Profile" width="32" height="32"
                        class="rounded-circle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="reserved-books.php?id=<?php echo $_SESSION['userid']; ?>">Libri prenotati</a></li>
                        <li><a class="dropdown-item" href="#">Libri in prestito</a></li>
                        <li><a class="dropdown-item" href="#">Libri in restituzione</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <?php else : ?>
                <a class="" href="login-form.php">Login</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Offcanvas Menu Mobile -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    <h5 class="offcanvas-title mx-3">UniBook</h5>
                </div>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between mx-3">
                <ul class="navbar-nav flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link py-2 px-4" href="#">
                            <div class="d-flex flex-row align-items-center">
                                <img src="/UniBook/svg/shop.svg" alt="" width="48" height="48" />
                                <span>Negozio</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-4" href="#">
                            <div class="d-flex flex-row align-items-center">
                                <img src="/UniBook/svg/shop-black.svg" alt="" width="48" height="48" />
                                <span>Negozio</span>
                            </div>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link py-2 px-4" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasLanguage" aria-controls="offcanvasLanguage" href="#">
                            <div class="d-flex flex-row align-items-center">
                                <img src="/UniBook/svg/shop-black.svg" alt="" width="48" height="48" />
                                <span>Cambia Lingua</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-4" href="#">
                            <div class="d-flex flex-row align-items-center">
                                <img src="/UniBook/svg/shop-black.svg" alt="" width="48" height="48" />
                                <span>Cambia tema</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-4" href="#">
                            <div class="d-flex flex-row align-items-center">
                                <img src="/UniBook/svg/shop-black.svg" alt="" width="48" height="48" />
                                <?php if ($sessionManager->isLogged()) : ?>
                                <span>Log out</span>
                                <?php else : ?>
                                <span>Log in</span>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Offcanvas Lingua -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLanguage">
            <div class="offcanvas-header">
                <div class="d-flex align-items-center">
                    <a class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                        <img src="/UniBook/svg/menu-back.svg" alt="">
                    </a>
                    <h5 class="offcanvas-title mx-3">UniBook</h5>
                </div>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between mx-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link py-2 px-4" href="#">Inglese</a>
                    </li>
                </ul>
            </div>
        </div>

         <div class="collapse search-collapse" id="searchBar">
                <form class="search-form">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <button class="btn btn-outline-danger" id="searchCloseBtn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#searchBar" aria-controls="searchBar">Close</button>
                </form>
            </div>
    </nav>

    <main>
        <?php
  
    require $templateParams["content"];
    ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="src/search-bar-toggle.js"></script>

</body>

</html>