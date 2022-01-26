<?php

$image = get_sub_field('image')['url'];
$heading = get_sub_field('heading');
$text = get_sub_field('text');
$button_text = get_sub_field('button_text');

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>

<section class="flex flex-col items-center pt-16 md:py-52 md:justify-center cta_card_section bg-light-purple">
    <div class="relative">
        <img class="px-3 img_text_cta xl:relative -left-40" src="<?= $image; ?>" style="min-height:170px" alt="">
        <div class="absolute flex flex-col content-center justify-center pl-4 ml-3 mr-8 text-white text_box_cta md:pl-16 md:h-96 bg-darkest-purple" style=" min-height: 170px">
            <h3 class="pb-3 mt-8 text-xs font-bold sm:py-4 md:text-base">
                <?= $heading ?></h3>
            <p class="my-2 text-xl font-light md:text-3xl">
                <?= $text ?> </p>
            <button class="w-56 py-4 mt-2 mb-4 text-xs font-bold rounded-full sm:px-6 sm:w-60 md:mt-12 md:my-10 bg-light-purple text-darkest-purple">
                <?= $button_text ?>
            </button>
        </div>
    </div>
</section>
