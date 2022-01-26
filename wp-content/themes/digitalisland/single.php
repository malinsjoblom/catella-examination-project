<?php


get_header();

get_part( 'site-header' );

if( have_posts() ) :
    the_post();
    $hero_img_url = get_the_post_thumbnail_url(get_the_ID());
    /*acf fields*/

    ?>
<div style="background-image: url('<?php echo $hero_img_url;?>'); height: 485px;"
    class="w-full py-32 bg-no-repeat bg-cover bg-center flex justify-center text-white">
    <div class="flex flex-col justify-center w-2/3 my-auto mx-6">
        <h1 class="text-4xl text-center font-light mb-5 container mx-auto"><?= the_title()  ?></h1>
    </div>
</div>

<?php

    get_part('bread-crumbs');
   
    
    ?>
<div class="container mx-auto lg:pl-10 pl-4">
    <div class="text-xl text-black  mt-10" id="single-post-content">
        <?php the_content(); ?>
    </div>
</div>
<?php
endif;
 


get_part('post-loop');

get_part( 'site-footer' );

get_footer();