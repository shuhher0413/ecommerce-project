<?php
                                //建立熱銷商品查詢
                                $SQLstring = "SELECT * FROM hot,product,product_img WHERE hot.p_id=product_img.p_id AND hot.p_id=product.p_id AND product_img.sort=1 order by h_sort";
                                $hot = $link->query($SQLstring);
                                ?>
                        <div class="card mt-3" style="border: none;">
                            <div class="card text-center mt-3" style="border: none;">
                                <div class="card-body">
                                    <h5 class="card-title">站長推薦，熱銷商品</h5>
                                </div>
                                <?php while ($date = $hot->fetch()) { ?>
                                    <a href="goods.php?p_id=<?php echo $date['p_id']; ?>">
                                        <img src="product_img/<?php echo $date['img_file']; ?>" class="card-img-top" alt="<?php echo $$date['h_sort']; ?>" title="<?php echo $$date['p_name']; ?>"></a>
                                <?php } ?>
                            </div>
                        </div>
