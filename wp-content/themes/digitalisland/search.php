<?php

get_header();

get_part( 'site-header' );

get_part('wrapper/main-wrapper-start' );
     
    ?>
<div class="search-result-wrapper">
    <h2 class="mb-10 text-xl">Sökresultat för: <i>"<?= get_search_query(); ?>"</i></h2>
    <div class="ofyr-search-results">
        <?php
            
            if (have_posts()) {
                while(have_posts()) {
                        the_post();

                        $thumbnail = get_the_post_thumbnail_url();     

                        ?>

        <a href="<?php the_permalink() ?>" class="w-full bg-gray-100 border border-white swiper-slide post-box">
            <div class="flex flex-col">
                <div class="w-full ">
                    <img class="object-cover object-center w-full" src="<?=$thumbnail?>"></img>
                    <h2 class="px-5 pt-6 text-lg font-normal text-black h-36"><?php the_title() ?></h2>
                    <button class="block px-5 text-black underline "><?= __('Läs mer', 'ofyr') ?></button>
                </div>
            </div>
        </a>


        <?php
                    }
            }

            ?>
    </div>
</div>
<?php



get_part('wrapper/main-wrapper-end');

get_part( 'site-footer' );

get_footer();