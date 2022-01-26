<?php


get_header();
get_part( 'site-header' );
get_part('bread-crumbs');
if( have_posts() ) :
    the_post();
    $hero_img_url = get_the_post_thumbnail_url(get_the_ID());
    
   

    ?>
<div style="background-image: url('<?php echo $hero_img_url;?>'); height: 485px;"
    class="w-full  bg-no-repeat bg-cover bg-center flex justify-center items-center text-white page-hero">
    <div class="flex flex-col justify-center w-2/3 my-auto mx-6">
        <h1 class="text-4xl text-center font-light mb-5 break-words"><?= the_title()  ?></h1>

    </div>
</div>


<div class="py-8 lg:py-10 text-black">
    <div class='lg:pl-14 pl-8  flex-col anchors hidden'>
        <p class="font-bold">Hoppa till monteringen av: </p>
        <p class="font-light uppercase  lg:pt-0  cursor-pointer  lg:flex-row flex-col hidden">
            <?php if ( have_rows('how-to-sektions') ): ?>
            <?php while ( have_rows('how-to-sektions') ) : the_row(); ?>
            <a class="anchor-scroll max-w-full pl-0 " href="#<?php echo ( get_sub_field('title')); ?>">
                <?php the_sub_field('title')?>
            </a>


            <?php endwhile; ?>
            <?php endif; ?>
        </p>
    </div>
</div>
<div class="lg:p-14 p-8 intro-text container mx-auto">
    <?php the_field('intro-text')?>
</div>


<div class="how-to-section flex flex-col w-full container mx-auto">
    <?php if ( have_rows('how-to-sektions') ): 
           while ( have_rows('how-to-sektions') ) : the_row(); 
           $title = get_sub_field('title');
           $text =get_sub_field('text');
           $video= get_sub_field('video');
           $image= get_sub_field('image')['url'];
           
           ?>

    <div class=" flex lg:flex-row flex-col mb-10 justify-center align-center">
        <div class="grouped-video-section relative" style="height:auto;">
            <?php
    $video_url = $video; // Video Field Name
    $video_poster  = $image; // Poster Image Field Name
                    
    
    // Build the  Shortcode
    $attr =  array(
    'src'      =>  $video_url,
    'poster'   => $video_poster,
    'preload'  => 'auto'
    );
    
    // Display the Shortcode
    echo wp_video_shortcode(  $attr  );

    ?>
            <div class="flex items-center ofyr-video-play">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-play-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polygon fill="white" points="10 8 16 12 10 16 10 8"></polygon>
                </svg>
            </div>

        </div>
        <div class="text-container lg:px-20 px-2 pt-6 lg:pt-4 flex flex-col justify-center w-full">

            <h2 id="<?= $title ?>"><?= $title ?></h2>

            <div class="mb-8 text-base font-light"><?= $text ?></div>
        </div>
    </div>
    <?php endwhile; ?> <?php endif; ?>
</div>



<div class="proffesionals-wrapper">
    <?php

 if ( have_rows('image-text') ): 
    while ( have_rows('image-text') ) : the_row();  {
    


     $flex_direction = get_row_index($i)  % 2 == 0 ? 'lg:flex-row-reverse' : 'lg:flex-row';
     $content_padding = get_row_index($i) % 2 == 0 ? 'sm:px-8 lg:px-12' : 'sm:px-8 lg:px-20';

     $heading_text = get_sub_field('heading');
           $content =get_sub_field('text');
           $image= get_sub_field('image');
    
     ?>


    <div class="ofyr-inspiration-box flex flex-col w-full   mx-auto mb-12 md:mb-28 items-center space-between <?= $flex_direction?>"
        style="background-color:<?=get_row_index($i) % 2 == 0 ? '#F0F0F0' : '#FFF';?>">
        <img class="mb-4 lg:mb-0 object-cover" src="<?= $image['url'] ?>" alt="" style="width:500px; height:400px;">
        <div class="flex flex-col py-12 px-8 pr-8<?= $content_padding ?>">
            <h2 class="mb-8 text-3xl"><?= $heading_text ?></h2>
            <div class="mb-8 text-base font-light"><?= $content ?></div>
        </div>
    </div>

    <?php
    }?>
    <?php endwhile; ?> <?php endif; ?>
    <?php get_part('how-to-loop')?>
</div>
<?php
        endif;?>


<?php wp_reset_postdata();?>
<?php


get_part( 'site-footer' );

get_footer();
?>