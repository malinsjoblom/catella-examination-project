<?php
$classes = [];
switch (get_sub_field('alignment')) {
    case 'left':
        $classes[] = 'items-start';
        $classes[] = 'text-left';
        break;
    case 'center':
        $classes[] = 'items-center';
        $classes[] = 'text-center';
        break;
    case 'right':
        $classes[] = 'items-end';
        $classes[] = 'text-right';
        break;
};

$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>
<div class="text-block flex flex-col ml-2 <?= implode(' ', $classes ) ?> ">
    <div class="max-w-2xl">
        <h2 class="text-4xl font-bold sm:text-5xl"><?= get_sub_field('heading') ?></h2>
        <?php 
            if(get_sub_field('content')) {
                ?>

        <p class="mt-5 text-xl"> <?= get_sub_field('content') ?></p>

        <?php
            }
       ?>
    </div>
</div>
