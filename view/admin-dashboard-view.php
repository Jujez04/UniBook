
<section>
    <header>
        <h1 class="text-center">Prenotazioni</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <?php foreach($bookingRepo->findAll() as $booking) :?>
        <li>
            <form action="#">
                <ul>
                    <li>Studente:</li>
                    <li>
                    <?php
                        $student = $studentRepo->findById($booking->getIdStudent());
                        echo $student->getName(). " " . $student->getSurname();
                    ?>
                    </li>
                    <li>Libro:</li>
                    <li>Design Patterns</li>
                    <li>Data:</li>
                    <li>27/11/2025</li>
                    <li>Copie disponibili:</li>
                    <li>200</li>
                </ul>
                <footer>
                    <input type="submit" value="Accetta"/>
                </footer>
            </form>
        </li>
        <?php endforeach; ?>
        <li>
            <form action="#">
                <ul>
                    <li>Studente:</li>
                    <li>Gianni Piergigio</li>
                    <li>Libro:</li>
                    <li>Design Patterns</li>
                    <li>Data:</li>
                    <li>27/11/2025</li>
                    <li>Copie disponibili:</li>
                    <li>200</li>
                </ul>
                <footer>
                    <input type="submit" value="Accetta"/>
                </footer>
            </form>
        </li>
        <li>
            <form action="#">
                <ul>
                    <li>Studente:</li>
                    <li>Gianni Piergigio</li>
                    <li>Libro:</li>
                    <li>Design Patterns</li>
                    <li>Data:</li>
                    <li>27/11/2025</li>
                    <li>Copie disponibili:</li>
                    <li>200</li>
                </ul>
                <footer>
                    <input type="submit" value="Accetta"/>
                </footer>
            </form>
        </li>
    </ul>
</section>
<hr/>
<section>
    <header>
        <h1 class="text-center">Prestiti</h1>
        <img src="../svg/open-collapse.svg" alt="">
    </header>
    <ul>
        <li>
            <form action="#">
                <ul>
                    <li>Studente:</li>
                    <li>Gianni Piergigio</li>
                    <li>Libro:</li>
                    <li>Design Patterns</li>
                    <li>Scadenza:</li>
                    <li>27/11/2025</li>
                    <li>Stato</li>
                    <li>In restituzione</li>
                </ul>
                <footer>
                    <input type="submit" value="Accetta"/>
                </footer>
            </form>
        </li>
    </ul>
</section>