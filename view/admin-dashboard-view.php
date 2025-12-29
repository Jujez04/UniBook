<section>
    <header>
        <h1 class="text-center">Prenotazioni</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        foreach ($bookingRepo->findAll() as $booking) :
            $student = $studentRepo->findById($booking->getIdStudent());
            $book = $bookRepo->findById($booking->getCodeBook());
        ?>
            <li>
                <form action="<?php echo BASE_URL . "/controller/admin_booking_action.php";?>" method="POST">
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
        <?php endforeach; ?>
    </ul>
</section>
<hr />
<section>
    <header>
        <h1 class="text-center">In prestito</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        foreach ($loanRepo->findAllOnLoan() as $loan) :
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
        foreach ($loanRepo->findAllReturining() as $loan) :
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
                    <footer>
                        <input type="submit" value="Accetta" />
                    </footer>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</section>