<?php


$link_url = get_permalink( $post_object );
$thumbnail = get_the_post_thumbnail_url();
$title = get_the_title( $post_object );
$text = get_the_excerpt($post_object);




?>

<a href="<?php the_permalink() ?>" class=" w-full  bg-gray-100 md:mb-6  border border-white swiper-slide  post-box"
    style="height:402px; width:400px;">
    <div class="flex flex-col">
        <div class="w-full ">
            <img class="w-full object-cover object-center h-52" src="<?=$thumbnail?>"></img>
            <h2 class="text-lg pt-6 px-5 text-black font-normal h-36"><?php the_title() ?></h2>
            <button class="text-black underline px-5 block ">Läs mer</button>
        </div>
    </div>
</a>