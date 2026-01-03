<?php
require_once 'bootstrap.php';
?>
<section>
    <div> <img src=<?php echo UPLOAD_DIR . 'books/' . $book->getImage(); ?> alt="Book cover" /> </div>
    <h1><?php echo $book->getTitle(); ?></h1>
    <ul>
        <li><?php echo $book->getAuthor(); ?></li>
        <li><img src=<?php echo BASE_URL . "/svg/light/circle-fill.svg" ?> width="12" height="12" alt="" /> </li>
        <li><?php echo $book->getDescription(); ?></li>
        <li><img src=<?php echo BASE_URL . "/svg/light/circle-fill.svg" ?> width="12" height="12" alt="" /> </li>
        <li><?php echo $book->getPublisher(); ?></li>

    </ul>
    <div>
        <!-- Reviews -->
        <div>
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
                <img src="/UniBook/svg/light/star-fill.svg" width="12" height="12" alt="" class="" />
            <?php endfor; ?>
            <?php if ($fraction > 0) : ?>
                <img src="/UniBook/svg/light/star-half.svg" width="12" height="12" alt="" class="" />
            <?php endif; ?>
            <?php
            for ($i = 0; $i < 5 - $whole - $remainder; $i++) :
            ?>
                <img src="/UniBook/svg/light/star.svg" width="12" height="12" alt="" class="" />
            <?php endfor; ?>
        </div>
        <?php $numAhead = $bookingRepo->getNumberOfPeopleAhead($_SESSION['userid'] ?? -1, $book->getCodeBook()); ?>
        <?php if ($bookRepo->getAvailableCopiesCount($book->getCodeBook()) > 0) : ?>
            <span class="text-success">Disponibile</span>
        <?php else : ?>
            <span class=""><?php echo $numAhead; ?> in coda</span>
        <?php endif;
        // Protocollo (http o https)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

        // Host e URI
        $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        ?>
        <?php if ($sessionManager->isLogged() && !$sessionManager->isAdminLogged()) : ?>
            <?php $studentId = $_SESSION['userid']; ?>
            <?php if ($loanRepo->isBorrowed($studentId, $book->getCodeBook())) :
            ?>
                <a href="#" class="btn btn-secondary px-15">In prestito</a>
            <?php elseif (
                !$bookingRepo->isBooked($studentId, $book->getCodeBook())

            ) : ?>
                <a href=" <?php echo BASE_URL ?>/controller/reservation.php?redirect=<?php echo urlencode($currentUrl); ?>&idbook=<?php echo (int)$book->getCodeBook(); ?>&idstudent=<?php echo $studentId; ?>" class="btn btn-danger px-15">Prenota</a>
            <?php else : ?>
                <a href="#" class="btn btn-secondary px-15 disabled">Prenotato</a>
            <?php endif; ?>
        <?php elseif ($sessionManager->isAdminLogged()) : ?>
            <form action="<?php echo BASE_URL ?>/controller/delete-book-action.php" method="post">
                <input type="hidden" name="idbook" value="<?php echo $book->getCodeBook(); ?>" />
                <input type="submit" value="Elimina" class="btn btn-danger px-15" />
            </form>
        <?php else : ?>
            <a href=" <?php echo BASE_URL  ?>/controller/login-form.php" class="btn btn-danger px-15">Prenota</a>
        <?php endif; ?>


    </div>
    <p>
        <?php echo $book->getPublicationYear(); ?>
    </p>
    <!-- Tag -->
    <ul>
        <?php $tags = $tagInBookRepo->getTagsByBook($book->getCodeBook());
        foreach ($tags as $tag) : ?>
            <li><a href="<?php echo CONTROLLER_PATH . "books-by-tag.php#" . urlencode($tag['idtag']); ?>"><?php echo '#' . $tag['idtag']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</section>
<!-- Recensioni -->
<section>
    <?php $reviews = $reviewRepo->getReviewsByBook($book->getCodeBook());
    ?>
    <h2><?php echo count($reviews) . (count($reviews) == 1 ? ' recensione' : ' recensioni'); ?> </h2>
    <?php foreach ($reviews as $review) : ?>
        <article>
            <?php
            $student = $studentRepo->findByEmail($review['email']);
            ?>
            <img src=<?php echo UPLOAD_DIR . 'students/' . $student->getProfileImage(); ?> alt="profile icon" />
            <div>
                <h3><?php echo $student->getName() . ' ' . $student->getSurname(); ?></h3>
                <?php
                $n = $review['rating'];
                $whole = floor($n);
                $fraction = $n - $whole;
                if ($fraction > 0) {
                    $remainder = 1;
                } else {
                    $remainder = 0;
                }
                ?>
                <div>
                    <?php for ($i = 0; $i < $whole; $i++) : ?>
                        <img src="/UniBook/svg/light/star-fill.svg" width="12" height="12" alt="" />
                    <?php endfor; ?>
                    <?php if ($fraction > 0) : ?>
                        <img src="/UniBook/svg/light/star-half.svg" width="12" height="12" alt="" />
                    <?php endif ?>
                    <?php for ($i = 0; $i < 5 - $whole - $remainder; $i++) : ?>
                        <img src="/UniBook/svg/light/star.svg" width="12" height="12" alt="" />
                    <?php endfor; ?>

                </div>
                <p>
                    <?php echo $review['description']; ?>
                </p>
            </div>
        </article>
    <?php endforeach; ?>

</section>