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
                <form action="#">
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
        <h1 class="text-center">Prestiti</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php
        foreach ($loanRepo->findAll() as $loan) :
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