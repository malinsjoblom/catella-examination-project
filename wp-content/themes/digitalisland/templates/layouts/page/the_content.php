<?php

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>

<div class="text-xl bg-gray-100 the-content-layout <?= implode(' ', $classes) ?>" id="the-content-container">
    <div class="container px-6 mx-auto py-18 lg:py-24 lg:px-24">
        <?= get_the_content(); ?>
    </div>
</div>