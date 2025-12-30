<?php
require_once 'bootstrap.php';
if (isset($_GET["msg"])) {
    if ($_GET["msg"] == "booking_accepted") {
        echo '<div class="alert alert-success">Prenotazione accettata con successo!</div>';
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == "no_copies_available") {
        echo '<div class="alert alert-danger">Errore: Non ci sono copie fisiche libere per questo libro.</div>';
    }
}

?>
<section>
    <header>
        <h1 class="text-center">Prenotazioni</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        $books = $bookRepo->findAll();
        foreach ($books as $book) :
            $quantity = $bookRepo->getAvailableCopiesCount($book->getCodeBook());
            $bookings = $bookingRepo->findBookQueue($book->getCodeBook());

            for ($i = 0; $i < min(count($bookings), $quantity); $i++) :
                $booking = $bookings[$i];
                $student = $studentRepo->findById($booking->getIdStudent());

        ?>
                <li>
                    <form action="<?php echo BASE_URL . "/controller/admin_booking_action.php"; ?>" method="POST">
                        <input type="hidden" name="idstudent" value="<?php echo $booking->getIdStudent(); ?>">
                        <input type="hidden" name="codebook" value="<?php echo $booking->getCodeBook(); ?>">
                        <ul>
                            <li>Studente:</li>
                            <li><?php echo $student->getName() . " " . $student->getSurname(); ?> </li>
                            <li>Libro:</li>
                            <li><?php echo $book->getTitle(); ?></li>
                            <li>Data:</li>
                            <li><?php echo $booking->getDate(); ?></li>
                            <li>Copie disponibili:</li>
                            <li><?php echo $bookRepo->getAvailableCopiesCount($booking->getCodeBook()); ?></li>
                        </ul>
                        <footer>
                            <input type="submit" value="Accetta" />
                        </footer>
                    </form>
                </li>
            <?php endfor ?>
        <?php endforeach; ?>
    </ul>
</section>
<hr />
<section>
    <header>
        <h1 class="text-center">Prestiti</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        foreach ($loanRepo->findAllBorrowed() as $loan) :
            $student = $studentRepo->findById($loan->getIdStudent());
            $book = $bookRepo->findById($loan->getCodeBook());
        ?>
            <li>
                <form action="#">
                    <ul>
                        <li>Studente:</li>
                        <li><?php echo $student->getName() . " " . $student->getSurname(); ?> </li>
                        <li>Libro:</li>
                        <li><?php echo $book->getTitle(); ?></li>
                        <li>Scadenza:</li>
                        <li><?php echo $loan->getRefundData(); ?></li>
                        <li>Stato</li>
                        <li><?php echo $loan->getState(); ?></li>
                    </ul>

                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<hr />
<section>
    <header>
        <h1 class="text-center">In restituzione</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        foreach ($loanRepo->findAllReturning() as $loan) :
            $student = $studentRepo->findById($loan->getIdStudent());
            $book = $bookRepo->findById($loan->getCodeBook());
        ?>
            <li>
                <form action="<?php echo BASE_URL . "/controller/admin_restitution-action.php"; ?>" method="POST">
                    <input type="hidden" name="idstudent" value="<?php echo $loan->getIdStudent(); ?>">
                    <input type="hidden" name="codebook" value="<?php echo $loan->getCodeBook(); ?>">
                    <input type="hidden" name="codecopy" value="<?php echo $loan->getCodeCopy(); ?>">
                    <ul>
                        <li>Studente:</li>
                        <li><?php echo $student->getName() . " " . $student->getSurname(); ?> </li>
                        <li>Libro:</li>
                        <li><?php echo $book->getTitle(); ?></li>
                        <li>Scadenza:</li>
                        <li><?php echo $loan->getRefundData(); ?></li>
                        <li>Stato</li>
                        <li><?php echo $loan->getState(); ?></li>
                    </ul>
                    <footer>
                        <input type="submit" value="Accetta" />
                    </footer>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<hr />
<section>
    <header>
        <h1 class="text-center">Storico</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        foreach ($loanRepo->findAllReturned() as $loan) :
            $student = $studentRepo->findById($loan->getIdStudent());
            $book = $bookRepo->findById($loan->getCodeBook());
        ?>
            <li>
                <form action="<?php echo BASE_URL . "/controller/admin_restitution-action.php"; ?>" method="POST">
                    <input type="hidden" name="idstudent" value="<?php echo $loan->getIdStudent(); ?>">
                    <input type="hidden" name="codebook" value="<?php echo $loan->getCodeBook(); ?>">
                    <input type="hidden" name="codecopy" value="<?php echo $loan->getCodeCopy(); ?>">
                    <ul>
                        <li>Studente:</li>
                        <li><?php echo $student->getName() . " " . $student->getSurname(); ?> </li>
                        <li>Libro:</li>
                        <li><?php echo $book->getTitle(); ?></li>
                        <li>Scadenza:</li>
                        <li><?php echo $loan->getRefundData(); ?></li>
                        <li>Stato</li>
                        <li><?php echo $loan->getState(); ?></li>
                    </ul>

                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</section>