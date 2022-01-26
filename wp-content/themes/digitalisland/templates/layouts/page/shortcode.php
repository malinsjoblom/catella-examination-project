<?php

$shortcode = get_sub_field('shortcode_text');
$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>
<div class="container mx-auto">
    <div class="<?= implode(' ', $classes) ?> ">
        <?php echo do_shortcode($shortcode); ?>
    </div>
</div>