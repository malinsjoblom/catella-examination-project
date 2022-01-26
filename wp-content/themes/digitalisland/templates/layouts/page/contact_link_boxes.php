<?php

$box_1 = get_sub_field('box_1');
$box_2 = get_sub_field('box_2');
$box_3 = get_sub_field('box_3');
$box_4 = get_sub_field('box_4');
$is_resellers_page = get_sub_field('is_resellers_page');

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>
<div class="grid grid-cols-1 text-2xl font-semibold text-white sm:grid-cols-2 lg:grid-cols-4 <?= implode(' ', $classes ) ?>">
    <a href="<?= $box_1['url'] ?>"
        class="flex flex-col items-center justify-center mx-4 my-4 bg-black cursor-pointer h-44 hover:opacity-80 lg:mr-4">
        <?php

            if($is_resellers_page) {
                ?>

                    <svg class="mb-8" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.1666 5.83325L5.83325 22.1666" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.58341 10.5001C9.19425 10.5001 10.5001 9.19425 10.5001 7.58341C10.5001 5.97258 9.19425 4.66675 7.58341 4.66675C5.97258 4.66675 4.66675 5.97258 4.66675 7.58341C4.66675 9.19425 5.97258 10.5001 7.58341 10.5001Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.4167 23.3333C22.0275 23.3333 23.3333 22.0275 23.3333 20.4167C23.3333 18.8058 22.0275 17.5 20.4167 17.5C18.8058 17.5 17.5 18.8058 17.5 20.4167C17.5 22.0275 18.8058 23.3333 20.4167 23.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                     
                <?php
            } else {
                ?>

                    <svg class="mb-8" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.17065 2.3335H18.8306L25.6673 9.17016V18.8302L18.8306 25.6668H9.17065L2.33398 18.8302V9.17016L9.17065 2.3335Z"
                            stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 9.3335V14.0002" stroke="white" stroke-width="2.33333" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M14 18.6665H14.0117" stroke="white" stroke-width="2.33333" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                <?php
            }

        ?>
        
        <p><?= $box_1['title'] ?></p>
    </a>
    <a href="<?= $box_2['url'] ?>"
        class="flex flex-col items-center justify-center mx-4 my-4 bg-black cursor-pointer h-44 hover:opacity-80">
        <svg class="mb-8" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 12.8332L14 16.3332L25.6667 4.6665" stroke="white" stroke-width="2.33333"
                stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M24.5 14V22.1667C24.5 22.7855 24.2542 23.379 23.8166 23.8166C23.379 24.2542 22.7855 24.5 22.1667 24.5H5.83333C5.21449 24.5 4.621 24.2542 4.18342 23.8166C3.74583 23.379 3.5 22.7855 3.5 22.1667V5.83333C3.5 5.21449 3.74583 4.621 4.18342 4.18342C4.621 3.74583 5.21449 3.5 5.83333 3.5H18.6667"
                stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p><?= $box_2['title'] ?></p>
    </a>
    <a href="<?= $box_3['url'] ?>"
        class="flex flex-col items-center justify-center mx-4 my-4 bg-black cursor-pointer h-44 hover:opacity-80">
        <svg class="mb-8" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M24.4993 4.6665H3.49935C2.21068 4.6665 1.16602 5.71117 1.16602 6.99984V20.9998C1.16602 22.2885 2.21068 23.3332 3.49935 23.3332H24.4993C25.788 23.3332 26.8327 22.2885 26.8327 20.9998V6.99984C26.8327 5.71117 25.788 4.6665 24.4993 4.6665Z"
                stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M1.16602 11.6665H26.8327" stroke="white" stroke-width="2.33333" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
        <p><?= $box_3['title'] ?></p>
    </a>
    <a href="<?= $box_4['url'] ?>"
        class="flex flex-col items-center justify-center mx-4 my-4 bg-black cursor-pointer h-44 hover:opacity-80 lg:ml-4">
        <svg class="mb-8" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M22.1667 12.8335H5.83333C4.54467 12.8335 3.5 13.8782 3.5 15.1668V23.3335C3.5 24.6222 4.54467 25.6668 5.83333 25.6668H22.1667C23.4553 25.6668 24.5 24.6222 24.5 23.3335V15.1668C24.5 13.8782 23.4553 12.8335 22.1667 12.8335Z"
                stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M8.16602 12.8335V8.16683C8.16602 6.61973 8.7806 5.136 9.87456 4.04204C10.9685 2.94808 12.4523 2.3335 13.9993 2.3335C15.5464 2.3335 17.0302 2.94808 18.1241 4.04204C19.2181 5.136 19.8327 6.61973 19.8327 8.16683V12.8335"
                stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p><?= $box_4['title'] ?></p>
    </a>
</div>
