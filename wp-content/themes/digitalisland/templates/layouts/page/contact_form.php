<?php 

$title = get_sub_field('heading');
$text= get_sub_field('content');

$classes = [];
$classes[] = set_margin_bottom_class(get_sub_field('margin_bottom'));

?>
<div class="contact-wrapper py-20 <?= implode(' ', $classes ) ?> ">
    <div class="container mx-auto">
        <div class="pb-10 text-4xl font-extralight"><?= $title ?></div>
        <div class="flex flex-wrap">
            <form class="contact-form">
                <?php echo do_shortcode('[contact-form-7 id="248" title="Kontakt form"]'); ?>
            </form>

            <div class="p-10 text-lg leading-10 text-black lg:p-18 text-hours"><?= $text ?>

                <ul class="flex flex-row  lg:p-0 justify-center lg:justify-start">
                    <li class="mr-2 md:inline leading-7 text-sm" id="footer-navi-2"><a
                            href="https://www.facebook.com/ecta.nu" target="_blank"><svg class="h-8 w-8 text-black"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg></a>
                        <li />
                    <li class=" mx-2 md:inline leading-7 text-sm pl-4 lg:pl-0" id="footer-navi-2"><a
                            href="https://www.youtube.com/channel/UCEtC3-g9Gb5GUfAIHlXvfCw" target="_blank"><svg
                                class="h-8 w-8 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" />
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" />
                            </svg></a></li>
                    <li class="mx-2 md:inline leading-7 text-sm pl-4 lg:pl-0" id="footer-navi-2"><a
                            href="https://www.instagram.com/ofyrsverige/" target="_blank"><svg
                                class="h-8 w-8 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                            </svg></a></li>
                </ul>

            </div>

        </div>

    </div>
</div>