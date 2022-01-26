<?php 
/*acf fields*/
$hero_img_url = get_field('video');
$title =get_field('heading');
$text =get_field('content');

?>
<div class="video-banner">
    <div class="video-container">
        <video playsinline="" autoplay="" muted="" loop id="bgvideo">
            <source src="<?php echo $hero_img_url?>" type="video/mp4" class=" w-full">
        </video>
    </div>
    <div class="container flex flex-col mx-auto my-auto lg:ml-12  m:m-2 hero-heading ">
        <div id="main"></div>
        <h1 class="mb-5 lg:text-6xl text-5xl font-light text-white pt-8 lg:pt-0 leading-6"><?= $title ?></h1>
        <p class="font-extralight text-white lg:text-xl text-lg tracking-widest"><?= $text ?></p>
    </div>
    <a href="#main" id="button-down">
        <svg class="arrow-down  inline-block max-h-10 w-full">
            <path class="a1" d="M0 0 L15 16 L30 0"></path>
            <path class="a2" d="M0 10 L15 26 L30 10"></path>

        </svg>
    </a>


</div>