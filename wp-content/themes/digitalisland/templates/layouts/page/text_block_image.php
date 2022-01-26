<?php
$image=get_sub_field('image');
$title=get_sub_field('heading');
$text=get_sub_field('text');

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));
?>

<div class="px-6 py-4 lg:-mt-18 -mt-12 lg:py-18  lg:m-auto container" <?= implode(' ', $classes) ?>>
    <div class="flex flex-col lg:flex-row ">
        <div class="image-text"><img src="<?= $image['url'] ?>"></div>
        <div class="lg:pl-20 pt-18 lg:pt-32">
            <div class="pb-6 text-3xl font-light"><?= $title ?></div>
            <p class=" leading-8 text-xl font-light"> <?= $text ?></p>
        </div>
    </div>
</div>