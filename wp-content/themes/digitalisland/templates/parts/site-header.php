<header class="sticky top-0 z-40 w-full">

    <div class="flex items-center justify-center w-full h-4 bg-black">

    </div>

    <div class="flex items-center justify-between h-20 px-8 bg-black lg:h-24 xl:px-16">
        <div class="w-32 xl:w-auto ">
            <?php the_custom_logo(); ?>
        </div>
        <div class="flex items-center my-4 text-center ">
            <div
                class="flex-col justify-between hidden p-3 pb-10 text-base font-normal tracking-wider text-white uppercase mr-14 lg:-mr-10 main-menu-container lg:flex lg:flex-row">
                <?php
					// This function will print a navigation menu
					wp_nav_menu( [
						'theme_location' => 'main',
						'fallback_cb'    => false,
						'container'      => true,
						'menu_class'     => "flex",
             
                        
					] );
                    
                   
				?>
            </div>
            <div class="flex items-center ">
                <div x-cloak x-data="{ searchIsOpen: false }"
                    class="flex items-center ml-6 text-white ofyr-search-container">
                    <div class="flex mr-4 place-content-center">
                        <svg alt="Opens search form" @keydown.enter="searchIsOpen = true" tabindex="0"
                            x-show="!searchIsOpen" @click="searchIsOpen = true"
                            class="mx-2 cursor-pointer search-icon lg:block" width="25" height="25" viewBox="0 0 25 25"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.4583 19.7917C16.0607 19.7917 19.7917 16.0607 19.7917 11.4583C19.7917 6.85596 16.0607 3.125 11.4583 3.125C6.85596 3.125 3.125 6.85596 3.125 11.4583C3.125 16.0607 6.85596 19.7917 11.4583 19.7917Z"
                                stroke="#053B54" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21.875 21.875L17.3438 17.3438" stroke="#053B54" stroke-width="1.75"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="mx-2 cursor-pointer text-green-accent" x-show="searchIsOpen"
                            @click="searchIsOpen = false" @keydown.enter="searchIsOpen = false" tabindex="0"
                            xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>

                    <div x-show="searchIsOpen" @click.away="searchIsOpen = false" class="origin-top ofyr-search"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="transform scale-y-0" x-transition:enter-end="transform scale-y-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="transform scale-y-100" x-transition:leave-end="transform scale-y-0">
                        <?= get_search_form(); ?>
                    </div>
                </div>
                
                

                <div class="block mx-2 di-hamburger mobile-menu lg:hidden">
                    <div id="menuToggle">
                        <input type="checkbox" />
                        <span></span>
                        <span></span>
                        <span></span>
                        <ul id="menu">
                            <?php wp_nav_menu( array(
                          'depth' => 6,
                          'sort_column' => 'menu_order',
                          'container' => 'ul',
                          'menu_id' => 'main-nav',
                          'menu_class' => 'nav mobile-menu',
                          'theme_location' => 'mobile-menu'));
                          ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </div>
</header>