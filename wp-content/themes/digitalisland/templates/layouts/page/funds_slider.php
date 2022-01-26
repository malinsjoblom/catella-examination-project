<?php
$title = get_sub_field('heading');
$funds_btn = get_sub_field('funds_button');
$image = get_sub_field('image_signature');
$read_btn = get_sub_field('read_button');
$buy_btn = get_sub_field('buy_button');

?>



<div class="flex flex-col justify-center pl-6 md:pl-14 xl:pl-32 bg-darkest-purple text-lightest-green" style="height:869px;">
    <h2 class="pb-6 text-xl font-bold uppercase md:pb-12 md:text-4xl"> <?= $title ?> </h2>

    <div class="flex flex-col justify-between px-4 pt-6 md:justify-center md:pr-10 lg:px-10 funds-card">
        <div class="mb-3">
            <h4 class="pb-1 text-xs">Catella Nordic Corporate Bond Flex RC</h4>
            <div class="flex flex-row items-center justify-between my-auto">
                <h3 class="text-sm font-bold uppercase md:text-base">JAKTEN PÅ SUNDHEDGESTECKEN</h3>
                <div class="flex-row items-center hidden md:flex">
                    <p class="mx-2 text-2xl text-dark-green"> +2,27% </p>
                    <p class="text-lg uppercase">En månad</p>
                </div>
            </div>
        </div>

        <p class="pb-4 text-xl funds-text">»För att tjäna pengar i uppgång såväl som nedgång investerar vi i räntebärande papper, aktier och derivat. Låg risk är en hörnpelare för fonden.»</p>

        <div class="flex flex-col justify-between mb-8 md:flex-row">
            <img class="my-4 md:my-2 image-signature" src="<?= $image['url'] ?>">
            <div class="flex flex-row mt-2 md:my-2 md:items-end md:justify-end">
                <button class="mr-2 text-xs font-medium uppercase border border-solid border-darkest-purple bg-light-purple text-darkest-purple" style="width:108px; height:50px;"><?= $read_btn ?> </button>
                <button class="ml-2 text-xs font-medium uppercase bg-darkest-purple text-lightest-green" style="width:108px; height:50px;"><?= $buy_btn ?></button>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-between mt-6 md:mt-14">
        <button class="text-xs font-bold uppercase all-funds-btn h-13"><?= $funds_btn ?></button>
        <div class="flex-row items-center hidden lg:flex mr-28">
            <svg class="mx-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path id="Path_212" data-name="Path 212" d="M12,0,9.818,2.182l8.26,8.26H0v3.117H18.078l-8.26,8.26L12,24,24,12Z" transform="translate(24 24) rotate(180)" fill="#eeeaf2" />
            </svg>
            <svg class="mx-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path id="Path_10" data-name="Path 10" d="M12,0,9.818,2.182l8.26,8.26H0v3.117H18.078l-8.26,8.26L12,24,24,12Z" fill="#eeeaf2" />
            </svg>
        </div>
    </div>
</div>
