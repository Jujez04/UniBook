<?php
?>
<section>
    <div> <img src=<?php echo UPLOAD_DIR . 'books/' . $book->getImage(); ?> alt="Book cover" /> </div>
    <h1><?php echo $book->getTitle(); ?></h1>
    <ul>
        <li><?php echo $book->getAuthor(); ?></li>
        <li><img src=<?php echo BASE_URL . "/svg/circle-fill.svg" ?> width="12" height="12" alt="" /> </li>
        <li><?php echo $book->getDescription(); ?></li>
        <li><img src=<?php echo BASE_URL . "/svg/circle-fill.svg" ?> width="12" height="12" alt="" /> </li>
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
                <img src="/UniBook/svg/star-fill.svg" width="12" height="12" alt="" class="">
            <?php endfor; ?>
            <?php if ($fraction > 0) : ?>
                <img src="/UniBook/svg/star-half.svg" width="12" height="12" alt="" class="">
            <?php endif; ?>
            <?php
            for ($i = 0; $i < 5 - $whole - $remainder; $i++) :
            ?>
                <img src="/UniBook/svg/star.svg" width="12" height="12" alt="" class="">
            <?php endfor; ?>
        </div>
        <input type="submit" value="Reserve now">

    </div>
    <p>
        <?php echo $book->getPublicationYear(); ?>
    </p>
    <!-- Tag -->
    <ul>
        <?php $tags = $tagInBookRepo->getTagsByBook($book->getCodeBook());
        foreach ($tags as $tag) : ?>
            <li><a href="#"><?php echo '#' . $tag['idtag']; ?></a></li>
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
            <img src=<?php echo UPLOAD_DIR . 'profiles/' . $student->getProfileImage(); ?> alt="profile icon">
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
                        <img src="/UniBook/svg/star-fill.svg" width="12" height="12" alt="">
                    <?php endfor; ?>
                    <?php if ($fraction > 0) : ?>
                        <img src="/UniBook/svg/star-half.svg" width="12" height="12" alt="">
                    <?php endif ?>
                    <?php for ($i = 0; $i < 5 - $whole - $remainder; $i++) : ?>
                        <img src="/UniBook/svg/star.svg" width="12" height="12" alt="">
                    <?php endfor; ?>

                </div>
                <p>
                    <?php echo $review['description']; ?>
                </p>
            </div>
        </article>
    <?php endforeach; ?>

</section>