<?php
 /**  shortcode for listing blog posts and cpt with load more button
 * It adds 4 posts in a row and load more button underneath 
 *Style boxes at your own preference 
 *Shortcode example 
 * [di_loadmore post_type="post" initial_posts="4" loadmore_posts="2"]

 *In this shortcode, we have used the following attributes
 *post_type – This is used to define the post type for which you want to implement the load more functionality.
 *initial_posts – Set the amount for initial posts to load when page is rendered.
 *loadmore_posts – Set how many posts you want to append on each load more button click.
 */
    add_shortcode('di_loadmore','di_loadmore'); function di_loadmore($atts, $content=null){
    ob_start(); $atts=shortcode_atts( array( 'post_type'=> 'post',
    'initial_posts' => '4',
    'loadmore_posts' => '4',
    ), $atts, $tag
    );
    $additonalArr = array();
    $additonalArr['appendBtn'] = true;
    $additonalArr["offset"] = 0; ?>
<div class="dcsAllPostsWrapper">
    <input type="hidden" name="dcsPostType" value="<?=$atts['post_type']?>">
    <input type="hidden" name="offset" value="0">
    <input type="hidden" name="dcsloadMorePosts" value="<?=$atts['loadmore_posts']?>">
    <div class="dcsDemoWrapper">
        <?php dcsGetPostsFtn($atts, $additonalArr); ?>
    </div>
</div>
<?php
    return ob_get_clean();
}
function dcsGetPostsFtn($atts, $additonalArr=array()){ 
    $args = array(
     'post_type' => $atts['post_type'],
     'posts_per_page' => $atts['initial_posts'],
     'offset' => $additonalArr["offset"],
     'orderby' => 'date',
        'order'   => 'ASC',
 );
 $the_query = new WP_Query( $args );
 $havePosts = true;
 if ( $the_query->have_posts() ) {
     while ( $the_query->have_posts() ) {
         $the_query->the_post(); 
         $thumbnail = get_the_post_thumbnail_url( get_the_ID() ) ? get_the_post_thumbnail_url( get_the_ID() ) : wc_placeholder_img_src();?>
<a href="<?php the_permalink();?>">
    <div class="loadMoreRepeat">
        <div class="innerWrap">
            <div class="img-container">
                <img src="<?=$thumbnail?>"></img>
            </div>
            <div class="px-4 pt-4 pb-6">
                <h2 class="card-title text-xl h-20 font-normal"><?=get_the_title()?></h2>
                <!--<p class="card-text"><?php the_excerpt(); ?></p> -->
                <a href="<?php the_permalink();?>">
                    <button class="p-3 text-black border border-black  hover:text-white hover:bg-black">Läs recepter
                        här</button></a>
            </div>
        </div>
    </div>
</a>
<?php
     }
 } else {
    $havePosts = false; 
 }
 wp_reset_postdata();
    if($havePosts && $additonalArr['appendBtn'] ){ ?>
<div class="btnLoadmoreWrapper">
    <a href="javascript:void(0);" class=" dcsLoadMorePostsbtn underline">Ladda fler</a>
</div>

<!-- loader for ajax -->
<div class="dcsLoaderImg" style="display: none;">
    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
        y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" style="
         color: #000;">
        <path fill="#000"
            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                to="360 50 50" repeatCount="indefinite"></animateTransform>
        </path>
    </svg>
</div>

<p class="noMorePostsFound" style="display: none;">Inga fler inlägg hittades</p>
<?php
 }
}

	
/**
 * Enqueue scripts and styles for the front end.
 */
function dcsEnqueue_scripts() {
 wp_enqueue_script( 'dcsLoadMorePostsScript', get_template_directory_uri() . '/assets/js/singles/loadmoreposts.js', array( 'jquery' ), '20131205', true );
 wp_localize_script( 'dcsLoadMorePostsScript', 'dcs_frontend_ajax_object',
 array( 
    'ajaxurl' => admin_url( 'admin-ajax.php')
 )
 );
}
add_action( 'wp_enqueue_scripts', 'dcsEnqueue_scripts' );



	
add_action("wp_ajax_dcsAjaxLoadMorePostsAjaxReq","dcsAjaxLoadMorePostsAjaxReq");
add_action("wp_ajax_nopriv_dcsAjaxLoadMorePostsAjaxReq","dcsAjaxLoadMorePostsAjaxReq");
function dcsAjaxLoadMorePostsAjaxReq(){
 extract($_POST);
 $additonalArr = array();
 $additonalArr['appendBtn'] = false;
 $additonalArr["offset"] = $offset;
 $atts["initial_posts"] = $dcsloadMorePosts;
 $atts["post_type"] = $postType;
 dcsGetPostsFtn($atts, $additonalArr);
 die();
}