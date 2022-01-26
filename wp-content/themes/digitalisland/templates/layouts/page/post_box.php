<?php

$posts_per_page = intval(get_sub_field('count'));


$args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'date',
    'order'   => 'ASC',
    

);

$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>

<div class="post-main-wrapper max-w-full flex <?= implode(' ', $classes) ?>">
    <div class='flex flex-wrap justify-center post-main-wrapper mb-44'>
        <?php
                while ( $loop->have_posts() ) :
                    $loop->the_post();
                    get_part('/card/post');
                endwhile;
                wp_reset_postdata();
            ?>

    </div>
</div>


<?php

endif; // $loop have posts?>
