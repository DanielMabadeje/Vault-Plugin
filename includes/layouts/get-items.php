<body>

    <?php if ($_SERVER['REQUEST_METHOD'] == "GET" && !$_GET['skr']) { ?>

        <section>
            <div class="form">
                <form action="" method="GET">
                    <div class="form-input">
                        <input type="text" placeholder="Type your SKI here..." name="skr">
                    </div>
                </form>
            </div>
        </section>




    <?php } else {
        $skr = $_GET['skr'];

    ?>

        <?php if (!empty($pageno) or $_GET['pageno'] > 1) {
            $pageno = sanitize_text_field($_GET['pageno']);
        } else {
            $pageno = 1;
        }

        $meta_query = array(
            array(
                'key'     => 'skr',
                'value' => $skr,
                'compare' => 'EXISTS',
            ),
        );

        $items = new WP_Query(
            array(
                'post_type' => 'vaultitems',
                'post_status' => 'any',
                //'author' => $user_id,
                'author' => 'any',
                'posts_per_page' => $posts_per_page,
                'paged' => $pageno,
                'meta_query' => $meta_query,
                // 'tax_query' => array(
                //     'relation' => 'OR',
                //     array(),
                // ),
            )
        );

        if ($items->have_posts()) {

            // var_dump($items->have_posts());
            // die;
        ?>

            <section>
                <div class="container d-flex justify-content-center">
                    <?php
                    while ($items->have_posts()) {

                        $items->the_post();
                        $item_id = get_the_ID();
                        $title=get_the_title($item_id);


                        $duration = get_post_meta($item_id, 'duration', true);
                        $skr = get_post_meta($item_id, 'skr', true);
                        $item_type = get_post_meta($item_id, 'item_type', true);
                        
                        // var_dump($items->title);

                    ?>
                        <figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"> <img src="https://i.imgur.com/MPqUt62.jpg"> </a>
                            <figcaption class="info-wrap">
                                <div class="row">
                                    <div class="col-md-9 col-xs-9"> <span class="rated"><?= $title ?></span> </div>
                                </div>
                            </figcaption>
                            <div class="bottom-wrap-payment">
                                <figcaption class="info-wrap">
                                    <div class="row">
                                        <div class="col-md-9 col-xs-9"> <span class="rated"><?= $skr ?></span> </div>
                                        <div class="col-md-3 col-xs-3">
                                            <div class="rating text-right"></div>
                                        </div>
                                    </div>
                                </figcaption>
                            </div>
                            <!-- <div class="bottom-wrap"> <a href="#" class="btn btn-primary float-right" data-abc="true"> Buy now </a>
                                <div class="price-wrap"> <a href="#" class="btn btn-warning float-left" data-abc="true"> Cancel </a> </div>
                            </div> -->
                        </figure>

                        <!-- gh -->

                    <?php }; ?>

                </div>
            </section>


        <?php
        } else {
        ?>
            <section>
                <div class="card p-5 border-none">
                    <div class="card-body">
                        <h3 class="display-3">You currently do not have any Item in your vault</h3>
                    </div>
                </div>

            </section>
        <?php
        }

        wp_reset_postdata();
        ?>


    <?php  } ?>
</body>