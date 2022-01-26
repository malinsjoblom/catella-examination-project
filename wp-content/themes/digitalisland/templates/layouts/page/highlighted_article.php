<?php
$link= get_sub_field('link')['url'];
$textLink=get_sub_field('link')['title'];
$image=get_sub_field('image')['url'];
$title=get_sub_field('heading');
$text=get_sub_field('text');

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>


<div class="w-screen h-full section-highlighted <?= implode(' ', $classes ) ?> ">
    <div style="background:url('<?= $image ?>'); background-position:center;"
        class="flex justify-center w-full max-w-full pt-12 pb-12 bg-center bg-no-repeat bg-cover sm:pt-32 sm:pb-32 highlighted-img ">
        <div class="container flex flex-col mx-auto my-auto lg:ml-16 ">
            <h2 class="w-full max-w-md text-5xl text-white font-extralight "><?=$title ?></h2>
            <p class="max-w-md mt-4 mb-4 text-lg text-white font-extralight"><?=$text ?></p>
            <a href='<?= $link ?>'>
                <button
                    class="px-6 py-4 font-light text-black bg-white rounded-sm hover:bg-black hover:text-white"><?= $textLink ?></button></a>
        </div>
    </div>
</div>