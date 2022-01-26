<?php 
 get_part('bread-crumbs');
  $heroImgUrl = get_the_post_thumbnail_url();
     $title =get_the_title();
if ($heroImgUrl){
?>
<div style="background-image: url('<?php echo $heroImgUrl;?>');height:485px;"
    class="flex justify-center w-full pt-12 pb-12 mb-20 bg-center h-auto bg-no-repeat bg-cover sm:pt-32 page-hero sm:pb-32">
    <div class="container flex flex-col mx-auto my-auto">
        <h1 class="mb-5 text-4xl font-light text-center sm:text-5xl text-white"><?= $title ?></h1>
        <p><?= $text ?></p>
    </div>
</div>
<?php
}
 else{ 
     return false;
}