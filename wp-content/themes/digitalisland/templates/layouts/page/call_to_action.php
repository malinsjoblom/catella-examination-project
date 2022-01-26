<?php
$link= get_sub_field('link')['url'];
$textLink=get_sub_field('link')['title'];
$image=get_sub_field('image')['url'];
$title=get_sub_field('heading');
$text=get_sub_field('text');

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));
?>

<div class="call-to-action text-center lg:p-28 p-20 <?= implode(' ', $classes) ?>"
    style="background:url('<?= $image ?>'); background-repeat:no-repeat; background-size:cover; background-position:cover;">
    <h2 class="text-5xl text-white font-extralight"><?=$title?></h2>
    <p class="w-full text-xl text-white font-extralight"><?=$text?>
    </p>
    <a href="<?=$link?>">
        <button class="px-6 py-4 mt-8 font-light text-black bg-white rounded-sm hover:bg-black hover:text-white">
            <?=$textLink?>
        </button>
    </a>
</div>