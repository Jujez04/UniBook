    <?php foreach ($templateParams['home_content'] as $content) : ?>
        <?php $collapse_id = "cat_" . $content['catalogue_id']; ?>
        <section class="mb-5">
            <div class=" row   h-auto align-items-center">
                <div class="col"></div>
                <h2 class="text-center col"><?php echo $content['catalogue_name']; ?></h2>
                <div class="col">
                    <img src="<?php echo BASE_URL; ?>svg/open-collapse.svg" alt="Toggle Libri Consigliati" data-bs-toggle="collapse"
                        data-bs-target="#<?php echo $collapse_id; ?>" class="btn col w-auto">
                </div>
            </div>
            <div class="collapse show  justify-content-center" id="<?php echo $collapse_id; ?>">
                <div class="row justify-content-center d-flex justify-content-center gap-3">
                    <?php foreach ($content['books'] as $book) : ?>
                        <article
                            class="card flex-row w-25 d-flex justify-content-center col-12 col-sm-6  col-md-4 col-lg-3 m-0 p-0">
                            <img src=" <?php echo BASE_URL; ?>upload/books/<?php echo $book->getImage(); ?>" class="" alt="immagine libro" width="10" height="10" />
                            <div class="card-body p-2   ">
                                <h5 class="card-title">
                                    <a href="<?php echo CONTROLLER_PATH; ?>bookPage.php?id=<?php echo $book->getCodeBook(); ?>" class="text-decoration-none text-dark">
                                        <?php echo $book->getTitle(); ?>
                                    </a>
                                </h5>
                                <div class="container-flex my-2">
                                    <?php
                                    $n = $reviewRepo->getAverageRating($book->getCodeBook())['average'];
                                    $whole = floor($n);
                                    $fraction = $n - $whole;
                                    if ($fraction > 0) {
                                        $remainder = 1;
                                    } else {
                                        $remainder = 0;
                                    }
                                    for ($i = 0; $i < $whole; $i++) :
                                    ?>
                                        <img src="/UniBook/svg/star-fill.svg" width="12" height="12" alt="" class="">
                                    <?php endfor; ?>
                                    <?php if ($fraction > 0) : ?>
                                        <img src="/UniBook/svg/star-half.svg" width="12" height="12" alt="" class="">
                                    <?php endif ?>
                                    <?php
                                    for ($i = 0; $i < 5 - $whole - $remainder; $i++) :
                                    ?>
                                        <img src="/UniBook/svg/star.svg" width="12" height="12" alt="" class="">
                                    <?php endfor; ?>
                                    <img src="/UniBook/svg/circle-fill.svg" width="13" height="13" alt="" class="">
                                    <span>Recensioni</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-2   ">
                                    <span class="">3 in coda</span>
                                    <?php
                                    // Protocollo (http o https)
                                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

                                    // Host e URI
                                    $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                                    ?>
                                    <?php if ($sessionManager->isLogged() && !$sessionManager->isAdminLogged()) : ?>
                                        <?php $studentId = $_SESSION['userid']; ?>
                                        <?php if (!$bookingRepo->isBooked($studentId, $book->getCodeBook())) : ?>
                                            <a href=" <?php echo BASE_URL ?>/controller/reservation.php?redirect=<?php echo urlencode($currentUrl); ?>&idbook=<?php echo (int)$book->getCodeBook(); ?>&idstudent=<?php echo $studentId; ?>" class="btn btn-danger px-15">Prenota</a>
                                        <?php else : ?>
                                            <a href="#" class="btn btn-secondary px-15 disabled">Prenotato</a>
                                        <?php endif; ?>

                                    <?php else : ?>
                                        <a href=" <?php echo BASE_URL  ?>/controller/login-form.php" class="btn btn-danger px-15">Prenota</a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </article>

                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>