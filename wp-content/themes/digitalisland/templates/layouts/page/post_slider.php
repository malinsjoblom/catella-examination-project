<?php

$posts_per_page = intval(get_sub_field('count'));


$args = array(
    'post_type' => 'aktuellt-hos-oss',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'date',
    'order'   => 'ASC',
    

);

$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>

<div class="px-2 di-slider-wrapper py-7 lg:px-8 relative container mx-auto <?= implode(' ', $classes) ?>">
    <div class="slider-container flex justify-between pb-12">
        <div class="text-4xl text-black font-extralight justify-start">Aktuellt </div>
        <div class='flex justify-end mt-4 swiper-buttons swiper-buttons--offset'>

            <div class="pr-10 slider-text
            ">Bläddra</div>
            <div class="block mr-4 cursor-pointer swiper-buttons__button swiper-buttons__button--prev">
                <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>

            </div>
            <div class="cursor-pointer swiper-buttons__button swiper-buttons__button--next">
                <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>

            </div>
        </div>
    </div>
    <div class='overflow-x-hidden di-slider'>
        <div class='flex swiper-wrapper'>
            <?php
                while ( $loop->have_posts() ) :
                    $loop->the_post();
                    get_part('/card/post');
                endwhile;
                wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
<?php

endif; // $loop have posts?>