<h1 class="text-center">Benvenuti su UniBook</h1>
    <?php foreach($templateParams['home_content'] as $content) : ?>
        <?php $collapse_id = "cat_".$content['catalogue_id'];?>
        <section>
            <div class=" row gap-3 h-auto mb-10 align-items-center">
                <div class="col"></div>
                <h2 class="text-center col"><?php echo $content['catalogue_name']; ?></h2>
                <div class="col">
                    <img src="/UniBook/svg/open-collapse.svg" alt="Toggle Libri Consigliati" data-bs-toggle="collapse"
                        data-bs-target="#<?php echo $collapse_id;?>" class="btn col w-auto">
                </div>
            </div>
            <div class="collapse container-fluid my-2" id="<?php echo $collapse_id;?>">
                <div class="row justify-content-center gap-3">
                    <?php foreach($content['books'] as $book) : ?>
                    <article
                        class="card flex-row  d-flex justify-content-center col-12 col-sm-6  col-md-4 col-lg-3 m-0 p-0">
                        <img src=" /UniBook/img/download.jpg" class=" " alt="immagine libro" />
                        <div class="card-body p-2   ">
                            <h5 class="card-title">
                                <a href="bookPage.php?id=<?php echo $book->getCodeBook(); ?>" class="text-decoration-none text-dark">
                                    <?php echo $book->getTitle(); ?>
                                </a>
                            </h5>
                            <div class="container-flex my-2">
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
                                <img src="/UniBook/svg/circle-fill.svg" width="13" height="13" alt="" class="">
                                <span>Recensioni</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2   ">
                                <span class="">3 in coda</span>
                                <a href="#" class="btn btn-danger px-15">Prenota</a>
                            </div>
                        </div>
                    </article>

                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    <?php endforeach; ?>