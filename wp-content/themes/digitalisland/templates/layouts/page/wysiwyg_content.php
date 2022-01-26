<?php

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>

<div class="container mx-auto <?= implode(' ', $classes) ?>">
    <?= get_sub_field('content') ?>
</div>
