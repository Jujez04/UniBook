
<section>
    <div> <img src=<?php echo UPLOAD_DIR .'books/'. $book->getImage(); ?> alt="Book cover" /> </div>
    <h1><?php echo $book->getTitle(); ?></h1>
    <ul>
        <li><?php echo $book->getAuthor(); ?></li>
        <li><img src="/svg/circle-fill.svg" width="12" height="12" alt="" /> </li>
        
    </ul>
    <div>
        <!-- Reviews -->
        <div>
           <?php
                $n = $reviewRepo->getAverageRating($book->getCodeBook())['average'];
                $whole = floor($n);
                $fraction = $n - $whole;
                if($fraction > 0) { $remainder = 1; } else { $remainder = 0; }
                for($i = 0; $i < $whole; $i++) :
            ?>
                <img src="/UniBook/svg/star-fill.svg" width="12" height="12" alt="" class="">
            <?php endfor; ?>
            <?php if($fraction > 0) : ?>
                <img src="/UniBook/svg/star-half.svg" width="12" height="12" alt="" class="">
            <?php endif?>
            <?php
                for($i = 0; $i < 5 - $whole - $remainder; $i++) :
            ?>
                <img src="/UniBook/svg/star.svg" width="12" height="12" alt="" class="">
            <?php endfor; ?>
        </div>
        <input type="button" value="Reserve now">
    </div>
    <p>
        <?php echo $book->getDescription(); ?>
    </p>
    <!-- Tag -->
    <ul>
        <li><a href="#">#uml</a></li>
        <li><a href="#">#oop</a></li>
    </ul>
</section>
<!-- Recensioni -->
<section>
    <h2>13 recensioni</h2>
    <article>
        <img src="/profile/default-profle-icon.jpg" alt="profile icon">
        <div>
            <h3>Mario Rossi</h3>
            <div>
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-half.svg" width="12" height="12" alt="">
                <img src="/svg/star.svg" width="12" height="12" alt="">
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod omnis excepturi maxime. Minus
                provident aspernatur iure voluptas ex voluptatibus commodi exercitationem ea officia iste
                vitae, aperiam incidunt delectus fugiat consequatur.
            </p>
        </div>
    </article>
    <article>
        <img src="/profile/default-profle-icon.jpg" alt="profile icon">
        <div>
            <h3>Giovanni Bianchi</h3>
            <div>
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-fill.svg" width="12" height="12" alt="">
                <img src="/svg/star-half.svg" width="12" height="12" alt="">
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod omnis excepturi maxime. Minus
                provident aspernatur iure voluptas ex voluptatibus commodi exercitationem ea officia iste
                vitae, aperiam incidunt delectus fugiat consequatur.
            </p>
        </div>
    </article>
</section>
</section>
	