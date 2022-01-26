<?php


get_header();

get_part( 'site-header' );

if( have_posts() ) :
    the_post();
    
    
   

    ?>
<div style="background-image: url(<?php the_field('hero_image')?>); height: 485px;"
    class="w-full  bg-no-repeat bg-cover bg-center flex justify-center items-center text-white page-hero">
    <div class="flex flex-col justify-center w-2/3 my-auto mx-6">
        <h1 class="text-4xl text-center font-light mb-5 recept-title"><?= the_title()  ?></h1>

    </div>
</div>

<?php

    get_part('bread-crumbs');
   
    
    ?>
<div class="recept-wrapper">
    <div class="recept-single flex lg:flex-row flex-col">
        <div class="recept-sidebar sidebar block h-full p-20 text-black text-left text-xl bg-gray-100 leading-8 ">
            <?php the_field('ingredients_list');?></div>
        <div class="recept-content text-xl text-black my-20 lg:pr-52 w-full lg:ml-36 p-4 font-light">
            <?php the_content(); ?>
            <button onClick="window.print()" class="underline text-lg recept-button">Skriv ut recept</button>
        </div>
    </div>
    <div class="call-to-action text-center lg:p-28 p-20"
        style="background-image: url(<?php the_field('book_image')?>); background-repeat:no-repeat; background-size:cover; background-position:center;">
        <h2 class="text-white font-extralight text-5xl">Bli en OFYR-kock</h2>
        <p class="text-white font-extralight text-xl w-full">72 goda recept speciellt framtagna för matlagning på Ofyren
        </p>
        <a href="<?php the_field('book_url_')?>"><button
                class="bg-white text-black hover:bg-black hover:text-white font-light py-4 px-6 rounded-sm mt-8">Upptäck
                boken</button></a>
    </div>
    <?php
endif;?>

    <?php get_part ('single_related')?>
    <?php get_part('more_recept')?>
</div>
<?php wp_reset_postdata();?>
<?php


get_part( 'site-footer' );

get_footer();