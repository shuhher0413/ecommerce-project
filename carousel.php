<?php
                        // 建立廣告輪播carousel資料查詢
                        $SQLstring = "SELECT * FROM carousel WHERE caro_online=1 ORDER BY caro_sort";
                        $carousel = $link->query($SQLstring);
                        $i = 0; //控制active起動
                        ?>
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <?php for ($i = 0; $i < ($carousel->rowCount()); $i++) { ?>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo activeShow($i, 0); ?>" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                                <?php } ?>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < ($carousel->rowCount()); $i++) { ?>
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo activeShow($i, 0); ?>" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                                        <?php } ?>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php
                                        $i = 0;
                                        while ($date = $carousel->fetch()) { ?>
                                            <div class="carousel-item <?php echo activeShow($i, 0); ?>">
                                                <img src="./product_img/<?php echo $date['caro_pic']; ?>" class="d-block w-100" alt="<?php echo $date['caro_title']; ?>">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5><?php echo $date['caro_title']; ?></h5>
                                                    <p><?php echo $date['caro_content']; ?></p>
                                                </div>
                                            </div>
                                        <?php $i++;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>