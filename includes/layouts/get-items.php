<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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


    ?>

</body>

</html>