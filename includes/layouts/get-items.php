<body>

    <?php if (!empty($pageno) or $_GET['pageno'] > 1) {
        $pageno = sanitize_text_field($_GET['pageno']);
    } else {
        $pageno = 1;
    }

    $meta_query = array(
        array(
            'key'     => 'SKI',
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
    ?>
        <?php
        while ($items->have_posts()) {


        ?>
            <section>
                <div class="container d-flex justify-content-center">
                    <figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"> <img src="https://i.imgur.com/MPqUt62.jpg"> </a>
                        <figcaption class="info-wrap">
                            <div class="row">
                                <div class="col-md-9 col-xs-9"> <a href="#" class="title" data-abc="true">Dell Xtreme 270</a> <span class="rated">Laptops</span> </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="rating text-right"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="rated">Rated 4.0/5</span> </div>
                                </div>
                            </div>
                        </figcaption>
                        <div class="bottom-wrap-payment">
                            <figcaption class="info-wrap">
                                <div class="row">
                                    <div class="col-md-9 col-xs-9"> <a href="#" class="title" data-abc="true">$3,999</a> <span class="rated">VISA Platinum</span> </div>
                                    <div class="col-md-3 col-xs-3">
                                        <div class="rating text-right"> #### 8787 </div>
                                    </div>
                                </div>
                            </figcaption>
                        </div>
                        <div class="bottom-wrap"> <a href="#" class="btn btn-primary float-right" data-abc="true"> Buy now </a>
                            <div class="price-wrap"> <a href="#" class="btn btn-warning float-left" data-abc="true"> Cancel </a> </div>
                        </div>
                    </figure>
                </div>
            </section>

        <?php };
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
    ?>

</body>