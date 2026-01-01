    <?php
    var_dump($templateParams);
    ?>
    <form action="leave-review-user-action.php" method="POST">

        <ul>
            <li>
                <label for="voto">Voto:</label><select id="voto" name="voto">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </li>
            <li>
                <label for="review">Recensione:</label><textarea id="review" name="review"></textarea>
            </li>
            <li>
                <input type="submit" name="submit" value="Lascia" />
            </li>
        </ul>
        <input type="hidden" name="codebook" value="<?php echo $templateParams['codebook']; ?>">
        <input type="hidden" name="codecopy" value="<?php echo $templateParams['codecopy']; ?>">
        <input type="hidden" name="idstudent" value="<?php echo $templateParams['idstudent']; ?>">
        <input type="hidden" name="subscriptiondate" value="<?php echo $templateParams['subscriptiondate']; ?>">

    </form>