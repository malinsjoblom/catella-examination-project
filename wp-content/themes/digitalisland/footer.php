<?php

/**
 * This file is just responsible for trigger wp_footer() and closing the body and the html tag.
 * To display a site footer, include the appropriate template-part from a template file
 */

$heading = get_field('heading', 'options');
$text_large = get_field('text_large', 'options');
$button = get_field('button', 'options');
$heading_2 = get_field('heading_2', 'options');
$text_box_risk = get_field('text_box_risk', 'options');
$company = get_field('company', 'options');
$address = get_field('address', 'options');
$post_address = get_field('post_address', 'options');
$telephone = get_field('telephone', 'options');
$email = get_field('email', 'options');
$cookieP = get_field('cookie_policy', 'options');
$integrityP = get_field('integrity_policy', 'options');

?>


<footer>
    <article class="mt-20 text-white bg-darkest-purple">
        <section class="py-3 mb-10 ml-8 tracking-wider md:ml-24">
            <h3 class="py-4 mt-4 text-sm font-bold md:mt-24"><?= $heading ?> </h3>
            <h2 class="py-4 pl-0 pr-8 text-lg md:text-2xl md:w-4/6 xl:w-2/5 2xl:text-3xl lg:text-3xl"><?= $text_large ?> </h2>
            <button class="px-8 py-4 my-4 text-xs font-medium text-white capitalize border-2 border-white border-solid rounded-none bg-darkest-purple"> <?= $button ?> </button>
        </section>

        <div class="mx-8 border-t md:mx-24 border-opacity-20"> </div>

        <section class="ml-8 tracking-wide md:ml-24">
            <h3 class="mt-12 text-sm font-bold md:mt-16 "> <?= $heading_2 ?> </h3>
            <div class="w-11/12 mt-3 mb-16 mr-4 text-xs font-light leading-relaxed lg:text-sm md:mt-6">
                <?= $text_box_risk ?>
                </p>
        </section>

        <div class="mx-8 border-b md:mx-24 border-opacity-20"> </div>

        <div class="hidden tracking-wider lg:contents">
            <?php
            wp_nav_menu(array(
                'menu' => "footer-menu",
                'container_class' => "footer-menu-container",
                'menu_class' => "footer-menu"
            ));
            ?>
        </div>

        <div class="mx-8 border-b md:mx-24 border-opacity-20"> </div>

        <div class="flex flex-col py-5 ml-8 text-sm xl:py-16 xl:ml-24 sm:ml-24 xl:text-sm xl:items-center xl:flex-row">
            <h3 class="mt-12 mb-6 font-bold xl:hidden"> <?= $company ?> </h3>
            <p class="w-11/12 mr-6 font-light xl:ml-0 xl:max-w-max xl:mx-1 between-line"> <?= $address ?> </p>
            <p class="w-11/12 mr-4 font-light xl:max-w-max xl:ml-0 xl:mx-1 between-line"> <?= $post_address ?> </p>
            <p class="w-11/12 mr-4 font-light xl:max-w-max xl:ml-0 xl:mx-1 between-line"> <?= $telephone ?> </p>
            <p class="w-11/12 pb-6 mr-4 font-light xl:pb-0 xl:max-w-max xl:ml-0 xl:mx-1 "> <?= $email ?></p>
            <div class="flex flex-row mb-10 text-sm xl:ml-auto xl:mr-24 xl:mb-0 xl:text-sm">
                <a href="" class="font-light underline"> <?= $cookieP ?> </a>
                <a href="" class="ml-3 font-light underline"> <?= $integrityP ?> </a>
            </div>
        </div>
    </article>
</footer>

</body>

</html>

<?php
wp_footer();
